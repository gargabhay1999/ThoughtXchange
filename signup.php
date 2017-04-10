<?php
session_start();
include 'header.php';
include 'connect.php';
 
echo '<h3>Sign up</h3>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '<form method="post" action="">
	<table>
	<tr>
        <td>Username:</td>
	<td><input type="text" name="user_name" placeholder="Username"></td>
	</tr>
	<tr>
	<td>Password:</td>
	<td><input type="password" name="user_pass" placeholder="**********"></td>
	</tr>
	<tr>
        <td>Retype Password:</td>
	<td><input type="password" name="user_pass_check" placeholder="**********"></td>
        </tr>
	<tr>
	<td>E-mail:</td>
	<td><input type="email" name="user_email" placeholder="example@example.com"></td>
	</tr>
	<tr colspan="2">
	<td><input type="submit" value="Sign-Up"></td>
	</table>
	</form>';
}
else
{

    $errors = array();
     
    if(isset($_POST['user_name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
     
     
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
    }
     
    if(!empty($errors))
    {
        echo 'A couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value)
        {
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    }
    else
    {
        $sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level)
                VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysql_real_escape_string($_POST['user_email']) . "',
                        NOW(),
                        0)";
                         
        $result = mysql_query($sql);
        if(!$result)
        {
            echo 'Something went wrong while registering. Please try again later.';
        }
        else
        {
            echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
        }
    }
}
 
include 'footer.php';
?>