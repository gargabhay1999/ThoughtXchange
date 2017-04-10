<?php
session_start();
include 'connect.php';
include 'header.php';

$sql = "SELECT
          topic_id, 
	  topic_subject, 
	  topic_date,
	  topic_cat,
	  topic_by,
	  topic_description
        FROM
          topics
        WHERE
          topic_id ='". mysql_real_escape_string($_GET['id'])."' ";
 
$result = mysql_query($sql);

if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        while($row = mysql_fetch_array($result))
        {
            echo '<h2>Posts for discussion topic "' .$row['topic_subject']. '"</h2>
	    <hr>' .$row['topic_description']. '<br>
	    <p align="right">Asked on <b>' .
	    date('d-m-Y', strtotime($row['topic_date'])). '</b><hr><br>';
 
        $sql = "SELECT  
                    post_id,
                    post_content,
		    post_date,
                    post_topic,
		    post_by
                FROM
                    posts
                WHERE
                    post_topic ='".mysql_real_escape_string($_GET['id'])."' ";
         
        $result = mysql_query($sql);
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result)==0)
	    {
		echo 'There are no posts for this topic yet. <a href="post.php?id='. $row['topic_id']. '">Start posting!</a>';
	    }
	    else
	    {
		if(isset($_SESSION['signed_in'])&& ($_SESSION['signed_in']==true))
		{
		echo '<a href="post.php?id='. $row['topic_id']. '" align="right" class="item">Post an answer</a>';
		}
		while($row = mysql_fetch_array($result))
		{
		    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['post_by'])
		    {
			echo '<table class="userpost" border="1">
			<tr>
			<td class="reply">'.$row['post_content'].'</td>
			</tr>
			<tr>
			<td align="right">Posted by <b>you</b> at <b>'. date('d-m-Y (H:i:s A)', strtotime($row['post_date'])).
			'</b>
			</td></tr>
			</table>';
		    }
		    else
		    {
			$user = mysql_query("SELECT
			    	  user_name
				FROM
			    	  users
				WHERE user_id = '".$row['post_by']."' ");
			if(mysql_num_rows($user)!=0)
			{
			    while($row2 = mysql_fetch_array($user))
			    {
				echo '<table class="other" align="right" border="1">
				<tr class="reply">
				<td colspan="2">'.$row['post_content'].
				'</td>
				</tr>
				<tr>
				<td align="right">Posted by: <b>'.$row2['user_name'].'</b> on <b>'.
				 date('d-m-Y (h:i:s A)', strtotime($row['post_date'])).
				'</b>
				</td></tr>
				</table>';
			    }
			}
		    }
		}
	    }
        }
    }
  }
}
 
include 'footer.php';
?>