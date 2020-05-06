
<?php 
ob_start(); 
require_once "header1.php";

$leave_id="";
if(isset($_GET['id']))
{
$leave_id = $_GET['id'];  
echo $leave_id;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if (isset($_POST['delete']))
{
    //$remark = $_POST['hod_remark'];
    $l_id = $_POST['delete'];

    $date = date("Y-m-d");
    $total_days= $_POST['total_days'];

    $query = "UPDATE mt_leave SET HOD_APPROVED = 'Cancelled',PRINCIPAL_APPROVED = 'Cancelled',Cancel_Flg  = 'YES'
                     WHERE LEAVE_ID = '$l_id' ";
      $res = mysqli_query($conn , $query);
    if($res)
    {
              echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
              header("location:pending_leave.php");
    }  
    else
    {
      echo "something went wrong please refresh page";
    }
}
}


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form method="POST">
            <input type="date" name="pick_date" id="pick_date">
            <input type="date" name="drop_date" id="drop_date">
            <input type="submit" name="search" value="search record">
</form> 
</body>
</html>
<?php

if(isset($_POST['search']))
{
$pick_date = $_POST['pick_date'];
$drop_date = $_POST['drop_date'];
}
else
{
$pick_date = date('2000-01-01');
$drop_date = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));

}
//$query = "SELECT * FROM mt_leave WHERE HOD_APPROVED='Pending' AND EMP_NO IN (SELECT EMP_NO FROM mt_emp WHERE DEPARTMENT = '$department'  AND  DESIGNATION != 'hod' AND  DESIGNATION != 'principal' )";
//$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
$query = "SELECT * FROM mt_leave WHERE HOD_APPROVED='Pending' AND EMP_NO  ='$emp_no' 
          AND  L_FROM  Between '$pick_date' AND '$drop_date' order by L_FROM  ";
$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style type="text/css">   </style>
</head>
<body>
  <div id="page-wrapper">
      <div class="main-page">
        <div class="tables">         
          <div class="panel-body widget-shadow">         
           <h4>Employee Applied leave</h4>
           
            <table class="table">
              <thead>
                <tr>
                  <th>EMP_NO</th>
                  <th>LEAVE_ID</th>
                  <th>LEAVE TYPE</th>
                  <th>Leave from</th>
                  <th>Leave to</th>
                  <th>Total Days</th>
                  <th>REASON</th>
                 <th>STATUS</th>
              
                  <th>Action</th>              
                </tr>
              </thead>
  <?php
  while ($row = mysqli_fetch_array($result))
     {
          $_SESSION['EMP_NO'] = $row['EMP_NO'];
          $_SESSION['LEAVE_ID'] = $row['LEAVE_ID'];
          $_SESSION['l_from'] = $row['L_FROM'];
          $_SESSION['l_to'] = $row['L_TO'];
          $_SESSION['total_days'] = $row['NO_OF_DAYS'];
          $_SESSION['reason'] = $row['REASON'];
          $_SESSION['applied_on'] = $row['APPLIED_ON'];
          $_SESSION['HOD_APPROVED'] = $row['HOD_APPROVED'];
          
  ?>
   <tbody>
                <tr>
                <form method="POST" onsubmit=" confirm('Are you sure you want to delete this applied form?');" >
                  <th scope="row"><?php echo $row['EMP_NO']; ?></th>
                  <td><?php echo $row['LEAVE_ID']; ?></td>
                  <td><?php echo $row['L_TYPE']; ?></td>
                  <td><?php echo $row['L_FROM'];?></td>
                  <td><?php echo $row['L_TO'];?></td>
                  <td><input type="hidden" name="total_days" value="<?php echo $row['NO_OF_DAYS'];?>"><?php echo $row['NO_OF_DAYS'];?></td>
                  <td><?php echo $row['REASON']; ?></td>
                 <td><?php  echo $row['HOD_APPROVED']; ?></td>               
                  <td>
                  <button type="submit" id="button" class=" btn btn-info" name="delete" value="<?php echo $row['LEAVE_ID'] ?>"
                   style="background: orange;color: white; text-align: center;">Delete</button><span>  </span>
                   </td>
                
                  </form>
                </tr>
    </tbody>

      
<?php
}


}ob_flush();?>

</table>
<div class="filter_data">
  
</div>

</div>
</div>
</div>
</div>

</body>
</html>
