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


//difficulty in foeming sql1
$sql1 = "SELECT * FROM  outside_official_work  WHERE  LEAVE_ID = '$leave_id'  ";
$result = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row1 = mysqli_fetch_array($result))
		 {
		 		$type_of_work = $row1['TYPE_OF_WORK'];
		 		
		 		/*$applied_on = $row1['APPLIED_ON'];
		 		$reason = $row1['REASON'];
				 $total_days = $row1['NO_OF_DAYS']; */
				 $date1 = $row1['DATE_1'];
			

				 $time1 = $row1['TIME_1'];
			

				 $venue1 = $row1['VENUE_1'];
				 
}
}

$sql2 = "SELECT * FROM  mt_leave  WHERE  LEAVE_ID = '$leave_id'  ";
$result = mysqli_query($conn , $sql2)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row2 = mysqli_fetch_array($result))
		 {
			$details_of_work = $row2['REASON'];	 
			$Remarks = $row2['Remarks'];
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
    {
		// key = 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

		require 'vendor/autoload.php'; 
		$key = "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";
		$email = new \SendGrid\Mail\Mail();
		$email->setFrom("$sender_email", "Example User");
		$email->setSubject("application approved successfully");
		$email->addTo("$recevier_email", "Example User");
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
				header("location:principal.php");
										
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
    	header("location:principal.php");
    }
    else
    {
    	echo "no";
    }

}

	if (isset($_POST['Rejected']))
{
    $remark = $_POST['pr_remark'];
    $pr_date=$_POST['pr_date'];
    $query = "UPDATE mt_leave SET L_TYPE='lwp',PRINCIPAL_APPROVED = 'Rejected',PRINCIPAL_APPROVED_DATE = '$pr_date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname' 
                                     WHERE LEAVE_ID = '$leave_id' ";
    $res = mysqli_query($conn , $query);
    if($res)
    {
		            require 'vendor/autoload.php'; 
					$key = "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";
					$email = new \SendGrid\Mail\Mail();
					$email->setFrom("$sender_email", "Example User");
					$email->setSubject("application approved successfully");
					$email->addTo("$recevier_email", "Example User");
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
    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is rejected\");}</script>";
    	header("location:hod.php");
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


ob_flush();
?>





<!DOCTYPE html>
<html>
<head>
	<title>Application for permission for outside offical work</title>
</head>
<body>
<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method = "POST" action ="#">
								<input type="hidden" name="leave_type" value="OD leave">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for permission for outside offical work for <?php echo "$department"; ?></h2><br>
								
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" name="date" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" name="firstname" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>"  readonly>
									</div>
								
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" name="employee number" id="employee number" placeholder="employee number" value="<?php echo "$emp_no" ;?>" readonly>
									</div>
									
								
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" name="designation" id="designation" placeholder="Designation" value="<?php echo "$designation" ;?>" readonly>
									</div>
								</div>
								
								<div class="form-group">
									<label for="type_of_work" class="col-sm-3 control-label">C.A.S. / EXAM. WORK / Others :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" value="<?php echo "$type_of_work" ;?>" name="type_work" placeholder="" readonly >
									</div>
								
									<label  for="reason" class="col-sm-2 control-label">details of work:</label>
									<div class="col-sm-3">
										<input type="text" class="form-control"  name="details_of_work" value="<?php echo "$details_of_work" ;?>" value="<?php echo "$details_of_work" ;?>" readonly > 
									</div>	
								</div>
							

								<table style="margin-left: 215px;">
								<tr>
									<th> Srno
									</th>
									<th>date 
									</th>
									<th>time
									</th>
									<th>Venue
									</th>	
								</tr>
								<tr>
									<td>
									
										<input  type="text" class="form-control1" value='1' name="srno1" id="srno1" placeholder=" Srno1" required>
								
									</td>
									<td>
										<div >
										<input type="date" style="width: 100%;" class="form-control1" value="<?php
																											if(($date1 == '0000-00-00'))
																											{ echo " - - - " ; }
																											else { echo "$date1" ; }
																											?>"
																											  name="date1" id="date1" placeholder="" required>
									</div>

									</td>
									<td>
									<div >
										<input type="text" style="width: 100%;" class="form-control1"  value="<?php
																											if(($time1 == '00:00:00.000000'))
																											{ echo " - - -" ; }
																											else { echo "$time1" ; }
																											?>"
																											 name="time1" id="time1" placeholder="" required>
									</div>	
									</td>
									<td>
										<div >
										<input type="text" style="width: 100%;" class="form-control1" value="<?php
																											if(isset($venue1))
																											{ echo "$venue1" ; }
																											else { echo " - - - " ; }
																											?>" 
																											name="text1" id="text1" placeholder="" required>
									</div>
									</td>	

								</tr>

								
								</table>
							
<br>




								<div class="form-group">
									<label  for="reason" class="col-sm-1 control-label">Remarks</label>	
									<div class="col-sm-10">
										<input type="text" class="form-control"    name="remarks" id="remarks" value=" <?php echo "$Remarks" ;?>" readonly>
									</div>	
								</div>



								<div class="form-group">
								<div>	<label  for="HOD_APPROVED" class="col-sm-3 control-label">HOD APPROVED REMARKS :</label>
									<div class="col-sm-5">
										<input type="text" class="form-control"  name="hod_remark" name="HOD_APPROVED" style="margin-top: -30px;" value="<?php echo "$hod_app_remarks"; ?>" > 									</div>	
								</div>
								<div class="col-sm-2" >
										<input type="date" class="form-control1" id="date" placeholder="" name="hod_date"
										value="<?php echo "$hod_app_date"; ?>">
									</div>
</div>

<div class="form-group">
								<div>	<label  for="PR_APPROVED" class="col-sm-3 control-label">PRINCIPAL APPROVED REMARKS :</label>
									<div class="col-sm-5">
										<input type="text" class="form-control"  name="pr_remark"  style="margin-top: -30px;" > 									</div>	
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
<br>
<br>
<br>
<br>

		<!--footer-->
		<div id="footer2" style="background: #6495Ed; height: 100px;">
		
			<div id="site-copyright" style="margin-top: 20px; margin-left: 30%; padding: 20px; font-size: 12px; color: black;">Shah &amp; Anchor Kutchhi Engineering College<br>
Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br>
© Shah &amp; Anchor Kutchhi Engineering College.</div>	<!-- #site-info -->
				
		</div><!-- #footer2 -->	
	</div>

	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
	
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html>
	