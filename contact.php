<?php
$name=$_POST['fname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$message=$_POST['message'];
if(!empty($name)||!empty($email)||!empty($message)||!empty($phone))
{
$host="localhost";
$username="root";
$password="";
$dbname="contact";
$conn=new mysqli($host,$username,$password,$dbname);
if(mysqli_connect_error())
{
die('Connect Error(.mysqli_connect_errno().')'.mysqli_connect_error());
}
else
{
$select="SELECT phone from clients where phone=? Limit 1";
$insert="INSERT into clients(name,phone,email,message) values(?,?,?,?);
$stmt=$conn->prepare($select);
$stmt->bind_param("i",$phone);
$stmt->execute();
$stmt->bind_result($phone);
$stmt->store_result();
$rnum=$stmt->num_rows;
if($rnum==0)
{
$stmt->close();
$stmt=$conn->prepare($insert);
$stmt->bind_param("siss",$name,$phone,$email,$message);
$stmt->execute();
echo "Message Recorded";
}
else
{
 echo"Someone already conveyed the message";
}
$stmt->close;
$conn->close;
}
else
{
echo "All field are required";
die();
}
?>