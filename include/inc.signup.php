<?php
if (isset($_POST['submit'])){


include_once 'database.php';



$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
/*  $first = $_POST['fName'];  */
$first = $_POST['fName'];
$last = $_POST['lName'];
$email =$_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

  if (empty($first) || empty($last) ||empty($password) ||empty($username)){
       header("Location: ../main.php?signup=empty");
  	   exit();
  }
  else{
  	   if (!preg_match("/^[a-zA-Z\s]*$/",$first) || !preg_match("/^[a-zA-Z\s]*$/",$last)){
	   	         header("Location: ../main.php?signup=invalid");
				 exit();
	   }
	   else{
	   		if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
			   	 header("Location: ../main.php?signup=email");
				 exit();
			}


    	   else{
    	   		$sql="SELECT * FROM users WHERE username='$username'";
    			$result=mysqli_query($conn,$sql);
    			$resultCheck=mysqli_num_rows($result);
    			echo $resultCheck;
    			if ($resultCheck>0){
    			    header("Location: ../main.php?signup=usertaken");
    				exit();
    			}
    			else{
    				 $hashedPwd=password_hash($password,PASSWORD_DEFAULT);
					 $sql="INSERT INTO users (username, password,fName,lName,email) VALUES ('$username', '$hashedPwd', '$first', '$last', '$email')";
					 $result= mysqli_query($conn,$sql);
					 header("Location: ../main.php?signup=success");
    				 exit();
    				 }
	  		 }
  	   }
  }
}
else {
	 header("Location: ../main.php");

	 exit();
}
