<?php
session_start();
include 'header.php';
include 'connect.php';
 
$sql = "SELECT 
	  cat_id, 
	  cat_name, 
	  cat_description 
	FROM 
	  categories";
 
$result = mysql_query($sql);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        echo '<table class="table">
              <tr>
                <th align="center">Category</th>
                <th align="center">Last topic</th>
              </tr>'; 
             
        while($row = mysql_fetch_array($result))
        {               
            echo '<tr>
            	<td class="leftpart">
            	<h3><a href="category.php?id='.$row['cat_id'].'">'.$row['cat_name'].'</a></h3>
		<center>'.$row['cat_description'].'</center><hr>
                </td>
                <td class="rightpart">';
		$sql1="SELECT topic_id, 
			topic_subject 
			FROM topics 
			WHERE topic_cat='".$row['cat_id']."' 
			ORDER BY topic_date DESC LIMIT 1";
		$res=mysql_query($sql1);
		if(!$res)
		{
		   echo "Error";
		}
		else
		{
		   if(mysql_num_rows($res)==0)
		   {
			echo "No topics yet";
		   }
		   else
		   {
			while($row1=mysql_fetch_array($res))
			{
              		    echo '<a href="topic.php?id='.$row1['topic_id'].'">'.$row1['topic_subject'].'</a>';
			}
		   }
		}
 
                echo'</td>
            	</tr>';
        }
	echo '</table>';
    }
}
include 'footer.php';
?>