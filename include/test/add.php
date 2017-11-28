<?php
include_once '../controller.php';
$_SESSION['auth']=1;
if(isset($_POST['add-category-submit']))
{
   echo add_category();
}
if(isset($_POST['add-section-submit']))
{
    echo add_section();
}
if(isset($_POST['add-product-submit']))
{
    echo add_product();
}
?>
<form  method="post" action="add.php" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name">
    <input type="file" name="image">
    <button type="submit" name="add-category-submit">submit</button>
</form>

<form  method="post" action="add.php?category=roy" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name">
    <input type="file" name="image">
    <button type="submit" name="add-section-submit">submit</button>
</form>
<form  method="post" action="add.php?category=roy&section=roy" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name">
    <input type="file" name="image">
    <input name="price" type="number" placeholder="price">
    <input name="number" type="number" placeholder="number">
    <input name="details" type="text" placeholder="details">
    <input name="cobone_id" type="text" placeholder="cobone_id">
    <button type="submit" name="add-product-submit">submit</button>
</form>
