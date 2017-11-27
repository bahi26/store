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