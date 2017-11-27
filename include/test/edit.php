<?php
include_once '../controller.php';
$_SESSION['auth']=1;$_SESSION['id']=1;
$category=get_category();
$section = get_section();
$product=get_product();
if(isset($_POST['edit-category-submit']))echo edit_category();
if(isset($_POST['edit-section-submit']))echo edit_section();
if(isset($_POST['edit-product-submit']))echo edit_product();
?>
<form  method="post" action="edit.php?category=roy&section=roy&product=greed" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name" value='<?=$category['category_name']?>'>
    <input type="file" name="image" >
    <button type="submit" name="edit-category-submit">submit</button>
</form>

<form  method="post" action="edit.php?category=roy&section=roy&product=greed" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name" value='<?=$section['section_name']?>'>
    <input type="file" name="image" >
    <button type="submit" name="edit-section-submit">submit</button>
</form>
<form  method="post" action="edit.php?category=roy&section=roy&product=greed" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="name" value='<?=$product['product_name']?>'>
    <input type="file" name="image" >
    <input name="price" type="number" placeholder="price" value='<?=$product['price']?>'>
    <input name="number" type="number" placeholder="number" value='<?=$product['number']?>'>
    <input name="details" type="text" placeholder="details" value='<?=$product['details']?>'>
    <input name="cobone_id" type="text" placeholder="cobone_id" value='<?=$product['cobone_id']?>'>
    <button type="submit" name="edit-product-submit">submit</button>
</form>