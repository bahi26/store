<?php
include_once '../controller.php';
$_SESSION['auth']=1;$_SESSION['id']=1;
$categories=get_categories();
$sections = get_sections();
$products=get_products();
echo "<pre>";
print_r($categories);
print_r($sections);
print_r($products);
if(isset($_POST['delete-category-submit']))
{
    echo delete_category();
}
if(isset($_POST['delete-section-submit']))
{
    echo delete_section();
}
if(isset($_POST['delete-product-submit']))
{
    echo delete_product();
}
?>

<form  method="post" action="delete.php?category=roy&section=roy" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name">
    <button type="submit" name="delete-category-submit">submit</button>
</form>

<form  method="post" action="delete.php?category=roy&section=roy" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name">
    <button type="submit" name="delete-section-submit">submit</button>
</form>

<form  method="post" action="delete.php?category=roy&section=roy" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name">
    <button type="submit" name="delete-product-submit">submit</button>
</form>
