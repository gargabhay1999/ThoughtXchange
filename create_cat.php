<?php
session_start();
include 'header.php';
include 'connect.php';

echo '<h3>Create a Category</h3>';

if((isset($_SESSION['signed_in'])&& $_SESSION['signed_in'])==false)
{
    echo 'Sorry, you are not signed in. Please <a href="signin.php">sign in</a> to continue.';
}
else if($_SESSION['user_level']==1)
{
  if(!$_POST)
  {
       echo "<form method='post' action=''>
        Category name: <br>
	<input type='text' name='cat_name' class='text' required><br>
        Category description: <br>
	<textarea name='cat_description' class='text'></textarea>
        <br><input type='submit' value='Add category' class='text'/>
       </form>";
  }
  else
  {
    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('". mysql_real_escape_string($_POST['cat_name'])."',
             '". mysql_real_escape_string($_POST['cat_description'])."')";
    $result = mysql_query($sql);

    if(!$result)
    {

        echo 'Error' . mysql_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
  }
}
else
{
	echo "Only admin can create new categories";
}
include 'footer.php';
?>