<?php
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
            if ($file_size > 1000000000) return array(false,'size is to pig');
            else
            {

                $true=true;
                $file_new_name=bin2hex(openssl_random_pseudo_bytes(32,$true));
                move_uploaded_file($file_tmp_name, '../../images/'.$dir.'/' . $file_new_name .'.'.$file_ext );
                if(!is_null($old_picture)&& $old_picture!='0.jpg')  unlink('../../images/'.$dir.'/' .$old_picture);
                return array(true,$file_new_name.'.'.$file_ext);
            }
        }
        else return array(false,'there is an error updating the image');
    }
    else return array(false,'you must enter an image');
}

function send_mail($to,$from,$name,$details,$picture=null,$username=null)
{
    $subject = $name;
    $message = "
                    <html>
                    <head>
                    <title>site_name</title>
                    </head>
                    <body>
                    <h2>".$name."</h2>
                    <br>
                    <p>".$username.$details.$picture."</p>
                    </body>
                    </html>";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <'.$from.'>' . "\r\n";
    $headers .= 'Cc: '.$from. "\r\n";
    mail($to, $subject, $message, $headers);

}