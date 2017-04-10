<?php
session_start();
include 'header.php';
include 'connect.php';
if($_POST['otp']==$_POST['recovery'])
{
$sql = "SELECT 
     user_id, 
     user_name, 
     user_level
     FROM
     users WHERE
     user_name = '".mysql_real_escape_string($_SESSION['user_name'])."'";
                         
$result = mysql_query($sql);
if(!$result)
{
echo 'Something went wrong while signing in. Please try again later.';
}
else
{  
while($row = mysql_fetch_array($result))
{
$_SESSION['signed_in'] = true;
$_SESSION['user_name']=$row['user_name'];
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['user_level'] = $row['user_level'];
}
                     
echo 'Welcome, ' . $_SESSION['user_name'] . '. <a href="index.php">Proceed to home page</a>.';
}
include 'footer.php';
 }