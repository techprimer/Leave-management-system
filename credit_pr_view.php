

<?php
ob_start(); 
include_once  "header1.php";

$leave_id="";
if(isset($_GET['id']))
{
$leave_id = $_GET['id'];	
}



//echo "<script type='text/javascript'>  window.onload = function(){alert(\"$leave_id\");}</script>";


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


$sql1 = "SELECT * FROM  crdt_leave  WHERE  LEAVE_ID = '$leave_id'  ";
$result1 = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
if (mysqli_num_rows($result1) > 0) 
{
	while ($row1 = mysqli_fetch_array($result1))
	 {
		 $l_date = $row1['credit_date'];
		$total_time = $row1['credit_time'];
		$start_time = $row1['s_time'];
		$end_time = $row1['e_time'];
	}
} 


$sql2 = "SELECT * FROM  mt_leave  WHERE  LEAVE_ID = '$leave_id'  ";
$result = mysqli_query($conn , $sql2)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
	while ($row2 = mysqli_fetch_array($result))
	 {
	$applied_date = $row2['APPLIED_ON'];
	$details_of_work = $row2['REASON'];	 
	
	}
}


$row['EMP_NO'] = $_SESSION['EMP_NO'];

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (isset($_POST['approved']))
{
	
	$pr_date=$_POST['pr_date'];
	$total_days=$_POST['total_days'];
	$remark = $_POST['pr_remark'];

    $query = "UPDATE mt_leave SET PRINCIPAL_APPROVED = 'Approved',PRINCIPAL_APPROVED_DATE = '$pr_date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname'
                   WHERE LEAVE_ID = '$leave_id' ";
    $res = mysqli_query($conn , $query);
    if($res)
    {if($res)
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
   
    $remark = $_POST['pr_remark'];
    $pr_date=$_POST['pr_date'];
    $query = "UPDATE mt_leave SET L_TYPE='lwp',PRINCIPAL_APPROVED = 'Rejected',PRINCIPAL_APPROVED_DATE = '$pr_date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname' 
    WHERE LEAVE_ID = '$leave_id' ";
$res = mysqli_query($conn , $query);
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
	<title>Application for credit period of extra work done</title>
	<script type="text/javascript">
        function Gettime(){
                var starttime = new Date(document.getElementById("ftime").value);
				var sthr = starttime.getHours();
				var stmin = starttime.getMinutes();
				var st_min_con=sthr*60;
				var final_starttime=st_min_con + stmin;
                var endtime = new Date(document.getElementById("ttime").value);
				var endhr = starttime.getHours();
				var endmin = starttime.getMinutes();
				var end_min_con=sthr*60;
				var final_endtime=end_min_con + endmin;
				var total_time=final_endtime-final_starttime;
				return parseInt(total_time);
				
				// getTime() : getTime() Returns the number of milliseconds since midnight January 1, 1970.
			/*	var starttime = new Date(document.getElementById("ftime").value);
				var endtime = new Date(document.getElementById("ttime").value);
				var st= starttime.getTime();
				var en= endtime.getTime();
				var tt= en-st;
				

                return parseInt((tt) / (1000*60*60)) % 24);*/
        }

        function calltime(){
        if(document.getElementById("ttime")){
            document.getElementById("dtime").value=Gettime();
        }  
    }

    </script>

</head>
<body>


		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					<form class="form-horizontal" method="POST" action="#">
								<input type="hidden" name="leave_type" value="credit work">
								
							 	<h2 style="text-align: center; margin-top: 15px;">Application for credit period of extra work done for <?php echo "$department" ;?></h2><br>
							
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1"  name="date" id="date" placeholder=""
										value="<?php echo "$applied_date" ;?>" readonly>
									</div>
									
								</div>

								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" name="firstame" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>" readonly>
									</div>
								
								
								
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" name="emp_no" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>" readonly>
									</div>
									
								
								
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" name="designation" id="designation" placeholder="Designation" value="<?php echo "$designation" ;?>" readonly>
									</div>
								</div>
								

								<div class="form-group">
									<label for="extra work" class="col-sm-3 control-label">Detail of extra work carried out :</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="extra_work" id="extra_work" placeholder="Detail of extra work carried out" value="<?php echo "$details_of_work" ;?>" readonly>
									</div>
								</div>



       							<div class="form-group">
									<label for="Leavedate" class="col-sm-1 control-label"> Date :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date1" class="form-control" id="pick_date1" value='<?php echo "$l_date" ;?>' readonly>
									 
									</div>

									
									<div class="col-sm-2">
										<input class="col-sm-1 form-control1" type="time" id="ftime" name="ftime" value="<?php echo $start_time ;?>" readonly>
									</div>
									<label for="Leavedate" class="col-sm-1 control-label" style="text-align: center;">To:</label>
									<div class="col-sm-2">
										<input class="col-sm-1 form-control1" type="time" id="ttime" name="ttime"   onchange="calltime()" value="<?php echo $end_time ;?>" readonly>
										
									</div>
									<div class="col-sm-4">
									<input class="col-sm-3 form-control1" type="text" id="dtime" name="dtime" value="<?php echo $total_time ;?>" readonly>
									</div>
								</div>
									
						
								
								<div class="form-group">
								<div>	<label  for="HOD_APPROVED" class="col-sm-3 control-label">HOD APPROVED REMARKS :</label>
									<div class="col-sm-5">
										<input type="text" class="form-control"  name="hod_remark" name="HOD_APPROVED"  value="<?php echo "$hod_app_remarks"; ?>" > 										
								</div>
								<div class="col-sm-2" >
										<input type="date" class="form-control1" id="date" placeholder="" name="hod_date"
										value="<?php echo "$hod_app_date"; ?>">
									</div>
</div>

<div class="form-group">
								<div>	<label  for="PR_APPROVED" class="col-sm-3 control-label">PRINCIPAL APPROVED REMARKS :</label>
									<div class="col-sm-5">
										<input type="text" class="form-control"  name="pr_remark"  > 									
								</div>
								<div class="col-sm-2" >
										<input type="date" class="form-control1" id="date" placeholder="" name="pr_date"
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
		<div id="footer2" style="background: #6495Ed; height: 100px;">
		
			<div id="site-copyright" style="margin-top: 20px; margin-left: 30%; padding: 20px; font-size: 12px; color: black;">Shah &amp; Anchor Kutchhi Engineering College<br>
Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br>
© Shah &amp; Anchor Kutchhi Engineering College.</div>	<!-- #site-info -->
				
		</div><!-- #footer2 -->	
	</div>	
   
</body>
</html>