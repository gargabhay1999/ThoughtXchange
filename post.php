<?php
session_start();
include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && ($_SESSION['signed_in'])==false)
{
	echo 'You must be signed in to post a reply.';
}
else
{
    	if(!$_POST)
	{
	echo ' <form method="post" action="">
		<textarea name="post_content" /></textarea>
		<br><input type="submit" value="Submit" />
		</form>';
	}
	else
	{
 	$query = "BEGIN WORK;";
	$result = mysql_query($query);
	if(!$result)
	{
		echo 'An error occured. Please try again later';
	}
	else
	{
        	$sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . mysql_real_escape_string($_POST['post_content']) . "',
                        NOW(),
                        '" . mysql_real_escape_string($_GET['id']) . "',
                        '" . $_SESSION['user_id'] . "')";
                         
        $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
	    $sql = "ROLLBACK;";
	    $result = mysql_query($sql);
        }
        else
        {
		$sql = "COMMIT;";            
		$result = mysql_query($sql);
		echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
      }
   }
 }
include 'footer.php';
?>