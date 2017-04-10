<?php
session_start();
include 'connect.php';
include 'header.php';

 
echo '<h3>Sign in</h3>';
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}

//on 29th line <td><input type="submit" name="action" value="Forgot Password?"</td>
else
{
    if(!$_POST)
    {
        echo '<form method="post" action="">
	<table>
        <tr> 
	<td>Username:</td>
	<td><input type="text" name="user_name" id="name" required placeholder="Username"></td>
	</tr>
        <tr>
	<td>Password:</td>
	<td><input type="password" name="user_pass" placeholder="Password"></td>
        <tr>
	<td colspan="2"><input type="submit" name="action" align="right" value="Sign in"></td>
	
	</tr>
        </table>
	</form>';
    }
    elseif($_POST['action']!='Sign in')
	{
	    $_SESSION['user_name']=$_POST['user_name'];
	    include 'password.php';

	}
    else
        {
            $sql = "SELECT 
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" . mysql_real_escape_string($_POST['user_name']) . "'
                    AND
                        user_pass = '" . sha1($_POST['user_pass']) . "'";
                         
            $result = mysql_query($sql);
            if(!$result)
            {
                echo 'Something went wrong while signing in. Please try again later.';
            }
            else
            {
                if(mysql_num_rows($result) == 0)
                {
                    echo 'You have supplied a wrong user/password combination. Please try again.';
                }
                else
                {
                    $_SESSION['signed_in'] = true;
                     
                    while($row = mysql_fetch_array($result))
                    {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }
                     
                    echo '<meta http-equiv="refresh" content="0;URL=index.php"';
                }
           }
      }
}      
 
include 'footer.php';
?>