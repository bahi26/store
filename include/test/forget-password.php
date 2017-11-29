<?php
include_once '../controller.php';
//$_SESSION['auth']=1;
if(isset($_POST['send-forget-submit']))
{
    echo send_forget();
}
if(isset($_POST['recover-password-submit']))
{
    echo recover_password();
}
?>
<form method="post" action="<?=$_SERVER['REQUEST_URI']?>">
    <input type="email" placeholder="email" name="email">
    <button type="submit" name="send-forget-submit">send</button>
</form>

<form method="post" action="<?=$_SERVER['REQUEST_URI']?>">
    <input type="password" placeholder="password" name="password">
    <button type="submit" name="recover-password-submit">reset</button>
</form>