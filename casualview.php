<?php
ob_start(); 
include_once  "header1.php";

$leave_id="";
if(isset($_GET['id']))
{
$leave_id = $_GET['id'];	
}



$sql = "SELECT F_NAME,M_NAME,L_NAME,EMP_NO,mt_grade_mst.DESIGNATION,mt_dept_mst.dept_nm 
		FROM mt_emp  INNER JOIN mt_grade_mst ON mt_emp.GRADE_ID = mt_grade_mst.GRADE_ID  
		INNER JOIN mt_dept_mst ON mt_emp.dept_id = mt_dept_mst.dept_id   
		WHERE EMP_NO = '" . $_SESSION['EMP_NO'] . "'";
$result = mysqli_query($conn , $sql)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row = mysqli_fetch_array($result))
		 {
			
		 		$firstname = $row['F_NAME'];
		 		$middlename = $row['M_NAME'];
		 		$lastname = $row['L_NAME'];
		 		$emp_no  = $row['EMP_NO'];
		 		$designation = $row['DESIGNATION'];
				$department = $row['dept_nm'];
				
				
		 }
	}		



$sql1 = "SELECT * FROM mt_leave WHERE  LEAVE_ID = '$leave_id'  AND   L_TYPE = 'casual leave' ";
$result = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row1 = mysqli_fetch_array($result))
		 {
		 		$l_from = $row1['L_FROM'];
		 		$l_to = $row1['L_TO'];
		 		$applied_on = $row1['APPLIED_ON'];
		 		$reason = $row1['REASON'];
				$total_days = $row1['NO_OF_DAYS'];
				 
}
}



//difficulty in foeming sql1
$sql2 = "SELECT * FROM  casual_leave  WHERE  LEAVE_ID = '$leave_id'  ";
$result2 = mysqli_query($conn , $sql2)or die( mysqli_error($conn));
if (mysqli_num_rows($result2) > 0) 
{
		while ($row2 = mysqli_fetch_array($result2))
		 {
				 //type_of_day,atd_emp_no,atd_name,half_day_date,prefix_suffix
				 $type = 			$row2['type_of_day'];
				 $atd_emp_no =  	$row2['atd_emp_no'];
				 $atd_name = 		$row2['atd_emp_name'];
				 $half_day_date =   $row2['half_day_date'];
				 $prefix_suffix =   $row2['permission'];
				 
}
}

//difficulty in foeming sql1
$sql4 = "SELECT * FROM  mt_emp  WHERE  EMP_NO = '$emp_no'  ";
$result4 = mysqli_query($conn , $sql4)or die( mysqli_error($conn));
if (mysqli_num_rows($result4) > 0) 
{
		while ($row4 = mysqli_fetch_array($result2))
		 {
				 //type_of_day,atd_emp_no,atd_name,half_day_date,prefix_suffix
				 $recevier_email =  $row4['EMAIL_ID'];
				 
}
}

//difficulty in foeming sql1
$sql5 = "SELECT * FROM  mt_emp  WHERE  EMP_NO = '$empname'  ";
$result5 = mysqli_query($conn , $sql5)or die( mysqli_error($conn));
if (mysqli_num_rows($result5) > 0) 
{
		while ($row5 = mysqli_fetch_array($result2))
		 {
				 //type_of_day,atd_emp_no,atd_name,half_day_date,prefix_suffix
				 $sender_email =  $row5['EMAIL_ID'];
				 
}
}

