<?php
session_start();

if (isset($_POST['submit'])){


include_once 'database.php';



$conn=mysqli_connect($servername,$username,$password,$dbname);
/*  $first = $_POST['fName'];  */

$password = $_POST['password'];
$username = $_POST['username'];

  if (empty($password) ||empty($username)){
       header("Location: ../signin.php?signin=empty");
  	   exit();
  }

  else{
  	   $sql="SELECT * FROM tbl_staffs_a161129_pt2 WHERE username='$username'";
	   $result=mysqli_query($conn,$sql);
	   $resultCheck=mysqli_num_rows($result);
	   if ($resultCheck<1){
	   	   header("Location: ../signin.php?signin=error");
  	   	   exit();
	   }
	   else {
	  //  		if ($row=mysqli_fetch_assoc($result)){
			//    $hashedPwdCheck=password_verify($password,$row['password']);
			// }
	   	$row=mysqli_fetch_assoc($result);
				 if ($password!=$row['password']){
				 	 header("Location: ../signin.php?signin=pwerror");
  	   	  			  exit();
				 }
				 else{
				 	  $_SESSION['u_username']=$row['username'];
				 	  $_SESSION['u_id']=$row['id'];
					  $_SESSION['u_name']=$row['sname'];
					  $_SESSION['u_gender']=$row['gender'];
					  $_SESSION['u_email']=$row['email'];
					  $_SESSION['u_password']=$row['password'];
				 	  header("Location: ../?signin=success");
  	   	  			  exit();
				 }


	   }
  }


}
 else{
     	 header("Location: ../signin.php");
    	 exit();
   }
