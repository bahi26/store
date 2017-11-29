<?php
session_start();
class DB
{
    private static function connect()
    {
        $pdo=new PDO('mysql:host=127.0.0.1;dbname=store;charset=utf8','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query,$params=array())
    {
        $statement=self::connect()->prepare($query);
        $statement->execute($params);
        if(explode(' ',$query)[0]=='select')
        {
            $data = $statement->fetchAll();
            return $data;
        }
    }
}

function DB_add_category($name,$picture)
{
    DB::query('insert into categories (category_name,category_picture) VALUES (?,?)',array($name,$picture));
}

function DB_check_category($name)
{
    $data=DB::query('select * from categories where category_name= ?',array($name));
    if($data) return $data[0];
    else return false ;
}

function DB_add_section($name,$picture,$category)
{
    DB::query('insert into sections (section_name,section_picture,category_id) VALUES (?,?,?)',array($name,$picture,$category));
}

function DB_check_section($name,$category)
{
    $data=DB::query('select * from sections where section_name= ? and category_id=?' ,array($name,$category));
    if($data) return $data[0];
    else return false ;
}

function DB_add_product($name,$picture,$price,$number,$details,$section,$id)
{
    DB::query('insert into products (product_name,product_picture,price,number,details,section_id,cobone_id) 
                VALUES (?,?,?,?,?,?,?)',array($name,$picture,$price,$number,$details,$section,$id));
}

function DB_check_product($name,$section_id,$cobone_id)
{
    $data=DB::query('select * from products where (section_id= ? and product_name=?) or cobone_id=? ' ,array($section_id,$name,$cobone_id));
    if($data) return $data[0];
    else return false ;
}

function DB_get_categories()
{
    $data=DB::query('select * from categories ');
    return $data;
}

function DB_get_sections($category_id)
{
    $data=DB::query('select * from sections where category_id=?',array($category_id));
    return $data;
}

function DB_get_products($section_id ,$number=-1)
{
    $data=DB::query('select * from products where section_id=? and number >?',array($section_id,$number));
    return $data;
}

function DB_delete_category($name)
{
    DB::query('delete from categories where category_name=?',array($name));
}

function DB_delete_section($name,$category_id)
{
    DB::query('delete from sections where section_name=? and category_id=?',array($name,$category_id));
}

function DB_delete_product($name,$section_id)
{
    DB::query('delete from products where product_name=? and section_id=?',array($name,$section_id));
}

function DB_update_category($id,$name=null,$picture=null)
{
    if(!is_null($name)) DB::query('update categories set category_name=? where id=?',array($name,$id));
    if(!is_null($picture)) DB::query('update categories set category_picture=? where id=?',array($picture,$id));
}

function DB_update_section($id,$name=null,$picture=null)
{
    if(!is_null($name)) DB::query('update sections set section_name=? where id=?',array($name,$id));
    if(!is_null($picture)) DB::query('update sections set section_picture=? where id=?',array($picture,$id));
}

function DB_update_product($id,$name=null,$picture=null,$price=null,$number=null,$details=null,$cobone_id=null)
{
    if(!is_null($name)) DB::query('update products set product_name=? where id=?',array($name,$id));
    if(!is_null($picture)) DB::query('update products set product_picture=? where id=?',array($picture,$id));
    if(!is_null($price)) DB::query('update products set price=? where id=?',array($price,$id));
    if(!is_null($number)) DB::query('update products set number=? where id=?',array($number,$id));
    if(!is_null($details)) DB::query('update products set details=? where id=?',array($details,$id));
    if(!is_null($cobone_id)) DB::query('update products set cobone_id=? where id=?',array($cobone_id,$id));
}

function DB_add_ticket($name,$picture,$details,$user_id)
{
    DB::query('insert into tickets (ticket_name,photo,details,user_id) VALUES (?,?,?,?)',array($name,$picture,$details,$user_id));
}

function DB_get_tickets($user_id)
{
    $data=DB::query('select * from tickets where user_id=? ',array($user_id));
    return $data;
}

function DB_get_ticket($id,$user_id)
{
    $data=DB::query('select * from tickets where id=? and user_id=? ',array($id,$user_id));
    if($data) return $data[0];
    else return false ;
}

function DB_get_id_by_email($email)
{
   $data=DB::query('select * from users where email=?',array($email));
    if($data) return $data[0];
    else return false ;
}

function DB_generate_token($id,$token)
{
    DB::query('insert into password_tokens (user_id,token) values (?,?)',array($id,$token));
}

function DB_get_id_by_token($token)
{
    $data=DB::query('select user_id from password_tokens where token=?',array($token));
    if($data) return $data[0];
    else return false ;
}

function DB_delete_token($id)
{
    DB::query('delete from password_tokens where user_id=?',array($id));
}

function DB_change_password($id,$password)
{
    DB::query('update users set password=? where id=?',array($password,$id));
}
 function insertUser($userName,$email,$pass,$mob)
{
   
           DB::query('INSERT INTO `users` (`user_name`, `email`, `password`,`phone_number`) VALUES (?,?,?,?)', array($userName,$email,$pass,$mob));
               


}
  function check_email($email)
{
     
   
   $data= DB::query('select email FROM users WHERE email = ?', array($email));
if($data)
        return true;
    else        return false;
}
  function select_person($email)
{
     
   
   $data= DB::query('select id, user_name, email, password, auth FROM users WHERE email = ?', array($email));
   return $data[0];
}
 function select_person_byid()
{
     
   
   $data= DB::query('select user_name, email, password, phone_number FROM users WHERE id = ?', array($_SESSION['id']));
   return $data[0];
}
function update_email($email)
{
  DB::query('update users set email=? where id=?',array($email,$_SESSION['id']));
}function update_password($pass)
{
  DB::query('update users set password=? where id=?',array($pass,$_SESSION['id']));
}
function update_phone($phone)
{
  DB::query('update users set phone_number=? where id=?',array($phone,$_SESSION['id']));
}
function update_uname($uname)
{
  DB::query('update users set user_name=? where id=?',array($uname,$_SESSION['id']));
}
   function DB_add_category($name,$picture)
{
    DB::query('insert into categories (category_name,category_picture) VALUES (?,?)',array($name,$picture));
}