$row['EMP_NO'] = $_SESSION['EMP_NO'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (isset($_POST['approved']))
{	
	$hod_date=$_POST['hod_date'];
	$total_days=$_POST['total_days'];
	$remark = $_POST['hod_remark'];
	if ($total_days < 6)
	{
    	$query = "UPDATE mt_leave SET HOD_APPROVED = 'Approved',HOD_APPROVED_DATE = '$hod_date',HOD_REMARKS='$remark',HOD_APP_ID='$empname',
					PRINCIPAL_APPROVED = 'Approved',PRINCIPAL_APPROVED_DATE = '$hod_date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname',
					ADM_APPROVED  = 'Approved',ADM_APPROVED_DATE = '$hod_date', ADM_REMARKS ='$remark',ADM_ID='$empname'
					 WHERE LEAVE_ID = '$leave_id' ";
		$res = mysqli_query($conn , $query);
	}
	else
	{
		$query = "UPDATE mt_leave SET HOD_APPROVED = 'Approved',HOD_APPROVED_DATE = '$hod_date',HOD_REMARKS='$remark',HOD_APP_ID='$empname' WHERE LEAVE_ID = '$leave_id' ";
		$res = mysqli_query($conn , $query);
	}
    if($res)
    {
		// key = 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

		require 'vendor/autoload.php'; 
		$key = "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";
		$email = new \SendGrid\Mail\Mail();
		$email->setFrom("nikhil.jakharia@sakec.ac.in", "Example User");
		$email->setSubject("application rejected successfully");
		$email->addTo("nikhil.jakharia@sakec.ac.in", "Example User");
		$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
		$email->addContent(
			"text/html", "<strong>application for casual leave has been approved by hod</strong>"
		);
		$sendgrid = new SendGrid($key);
		try {
			$response = $sendgrid->send($email);
			print $response->statusCode() . "\n";
			print_r($response->headers());
			print $response->body() . "\n";
			echo "Message has been sent successfully";
										echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
				header("location:hod.php");
										
									}
		
		catch (Exception $e) {
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
					

}		
else
{
echo "no";
}				
		
    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
    	header("location:hod.php");
    }
    else
    {
    	echo "no";
    }



	if (isset($_POST['Rejected']))
{
    $remark = $_POST['hod_remark'];
    $query = "UPDATE mt_leave SET L_TYPE='lwp',HOD_APPROVED = 'Rejected',HOD_APPROVED_DATE = '$hod_date',HOD_REMARKS='$remark',HOD_APP_ID='$empname'
					 WHERE LEAVE_ID = '$leave_id' ";
    $res = mysqli_query($conn , $query);
    if($res)
    {
		            require 'vendor/autoload.php'; 
					$key = "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";
					$email = new \SendGrid\Mail\Mail();
					$email->setFrom("nikhil.jakharia@sakec.ac.in", "Example User");
					$email->setSubject("application approved successfully");
					$email->addTo("nikhil.jakharia@sakec.ac.in", "Example User");
					$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
					$email->addContent(
					    "text/html", "<strong>application for casual leave has been rejected by hod</strong>"
					);
					$sendgrid = new \SendGrid($key);
					try {
					    $response = $sendgrid->send($email);
					    print $response->statusCode() . "\n";
					    print_r($response->headers());
					    print $response->body() . "\n";
					    echo "Message has been sent successfully";
					                                echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
					    	header("location:hod.php");
					                                
					                            }
					
					catch (Exception $e) {
					    echo 'Caught exception: '. $e->getMessage() ."\n";
					}
    
    }
    else
    {
    	echo "no";
    }
    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is rejected\");}</script>";
    	header("location:hod.php");
    }
    else
    {
    	echo "no";
    }

}
ob_flush();
?>
<!DOCTYPE html>
<html>
<head>
	<title>APPLICATION FOR CASUAL LEAVE</title>
</head>
<body>
	
<!-- //header-ends -->
		<!-- main content start-->
		
		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method="POST" action="#">
								<input type="hidden" name="leave_type" value="casual leave">
								
							 	<h2 style="text-align: center; margin-top: 15px;">APPLICATION FOR CASUAL LEAVE FOR <?php echo "$department" ?></h2><br>
							    
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label" >Date :</label>
									<div >
										<input type="text" style="width: 15%;" class="form-control1" id="date" placeholder="" name="date"
										value="<?php echo $applied_on ;?>" readonly>
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>" readonly>
									</div>
								

									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>" readonly>
									</div>
									
							
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="Designation"
										value="<?php echo "$designation" ;?>" readonly>
									</div>
								</div>
								
								

								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label" >Leave from :</label>
									<div class="col-sm-2">
										<input type="text" name="pickup_date" class="form-control" id="pick_date" 
									  value="<?php echo $l_from ; ?>" readonly> 
									</div>
								    <label class="col-sm-1 control-label">to</label>
								    <div class="col-sm-2">
										<input type="text" name="drop_date" class="form-control" id="drop_date" 
									 value="<?php echo $l_to ;?> " readonly> 
									</div>
									<div class="col-sm-3">
										<input type="text" name="total_days" class="form-control" id="numdays" placeholder="Total number of days" value="<?php echo "$total_days";?>" readonly>
									</div>
								</div>

								<div class="form-group">	
									
									<label for="Halfday" class="col-sm-3 control-label">Halfday/FN/AN :</label>
									<div class="col-sm-5">
									<input type="text" name="type_of_day" class="form-control" id="type_of_day" 
									 value="<?php echo "$type";?>" readonly>
									

									</div>
									
									<div class="col-sm-1">
									</div>
									<div class="col-sm-2">
									<input type="date" name="half_day_date" class="col-sm-2 form-control" id="half_day_date" value="<?php echo "$half_day_date"; ?>" readonly>
										
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-sm-4 control-label">with permission to prefix/suffix sunday/holiday on :</label>
									<div class="col-sm-7"><input type="text" name="permission" class="form-control1" style="margin-top: 10px;" value="<?php echo "$prefix_suffix";?>" readonly></div>	
								</div>


								<div class=" form-group">
									<label  class="col-sm-3 control-label" >Arrangement for duties in absence</label>
									<div class="col-sm-3">
										<input type="text" id='autocomplete'  class=" form-control1" placeholder="Enter Employee Initals"
										 value="<?php echo "$atd_name";?>" readonly>
									</div>
									<div  class="col-sm-2">
									<input type="text" id='selectuser_id' name="atd_empname" class=" form-control1" placeholder="Employee No" 
									value="<?php echo "$atd_emp_no";?>" readonly/>
									</div>
									
								</div>

								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-9">
										<input type ="text" class="form-control"  name="reason" value="<?php echo $reason ?>" readonly>
									</div>
										
								</div>


						
								

								<div class="form-group">
									<label  for="HOD_APPROVED" class="col-sm-3 control-label">HOD APPROVED REMARKS :</label>
									<div class="col-sm-5">
										<input type="text" class="form-control"  name="hod_remark" name="HOD_APPROVED"  >
								</div>
								<div class="col-sm-2" >
										<input type="date" class="form-control1" id="date" placeholder="" name="hod_date"
										value="<?php echo date("Y-m-d");?>">
									</div>
									
</div>
								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 20%;margin-top: 30px;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info" name="approved" value="Approved" style="background: lightgreen;color: black;">
										<input type="submit" id="button" style="margin-left: 25%;background: red;color: black;"  name="Rejected"
										class="col-sm-2 btn btn-info" value="Rejected">

									</div>
								
								</div>
</div>
</form>


								







		<!--footer-->
		<div id="footer2" style="background: #6495Ed; height: 100px;margin-top: 150px;">
		
			<div id="site-copyright" style="margin-top: 20px; margin-left: 30%; padding: 20px; font-size: 12px; color: black;">Shah &amp; Anchor Kutchhi Engineering College<br>
Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br>
© Shah &amp; Anchor Kutchhi Engineering College.</div>	<!-- #site-info -->
				
		</div><!-- #footer2 -->	
	</div>
   
</body>
</html>
		
