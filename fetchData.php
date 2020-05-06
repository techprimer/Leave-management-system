<?php


$host = "localhost";    /* Host name */
$user = "root";         /* User */
$password = "";         /* Password */
$dbname = "leaves";   /* Database name */

// Create connection
$con = mysqli_connect($host, $user, $password,$dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM mt_emp WHERE F_NAME like'%".$search."%'";
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array("value"=>$row['EMP_NO'],"label"=>$row['F_NAME']." ".$row['M_NAME']." ".$row['L_NAME']." - ".$row["DEPARTMENT"]);
   // check depatment of of atd_emp and session emp no on server side  using onclick() on submit button
 }

 echo json_encode($response);
}
mysqli_close($con); 
exit;
?>