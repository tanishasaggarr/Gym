<?php
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$address=$_POST['address'];
$phoneno=$_POST['phone'];
if(!empty($firstname)||!empty($lastname)||!empty($address)||!empty($phoneno))
{
$host="localhost";
$username="root";
$password="";
$dbname="clients";
$conn=new mysqli($host,$username,$password,$dbname);
if(mysqli_connect_error())
{
die('Connect Error(.mysqli_connect_errno().')'.mysqli_connect_error());
}
else
{
$select="SELECT phone from clients where phone=? Limit 1";
$insert="INSERT into clients(fname,lname,address,phone) values(?,?,?,?);
$stmt=$conn->prepare($select);
$stmt->bind_param("i",$phoneno);
$stmt->execute();
$stmt->bind_result($phoneno);
$stmt->store_result();
$rnum=$stmt->num_rows;
if($rnum==0)
{
$stmt->close();
$stmt=$conn->prepare($insert);
$stmt->bind_param("sssi",$firstname,$lastname,$address,$phoneno);
$stmt->execute();
echo "New record inserted successfully";
}
else
{
 echo"Someone already registered";
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