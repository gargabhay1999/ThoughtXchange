<?php
session_start();
include 'header.php';
include 'connect.php';
echo '<h3>Change Password</h3>';
if(isset($_SESSION['signed_in'])&& $_SESSION['signed_in']==true)
{
if(!$_POST)
{
	echo '<form method="post" action="">
		<table>
		<tr><td class>Current password:</td>
		<td><input type="password" name="pass" required></td>
		</tr>
		<tr><td>Enter new password:</td>
		<td><input type="password" name="new_pass" required></td>
		</tr>
		<tr><td>Retype new password:</td>
		<td><input type="password" name="re_pass" required></td>
		</tr>
		<tr><td colspan="2"><input type="submit" value="Change Password">
		</table>
		</form>';
}
else
{
	$pass=$_POST['pass'];
	$res=mysql_query("SELECT user_pass from users where user_name='".$_SESSION['user_name']."'");
	if(!$res)
	{
		echo "Unable to proceed. Try again later";
	}
	else
	{
		while($row=mysql_fetch_array($res))
		{
			if($pass=$row['user_pass'])
			{
			   if($_POST['new_pass']==$_POST['re_pass'])
			   {
				$sql1="UPDATE users SET user_pass='".sha1($_POST['new_pass'])."' WHERE user_name='".$_SESSION['user_name']."'";
				$result=mysql_query($sql1);
				if(!$result)
				{
				   echo "Failed to update password";
				}
				else
				{
				   echo "Password updated successfully";
				}
			   }
			}
		}
	}
}
}
else
{
	echo "You are not signed in. Please <a href='signin.php'>sign in</a> to continue.";
}
include 'footer.php';
?>