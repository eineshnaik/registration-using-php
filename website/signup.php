<?php

require_once("db.php");
$userid_error="";
$firstname_error="";
$lastname_error="";
$email_error="";
$password_error="";
$u="";


if(isset($_POST['submit']))           
{$userid=$_POST['userid'];
			$ConnectingDB;
			$sql="SELECT * FROM user_record WHERE userid='$userid'";
			$stmt=$ConnectingDB->query($sql);
			while($DataRows=$stmt->fetch())
			{
			$u=$DataRows['userid'];
	        }

	        var_dump($u);
	if(empty($_POST["userid"]))         //userid
	{
		$userid_error="user id is required";
	}
	else
	{
		if(!preg_match("/^[A-Za-z0-9\. ]*$/", $_POST["userid"]))
		{
			$userid_error="only letters and numbers are accepted";
		}
		else
		{   
			if($userid==$u)
			{
				$userid_error="userid already exist";
			}
		}
	}


	if(empty($_POST["firstname"]))        //firstname
	{
		$firstname_error="first name is required";
	}
	else
	{
		if(!preg_match("/^[A-Za-z ]*$/", $_POST["firstname"]))
		{
			$firstname_error="only letters are accepted";
		}
	}


	if(empty($_POST["lastname"]))         //lastname
	{
		$lastname_error="last name is required";
	}
	else
	{
		if(!preg_match("/^[A-Za-z ]*$/", $_POST["lastname"]))
		{
			$lastname_error="only letters are accepted";
		}
	}


	if(empty($_POST["email"]))           //email
	{
		$email_error="email id is required";
	}
	else
	{
		if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/", $_POST["email"]))
		{
			$email_error="invalid email format";
		}
	}



	if(empty($_POST["password"]) || empty($_POST["password2"]))       //password
	{
		$password_error="password is required";
	}
	else
	{
		if($_POST['password'] != $_POST["password2"])
		{
			$password_error="password is incorrect";
		}
	}

	if(!empty($_POST['userid']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {    if((preg_match("/^[A-Za-z0-9\. ]*$/", $_POST["userid"])==true) && (preg_match("/^[A-Za-z ]*$/", $_POST["firstname"])==true) && (preg_match("/^[A-Za-z ]*$/", $_POST["lastname"])==true) && (preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/", $_POST["email"])==true) && ($_POST['password'] == $_POST["password2"]))

	     {

	     	if($userid!=$u)
	     	{
	         $userid=$_POST['userid'];
	          $firstname=$_POST['firstname'];
	          $lastname=$_POST['lastname'];
	          $email=$_POST['email'];
	          $password=$_POST['password'];


	          $ConnectingDB;
	          $sql="INSERT INTO user_record(userid,firstname,lastname,email,password) 
	           VALUES (:useriD,:firstnamE,:lastnamE,:emaiL,:passworD) ";

	          $stmt=$ConnectingDB->prepare($sql);
	          $stmt->bindValue(':useriD',$userid);
	          $stmt->bindValue(':firstnamE',$firstname);
	          $stmt->bindValue(':lastnamE',$lastname);
	          $stmt->bindValue(':emaiL',$email);
	          $stmt->bindValue(':passworD',$password);

	          $exe=$stmt->execute();

	          if($exe)
	          {
		          echo "Account created Successfully";
	          }
	        }
         }
    }
}






?>






<html>
<head>
    <title>
    	signup
    </title>
    <style type="text/css">
    	#a{
    		background-color: rgb(221,216,212) ;
    	}
    </style>

</head>

<body>
	<h2 id="a">Signup</h2>
	<form action="signup.php" method="POST">
		<fieldset id="a">
		<label>Userid:</label><br>
		<input type="text" name="userid"><?php echo $userid_error; ?><br>

		<label>First Name</label><br>
		<input type="text" name="firstname"><?php echo $firstname_error; ?><br>
		<label>Last Name</label><br>
		<input type="text" name="lastname"><?php echo $lastname_error; ?><br>

		<label>E-mail id</label><br>
		<input type="text" name="email"><?php echo $email_error; ?><br>

		<label>Password</label><br>
		<input type="password" name="password"><?php echo $password_error; ?><br>

		<label>Confirm Password</label><br>
		<input type="password" name="password2"><?php echo $password_error; ?><br>

		<input type="submit" name="submit" value="submit"><br>

		already have a account? <a href=""><button>Log in</button></a>

		
		</fieldset>
	</form>
</body>
</html>