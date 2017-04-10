<?php
$sql="SELECT user_email FROM users WHERE user_name='".$_POST['user_name']."'";
$result=mysql_query($sql);
if(mysql_num_rows($result) == 0)
{
echo 'You have given a wrong username. Please try again.';
}
else
{
while($row=mysql_fetch_array($result))
{
$otp=mt_rand(100000,999999);
require "C:\wamp\www\DisscussionForum\Discussion Forum\PHPMailerAutoload.php";

$mail = new PHPMailer;                      
$mail->isSMTP();                                      
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true; 
                              
$mail->Username = '';                 
$mail->Password = '';  

                         
$mail->SMTPSecure = 'tls';                            
$mail->Port = 587;                                    

$mail->setFrom('noreply@thoughtxchange.com', 'ThoughtXchange');    
$mail->addAddress($row['user_email']);               
$mail->addReplyTo('info@example.com', 'Information'); 
$mail->isHTML(true);                                  

$mail->Subject = 'ThoughtXchange: Account Recovery Email';
$mail->Body    = 'Dear user, your OTP is <b>'.$otp.'</b>';

if(!$mail->send()) 
{
    echo 'OTP could not be sent.';
    echo 'Error: ' . $mail->ErrorInfo;
} 
else 
{
    echo 'An OTP has been sent to the registered email address.<br>';
}
echo '<form action="recovery.php" method="post">
<input type="hidden" name="otp" value="'.$otp.'">
<br />One-Time Password: <input type="number" name="recovery" required><br />
<input type="submit" value="Submit"></form>';
echo '<meta http-equiv="refresh" content="120;URL=index.php"';			
}
}
?>