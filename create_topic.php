<?php
session_start();
include 'connect.php';
include 'header.php';

echo '<h3>Create a Topic</h3>';
if((isset($_SESSION['signed_in'])&& $_SESSION['signed_in'])==0)
{
    echo 'Sorry, you are not signed in. Please <a href="/IWP Project/signin.php">sign in</a> to continue.';
}
else
{
    if(!$_POST)
    {   
        
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
                    Subject: <input type="text" name="topic_subject" /><br>
                    Category:'; 
                 
                echo '<select name="topic_cat" class="dropdown">';
                    while($row = mysql_fetch_array($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select><br>';
                     
                echo 'Message: <br><textarea name="topic_description" /></textarea><br>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else
    {
        $query  = "BEGIN WORK;";
        $result = mysql_query($query);
         
        if(!$result)
        {
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
     
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by,
				topic_description)
                   VALUES
			('" . mysql_real_escape_string($_POST['topic_subject']) . "',
                               NOW(),
                               " . mysql_real_escape_string($_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . ",
                               '" . mysql_real_escape_string($_POST['topic_description']) . "')";
                      
            $result = mysql_query($sql);
            if(!$result)
            {
                echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
                $sql = "ROLLBACK;";
                $result = mysql_query($sql);
            }
            else
            {
                $topicid = mysql_insert_id();
                    $sql = "COMMIT;";
                    $result = mysql_query($sql);
                     
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
               
            }
        }
    }
}
 
include 'footer.php';
?>