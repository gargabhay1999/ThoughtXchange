<!DOCTYPE html>
<head>
    <title>Discussion forum</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="Discuss.png" />
</head>
<body>
<div id="menu">
     <a class="item" href="index.php">Home</a> 
      
     <?php
     if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] && $_SESSION['user_level']==1)
     {
	     echo '<a class="item" href="add_admin.php">Add admin</a>';
	     echo '<a class="item" href="create_cat.php">Create new category</a>';
     }
     echo '<a class="item" href="create_topic.php">Create new topic</a>';
     echo '<a class="item" href="change_pass.php">Change Password</a>';
     echo '<div id="userbar">';
     if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
     {
	if($_SESSION['user_level']==1)
	{
	    echo 'Welcome Admin ';
	}
	else
	{
            echo 'Hello ' . $_SESSION['user_name'] . '.  Not you? ';
	}
	echo '<a href="signout.php" class="item"> Sign out</a>';
     }
     else
     {
        echo '<a href="signin.php" class="item">Sign in</a> or <a href="signup.php" class="item">Create an Account</a>';
     }
	?>
	</div>
    	</div>
<div id="wrapper">
<h1>ThoughtXchange</h1>
        <div id="content">