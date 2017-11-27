<?php
include_once'model.php';
session_start();

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
                $category=$_GET['category'];
                $section=$_GET['section'];
                $category=DB_check_category($category);
                if($category)
                {
                    $category=$category['id'];
                    $file = $_FILES['image'];
                    $section=DB_check_section($section,$category);
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
                    else return 'there is no section with the name ' . $section['section_name'];
                }
                else return 'there is no category with the name ' . $category['category_name'];
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
        else return 'category does not exist';
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
            else return 'section does not exist';
        }
        else return 'category does not exist';
    }
    else return 'login';
}

function upload($file,$dir,$old_picture=null)
{
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $ext = explode('.', $file_name);
        $file_ext = strtolower(end($ext));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($file_ext, $allowed))
        {
            if ($file_error == 0)
            {
                if ($file_size > 1000000000) return arr(false,'size is to pig');
                    else
                    {
                    $file_new_name = bin2hex(openssl_random_pseudo_bytes(59,$true));
                    move_uploaded_file($file_tmp_name, '../images/'.$dir.'/' . $file_new_name .'.'.$file_ext );
                    if(!is_null($old_picture)&& $old_picture!='0.jpg')  unlink('../images/'.$dir.'/' .$old_picture);
                    return arr(true,$file_new_name.'.'.$file_ext);
                    }
            }
            else arr(false,'there is an error updating the image');
        }
        else return arr(false,'you must enter an image');
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