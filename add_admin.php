<?php
session_start();
include 'header.php';
include 'connect.php';
if(!$_POST)
{
	echo 'Select user-id for the user you want to make an admin:<br>';
	echo '<form method="post" action="">
		<input type="number" name="userID" required><br>
		<input type="submit" value="Add as admin">';
}
else
{
	$sql="SELECT user_name,user_level from users WHERE user_id='".$_POST['userID']."'";
	$result=mysql_query($sql);
	if(!$result)
	{
		echo "Error: ".mysql_error();
	}
	else
	{
		if(mysql_num_rows($result)==0)
		{
			echo "The given user ID does not exist";
		}
		else
		{
			while($row=mysql_fetch_array($result))
			{
				if($row['user_level']==1)
				{ echo "Already an admin.";}
				else
				{
				$sql1="UPDATE users SET user_level = 1 WHERE user_id='".$_POST['userID']."'";
				$result1=mysql_query($sql1);
				if(!$result1)
				{ echo "An error occured. Try again";}
				else
				{
					echo "The user ".$row['user_name']." is now an Admin";
				}
				}
			}
		}
	}
} 
include 'footer.php';
?>