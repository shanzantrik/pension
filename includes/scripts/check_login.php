<?php ob_start();include('dbconnect.php');
session_start();
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql="Select count(*) as cnt from users where username='$username' and password='$password' and status=0";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if($row['cnt']==1){
	$_SESSION['username']=$username;
	$_SESSION['logged-in']=true;
	header('location:../dashboard.php');
}
else
{
	header('location:../index.php?msg='.base64_encode('Invalid Username or Password'));
}

 ?>