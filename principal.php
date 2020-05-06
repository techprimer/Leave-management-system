<?php 
ob_start(); 
require_once "header1.php";
//include "fetch_data.php" ;
$leave_id="";
if(isset($_GET['id']))
{
$leave_id = $_GET['id'];  
echo $leave_id;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if (isset($_POST['approved']))
{
    //$remark = $_POST['hod_remark'];
    $l_id = $_POST['approved'];
    $remark = $_POST['prn_remark'];
    $date = date('Y-m-d');
    $query = "UPDATE mt_leave SET PRINCIPAL_APPROVED = 'Approved',  PRINCIPAL_APPROVED_DATE = '$date', PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname', WHERE LEAVE_ID =$l_id  " ;
    $res = mysqli_query($conn , $query);
    if($res)
    {
          
          require 'vendor/autoload.php'; 
          $key = "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";
          $email = new \SendGrid\Mail\Mail();
          $email->setFrom("yashp6765@gmail.com", "Example User");
          $email->setSubject("application approved successfully");
          $email->addTo("yashp6765@gmail.com", "Example User");
          $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
          $email->addContent(
              "text/html", "<strong>application is approved by PRINCIPAL</strong>"
          );
          $sendgrid = new \SendGrid($key);
          try {
              $response = $sendgrid->send($email);
             // print $response->statusCode() . "\n";
            //  print_r($response->headers());
              //print $response->body() . "\n";
              //echo "Message has been sent successfully";
                                          echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
              //header("location:hod.php");
                                          
                                      }
          
          catch (Exception $e) {
              echo 'Caught exception: '. $e->getMessage() ."\n";
          }
           


    }
    else
    {
      echo "something went wrong please refresh page";
    }


}

  if (isset($_POST['rejected']))
{
    $remark = $_POST['prn_remark'];
    $l_id = $_POST['rejected'];
    $date = date('Y-m-d');
    $query = "UPDATE mt_leave SET L_TYPE='lwp',PRINCIPAL_APPROVED = 'Rejected',PRINCIPAL_APPROVED_DATE='$date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname'
             WHERE LEAVE_ID = $l_id";
    $res = mysqli_query($conn , $query);
    if($res)
    {

          require 'vendor/autoload.php'; 
          $key = "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";
          $email = new \SendGrid\Mail\Mail();
          $email->setFrom("yashp6765@gmail.com", "Example User");
          $email->setSubject("application approved successfully");
          $email->addTo("yashp6765@gmail.com", "Example User");
          $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
          $email->addContent(
              "text/html", "<strong>application is rejected by PRINCIPAL</strong>"
          );
          $sendgrid = new \SendGrid($key);
          try {
              $response = $sendgrid->send($email);
             // print $response->statusCode() . "\n";
             // print_r($response->headers());
             // print $response->body() . "\n";
              //echo "Message has been sent successfully";
                                          echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
              //header("location:hod.php");
                                          
                                      }
          
          catch (Exception $e) {
              echo 'Caught exception: '. $e->getMessage() ."\n";
          }
      echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is rejected\");}</script>";
    
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
      <div class="col-sm-2">
           
              <select name="dept_name" required="" class=" form-control1">
                <!--<option >slect any one leave</option>-->
                <option value="INFORMATION TECHNOLOGY">INFORMATION TECHNOLOGY</option>
                <option value="COMPUTER">COMPUTER</option>
              
                
              </select>
            </div>  
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
$dept_name = $_POST['dept_name'];

if($pick_date=="")  { $pick_date=date('2000-01-01');  }
if($drop_date=="")  { $pick_date= date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));  }
$query = "SELECT * FROM mt_leave where ( PRINCIPAL_APPROVED='Pending' AND HOD_APPROVED='Approved' ) AND L_TYPE = '$leave_type' 
           AND EMP_NO IN (SELECT EMP_NO FROM mt_emp WHERE DESIGNATION != 'principal' AND DEPARTMENT = '$dept_name')
            AND (( L_FROM  Between '$pick_date' AND '$drop_date' ) AND ( L_TO Between '$pick_date' AND '$drop_date')) order by L_FROM  ";
}
else
{
$pick_date = date('2000-01-01');
$drop_date = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));
$query = "SELECT * FROM mt_leave where PRINCIPAL_APPROVED='Pending' AND HOD_APPROVED='Approved'
        AND EMP_NO IN (SELECT EMP_NO FROM mt_emp WHERE DESIGNATION != 'principal') 
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
                  <th>Leave from</th>
                  <th>Leave to</th>
                  <th>REASON</th>
                  <th>STATUS</th>
                  <th>Remark</th>
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
                  <th scope="row"><?php echo $row['EMP_NO'] ?></th>
                  <td><?php echo $row['LEAVE_ID'] ?></td>
                  <td><?php echo $row['L_TYPE'] ?></td>
                  <td><?php echo $row['L_FROM']?></td>
                  <td><?php echo $row['L_TO'];?></td>
                  <td><?php echo $row['REASON'] ?></td>
                  <td><?php echo $row['HOD_APPROVED'] ?></td>

                  <form method="POST" >
                  <td><textarea rows="1" style="height:40px;" placeholder="type remark ... " name="prn_remark" ></textarea></td>
                  <td>
                  <?php 
                  if ($row['L_TYPE'] == 'medical leave') {
                   echo "<a href='medi_pr_view.php?id=" . $row['LEAVE_ID'] . "'>view</a>";
                  }
                  if ($row['L_TYPE'] == 'casual leave') {                     
                  echo "<a href='casual_pr_view.php?id=" . $row['LEAVE_ID'] . "'>view</a>";                   
                  }      
                  if($row['L_TYPE'] == 'outside official work') {                  
                    echo "<a href='od_pr_view.php?id=" . $row['LEAVE_ID'] . "'>view</a>";                       
                  } 
                  if($row['L_TYPE'] == 'credit work') {                   
                    echo "<a href='credit_pr_view.php?id=" . $row['LEAVE_ID'] . "'>view</a>";                        
                  } 
                  if($row['L_TYPE'] == 'coff') {                   
                    echo "<a href='coff_pr_view.php?id=" . $row['LEAVE_ID'] . "'>view</a>";                       
                  } 
       
                  ?>
                  
                  <button type="submit" id="button" class="col-sm-2 btn btn-info" name="approved" value="<?php echo $row['LEAVE_ID'] ?>" style="background: lightgreen;color: black;width: 35%; text-align: center;"/>approved</button><span>  </span>
                    <button type="submit" id="button" class="col-sm-2 btn btn-info" name="rejected" value="<?php echo $row['LEAVE_ID'] ?>" style="background: red;color: black;width: 35%; margin-left: 20px; text-align: center;">Rejected</button></td>
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
