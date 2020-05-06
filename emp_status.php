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

$sql1 = "SELECT * FROM mt_leave WHERE  LEAVE_ID = '$l_id'  ";
$result = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row1 = mysqli_fetch_array($result))
		 {
       
		 		$hod_app = $row1['HOD_APPROVED'];
		 		$pr_app = $row1['PRINCIPAL_APPROVED'];
		 		$cancel_flag = $row1['Cancel_Flg'];
		 	
}
}

    if((  $hod_app =="Pending"  ) &&  ( $pr_app =="Pending"  )  &&  ( $cancel_flag!="YES"  ))
    {
    $query = "UPDATE mt_leave SET HOD_APPROVED = 'Cancelled',PRINCIPAL_APPROVED = 'Cancelled',Cancel_Flg  = 'YES'
                     WHERE LEAVE_ID = '$l_id' ";
    $res = mysqli_query($conn , $query);
    if($res)
    {
              echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is cancelled\");}</script>";
              
    }  
    else
    {
      echo "something went wrong please refresh page";
    }}
    else {
     
      echo "<script type='text/javascript'>  window.onload = function(){alert(\"sorry action has already be done on this leave\");}</script>";
    	
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

<form method="POST" class="form-horizontal">
<div class="form-grids " data-example-id="basic-forms"> 	
<div class="form-group">
    <div class="col-sm-2"><input type="date" name="pick_date" id="pick_date" class=" form-control1"></div>
    <div class="col-sm-2">            <input type="date" name="drop_date" id="drop_date" class=" form-control1"></div>
    <div class="col-sm-2"><select name="leave_type"  class=" form-control1">
                <!--<option >slect any one leave</option>-->
                <option value="medical leave">medical leave</option>
                <option value="casual leave">casual leave</option>
                <option value="credit leave">credit leave</option>
                <option value="coff"> compensatory leave</option>
                <option value="outside official work">outside official work </option>
                <option value="other_than_casual"></option>
                
          
               


             </select></div>
    
    <div class="col-sm-1"><input type="submit" style="background: orange;color: white; text-align: center;" class=" btn btn-info"
     name="search" value="search record"></div>
</div>
</div>
</form> 
</body>
</html>
<?php


if(isset($_POST['search']))
{
$pick_date = $_POST['pick_date'];
$drop_date = $_POST['drop_date'];
$leave_type = $_POST['leave_type'];


if($pick_date=="")  { $pick_date=date('2000-01-01');  }
if($drop_date=="")  { $pick_date= date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));  }
$query = "SELECT * FROM mt_leave where  L_TYPE = '$leave_type' 
            AND  EMP_NO  ='$empname'
            AND (( L_FROM  Between '$pick_date' AND '$drop_date' ) AND ( L_TO Between '$pick_date' AND '$drop_date')) order by L_FROM  ";
}
else
{
$pick_date = date('2000-01-01');
$drop_date = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));
$query = "SELECT * FROM mt_leave where 
            EMP_NO  ='$empname'
          AND (( L_FROM  Between '$pick_date' AND '$drop_date' ) AND ( L_TO Between '$pick_date' AND '$drop_date')) order by L_FROM  ";

}

$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		



?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style type="text/css">
    
  </style>
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
                  <th>From</th>
                  <th>To</th>
                  <th>Total Days</th>
                  <th>REASON</th>
                  <th>HOD REMARKS</th>
                  <th>HOD APPROVAL STATUS</th>
                  <th>PRINCIPAL REMARKS</th>
                  <th>PRINCIPAL APPROVAL STATUS</th>
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


  ?>
   <tbody>
                <tr>
                <form method="POST" onsubmit=" confirm('Are you sure you want to delete this applied form?');" >
                  <th scope="row"><?php echo $row['EMP_NO'] ?></th>
                  <td><?php echo $row['LEAVE_ID']; ?></td>
                  <td><?php echo $row['L_TYPE']; ?></td>
                  <td><?php echo $row['L_FROM']; ?></td>
                  <td><?php echo $row['L_TO']; ?></td>
                  <td><?php echo $row['NO_OF_DAYS']; ?></td>

                  <td><?php echo $row['REASON']; ?></td>
                 
                  <td><?php echo $row['HOD_REMARKS']; ?></td>
                  <td><?php echo $row['HOD_APPROVED']; ?></td>
                  <td><?php echo $row['PRINCIPAL_REMARKS']; ?></td>
                  <td><?php echo $row['PRINCIPAL_APPROVED']; 
                  if (($row['HOD_APPROVED'] == "Pending") && ($row['PRINCIPAL_APPROVED'] == "Pending"))
                  {
                  
                    $showDivFlag=true;
                  
                  }
                  else {
                    $showDivFlag=false;
                  }
                  ?></td>
                  <td>
                  
                  <button type="submit" id="button"  class=" btn btn-info" name="delete" value="<?php echo $row['LEAVE_ID'] ?>"
                   style="background: orange;color: white; text-align: center;display:<?php if($showDivFlag == TRUE)  {  echo "block";  }  else{ echo "none";  } ?>">
                   Delete</button><span>  </span>

                   </td>
                   </form>
                </tr>
    </tbody>

      
<?php
}
}?>

</table>
</div>
</div>
</div>
</div>
 

</body>
</html>
