<?php
include_once '../controller.php';
$_SESSION['auth']=0;$_SESSION['id']=1;
if(isset($_POST['add-ticket-submit']))
{
    echo add_ticket();
}
if(isset($_GET['ticket']))
{
    print_r(get_ticket());
}else print_r(get_tickets());
?>
<form  method="post" action="tickets.php" enctype="multipart/form-data">
    <input name="ticket_name" type="text" placeholder="name">
    <input type="file" name="photo">
    <input type="text" name="details" placeholder="details">
    <button type="submit" name="add-ticket-submit">submit</button>
</form>