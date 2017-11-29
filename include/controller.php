<?php
include_once'model.php';
include_once 'lib.php';

function add_category()
{
	if(isset($_POST['add-category-submit']))
	{
		if(isset($_SESSION['auth']))
		    if($_SESSION['auth']>0)
            {
                $name=$_POST['name'];
                $file = $_FILES['image'];
                if(!DB_check_category($name))
                {
                    $arr = upload($file, 'category_pictures');
                    if($arr[0])
                    {
                        DB_add_category($name,$arr[1]);
                        return 'category was added';
                    }
                    else return $arr['1'];
                }
                else return 'there is a category with the name ' . $name;
            }
            else return "you don't have authorization" ;
		else return "you don't have authorization";
	}
}

function add_section()
{
    if(isset($_POST['add-section-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_POST['name'];
                $category=$_GET['category'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    $file = $_FILES['image'];
                    if(!DB_check_section($name,$category))
                    {
                        $arr = upload($file, 'section_pictures');
                        if ($arr[0])
                        {
                            DB_add_section($name,$arr[1],$category);
                            return 'section was added';
                        } else return $arr['1'];
                    }
                    else return 'there is a section with the name ' . $name;
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function add_product()
{
    if(isset($_POST['add-product-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_POST['name'];
                $category1=$_GET['category'];
                $section1=$_GET['section'];
                $category=DB_check_category($category1);
                if($category)
                {
                    $category=$category['id'];
                    $file = $_FILES['image'];
                    $section=DB_check_section($section1,$category);
                    if($section)
                    {
                        $cobone_id=$_POST['cobone_id'];
                        if(!DB_check_product($name,$section['id'],$cobone_id))
                        {
                            $arr = upload($file, 'product_pictures');
                            if ($arr[0])
                            {
                                $price=$_POST['price'];
                                $number=$_POST['number'];
                                $details=$_POST['details'];
                                DB_add_product($name,$arr[1],$price,$number,$details,$section['id'],$cobone_id);
                                return 'product was added';
                            }
                            else return $arr['1'];
                        }
                        else return 'there is a cobone with the name ' . $name;
                    }
                    else return 'there is no section with the name ' . $section1;
                }
                else return 'there is no category with the name ' . $category1;
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function get_categories()
{
    if(isset($_SESSION['id']))
        return DB_get_categories();
    else return 'login';
}

function get_sections()
{
    if(isset($_SESSION['id']))
    {
        $category=DB_check_category($_GET['category']);
        if($category)
            return DB_get_sections($category['id']);
        else return 'category does not exist <br>';
    }
    else return 'login';
}

function get_products()
{
    if(isset($_SESSION['id']))
    {
        $category=DB_check_category($_GET['category']);
        if($category)
        {
            $section=DB_check_section($_GET['section'],$category['id']);
            if($section)
                return DB_get_products($section['id']);
            else return 'section does not exist <br>';
        }
        else return 'category does not exist <br>';
    }
    else return 'login';
}


function delete_category()
{
    if(isset($_POST['delete-category-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_POST['name'];
                if(DB_check_category($name))
                {
                    $picture=DB_check_category($name)['category_picture'];
                    if($picture!='0.jpg')
                        unlink('../../images/category_pictures/'.$picture);
                    DB_delete_category($name);
                    return 'category was delete';
                }
                else return 'there is no category with the name ' . $name;
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function delete_section()
{
    if(isset($_POST['delete-section-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_POST['name'];
                $category=$_GET['category'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    if(DB_check_section($name,$category))
                    {
                        $picture=DB_check_section($name,$category)['section_picture'];
                        if($picture!='0.jpg')
                            unlink('../../images/section_pictures/'.$picture);
                        DB_delete_section($name,$category);
                        return 'section was deleted';
                    }
                    else return 'there is no section with the name ' . $name;
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function delete_product()
{
    if(isset($_POST['delete-product-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_POST['name'];
                $category=$_GET['category'];
                $section=$_GET['section'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    $section=DB_check_section($section,$category);
                    if($section)
                    {
                        if(DB_check_product($name,$section['id'],0))
                        {
                            $picture=DB_check_product($name,$section['id'],0)['product_picture'];
                            if($picture!='0.jpg')
                                unlink('../../images/product_pictures/'.$picture);
                            DB_delete_product($name,$section['id']);
                            return 'product was deleted';
                        }
                        else return 'there is no cobone with the name ' . $name;
                    }
                    else return 'there is no section with the name ' . $section['section_name'];
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function get_category()
{
    if(true)
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_GET['category'];
                if(DB_check_category($name))
                {
                    return DB_check_category($name);
                }
                else return 'there is no category with the name ' . $name;
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function get_section()
{
    if(true)
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_GET['section'];
                $category=$_GET['category'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    if(DB_check_section($name,$category))
                    {
                        return DB_check_section($name,$category);
                    }
                    else return 'there is no section with the name ' . $name;
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function get_product()
{
    if(true)
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_GET['product'];
                $category=$_GET['category'];
                $section=$_GET['section'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    $section=DB_check_section($section,$category);
                    if($section)
                    {
                        if(DB_check_product($name,$section['id'],0))
                        {
                            return DB_check_product($name,$section['id'],0);
                        }
                        else return 'there is no cobone with the name ' . $name;
                    }
                    else return 'there is no section with the name ' . $section['section_name'];
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function edit_category()
{
    if(isset($_POST['edit-category-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_GET['category'];
                $file = $_FILES['image'];
                $category=DB_check_category($name);
                if($category)
                {
                    $new_name=$_POST['name'];
                    if($new_name!=$name && !empty($new_name))
                    {
                        if(!DB_check_category($new_name)) DB_update_category($category['id'],$new_name);
                        else return 'new exists';
                    }
                    if($file['error']<1  && $category['category_picture']!=$file)
                    {
                        $arr = upload($file, 'category_pictures',$category['category_picture']);
                        if ($arr[0])
                        {
                            DB_update_category($category['id'],null,$arr[1]);
                        }
                        else return $arr['1'];
                    }
                    return 'data was updated';
                }
                else return 'there is no category with the name ' . $name;
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function edit_section()
{
    if(isset($_POST['edit-section-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $name=$_GET['section'];
                $category=$_GET['category'];
                $category=DB_check_category($category);
                $file = $_FILES['image'];
                if($category)
                {
                    $category=$category['id'];
                    $section=DB_check_section($name,$category);
                    if($section)
                    {
                        $new_name=$_POST['name'];
                        if($new_name!=$name&& !empty($new_name))
                        {
                            if(!DB_check_section($new_name,$category)) DB_update_section($section['id'],$new_name);
                            else return 'name exists';
                        }
                        if($file['error']<1  && $section['section_picture']!=$file)
                        {
                            $arr = upload($file, 'section_pictures',$section['section_picture']);
                            if ($arr[0])
                            {
                                DB_update_section($section['id'],null,$arr[1]);
                            }
                            else return $arr['1'];
                        }
                        return 'data was updated';
                    }
                    else return 'there is no section with the name ' . $name;
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function edit_product()
{
    if(isset($_POST['edit-product-submit']))
    {
        if(isset($_SESSION['auth']))
            if($_SESSION['auth']>0)
            {
                $section=$_GET['section'];
                $category=$_GET['category'];
                $name=$_GET['product'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    $section=DB_check_section($section,$category);
                    if($section)
                    {
                        $section=$section['id'];
                        $product=DB_check_product($name,$section,0);
                        if($product)
                        {
                            $new_name=$_POST['name'];
                            $file = $_FILES['image'];
                            $price=$_POST['price'];
                            $number=$_POST['number'];
                            $details=$_POST['details'];
                            $cobone=$_POST['cobone_id'];
                            if($new_name!=$name&& !empty($new_name))
                            {

                                if(!DB_check_product($new_name,$section,0)) DB_update_product($product['id'],$new_name);
                                else return $new_name.'exists';
                            }
                            if($file['error']<1 && $product['product_picture']!=$file)
                            {
                                $arr = upload($file, 'product_pictures',$product['product_picture']);
                                if ($arr[0])
                                {
                                    DB_update_product($product['id'],null,$arr[1]);
                                }
                                else return $arr['1'];
                            }
                            if($product['price']!=$price && !empty($price))
                            {
                                DB_update_product($product['id'],null,null,$price);
                            }
                            if($product['number']!=$number && !empty($number))
                            {
                                DB_update_product($product['id'],null,null,null,$number);
                            }
                            if(!empty($details))
                            {
                                DB_update_product($product['id'],null,null,null,null,$details);
                            }
                            if($product['cobone_id']!=$cobone && !empty($cobone))
                            {
                                if(DB_check_product($name,0,$cobone))
                                {
                                    DB_update_product($product['id'],null,null,null,null,null,$cobone);
                                }
                                else return 'cobone id exists';
                            }
                            return 'data was updated';
                        }
                        else return 'there is no product with the name '.$name;
                    }
                    else return 'there is no section with the name ' . $section['section_name'];
                }
                else return 'there is no category with the name ' . $category['category_name'];
            }
            else return "you don't have authorization" ;
        else return "you don't have authorization";
    }
}

function add_ticket()
{
    if(isset($_POST['add-ticket-submit']))
    {
        if(isset($_SESSION['id']))
        {
            $name = $_POST['ticket_name'];
            $file = $_FILES['photo'];
            $details = $_POST['details'];
                $arr = upload($file, 'ticket_pictures');
                if ($arr[0])
                {
                    DB_add_ticket($name, $arr[1],$details,$_SESSION['id']);
                    send_mail("bahi.ali26@yahoo.com",$_SESSION['id'],$name,$details,$arr[0]);
                    return 'ticket was added';
                }
                else return $arr['1'];

        }
        else return "you don't have authorization";
    }
}

function get_tickets()
{

    if(isset($_SESSION['id']))
    {
       return DB_get_tickets($_SESSION['id']);
    }
    else return "you don't have authorization";
}

function get_ticket()
{
    if(isset($_SESSION['id']))
    {
        $id=$_GET['ticket'];
        return DB_get_ticket($id,$_SESSION['id']);
    }
    else return "you don't have authorization";
}

function send_forget()
{
    if(isset($_POST['send-forget-submit']))
    {
        if (!isset($_SESSION['id']))
        {
            $email=$_POST['email'];
            $user=DB_get_id_by_email($email);
            if($user)
            {
                $true=true;
                $token=bin2hex(openssl_random_pseudo_bytes(32,$true));
                DB_delete_token($user['id']);
                DB_generate_token($user['id'],$token);
                send_mail($email,'',$user['username'],'http://localhost/store/include/test/forget-password.php?token='.$token);
                return 'recovery link was sent please check your email';
            }
            else return "email doesn't exist";
        }
        else return 'please log out';
    }
}

function recover_password()
{
    if (isset($_POST['recover-password-submit']))
    {
        if (!isset($_SESSION['id']))
        {
            $token = $_GET['token'];
            $user = DB_get_id_by_token($token);
            $password = $_POST['password'];
            if ($user)
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
                DB_change_password($user['user_id'], $password);
                DB_delete_token($user['user_id']);
                return 'password is changed';
            }
            else return 'this link is expired';
        }
        else return 'please log out';
    }
}


function addUser() {
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $mob=$_POST['mobile'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (!check_email($email))
        {
        insertUser($userName, $email, $hashed_password,$mob);
                header("location: LoginRegister.php?success=success");
        }

    else {
        header("location: LoginRegister.php?email=exist");
        exit();
    }
    }


function login()
{
          $email = $_POST['email'];
                $pass = $_POST['password'];
                $person=select_person($email);
                if ($person)
                {
            $check =password_verify($pass,$person['password']);
 if ($check)
            {
$_SESSION['id']=$person['id'];
$_SESSION['auth']=$person['auth'];

if ($_SESSION['auth']==0)
{
    echo 'user';
}
else 
{
    echo 'admin';
}

}
 else {
                         header("location: LoginRegister.php?login=invalid");

 }
                }
 else {
                    header("location: LoginRegister.php?login=invalid");
 }
    }

    
function get_information()
{
        if(!isset($_SESSION))
                                header("location: LoginRegister.php");
                            else 
        $data=  select_person_byid();
        return $data;
    }

function update()
    {
          $uname = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone_number = $_POST['mobile'];
        $password_conformation = $_POST['password_conformation'];
       
        
        //check if there's invalid data
        if (
                (!filter_var($email, FILTER_VALIDATE_EMAIL) & !empty($email)) ||
                (!is_numeric($phone_number) & !empty($phone_number)) ||
                (!preg_match("/^[a-zA-Z0-9]*$/", $password) & !empty($password))) {
            header("Location: updateuser.php?profile=invalid");
            exit();
        }  else {
                
                if ($password!= $password_conformation) {

                        header("Location: updateuser.php?profile=mismatch");
                }
                    else {

                        if (!empty($email)) {
                            if (!check_email($email))
                           update_email($email);
                       else{
                                                   header("Location: updateuser.php?email=exist");
                                               exit();
                       }
                        }

                        if (!empty($password)) {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            update_password($password);
                        }

                      

                        if (!empty($phone_number)) {
                            update_phone($phone_number);
                            }
                        if (!empty($uname)) {
                            update_uname($uname);
                            }
                        header("Location: updateuser.php?update=success");
                        exit();

    }
            }
        }
    

