<?php
ob_start(); 
include_once  "header1.php";

$leave_id="";
if(isset($_GET['id']))
{
$leave_id = $_GET['id'];	
}



//echo "<script type='text/javascript'>  window.onload = function(){alert(\"$leave_id\");}</script>";

$sql = "SELECT F_NAME,M_NAME,L_NAME,EMP_NO,EMP_TYPE,mt_grade_mst.DESIGNATION,mt_dept_mst.dept_nm 
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
				$emp_type=$row['EMP_TYPE'];
		 }
	}		

$sql1 = "SELECT * FROM  mt_leave  WHERE  LEAVE_ID = '$leave_id'  ";
$result1 = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
if (mysqli_num_rows($result1) > 0) 
{
		while ($row1 = mysqli_fetch_array($result1))
		 {
		 		$l_from = $row1['L_FROM'];
		 		$l_to = $row1['L_TO'];
		 		$applied_on = $row1['APPLIED_ON'];
		 		$reason = $row1['REASON'];
		 		$total_days = $row1['NO_OF_DAYS'];
}
}

$sql3 = "SELECT * FROM other_than_casual where  LEAVE_ID = '$leave_id' ";

$result3 = mysqli_query($conn , $sql3)or die( mysqli_error($conn));
if (mysqli_num_rows($result3) > 0) 
{
		while ($row3 = mysqli_fetch_array($result3))
		 {			 
			$probation	=	$row3['probation'];
			$address	=	$row3['add_ress'];
			$el_from	=	$row3['el_from'];
			$el_to	=		$row3['el_to'];
			$hp_from	=	$row3['hp_from'];
			$hp_to	=		$row3['hp_to'];
			$eo_from	=	$row3['eo_from'];
			$eo_to	=		$row3['eo_to'];
			$atd_name	=	$row3['atd_emp_name'];
			$atd_empno	=	$row3['atd_emp_no'];
			
}
}

$row['EMP_NO'] = $_SESSION['EMP_NO'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$hod_date=$_POST['hod_date'];
	$total_days=$_POST['total_days'];
	$remark = $_POST['hod_remark'];
	if ($total_days < 6)
	{
    	$query = "UPDATE mt_leave SET HOD_APPROVED = 'Approved',HOD_APPROVED_DATE = '$hod_date',HOD_REMARKS='$remark',HOD_APP_ID='$empname',
					PRINCIPAL_APPROVED = 'Approved',PRINCIPAL_APPROVED_DATE = '$hod_date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname'
					 WHERE LEAVE_ID = '$leave_id' ";
		$res = mysqli_query($conn , $query);
	}
	else
	{
		$query = "UPDATE mt_leave SET HOD_APPROVED = 'Approved',HOD_APPROVED_DATE = '$hod_date',HOD_REMARKS='$remark' WHERE LEAVE_ID = '$leave_id' ";
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


}

	if (isset($_POST['Rejected']))
{
   
    $query = "UPDATE mt_leave SET HOD_APPROVED = 'Rejected' WHERE LEAVE_ID = '$leave_id' ";
    $res = mysqli_query($conn , $query);
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
	<title>Application for Leave on other than casual leave for </title>


	<script type="text/javascript">
         function GetDays(){
			 	var appdt = new Date(document.getElementById("date").value);
                var dropdt = new Date(document.getElementById("drop_date").value);
                var pickdt = new Date(document.getElementById("pick_date").value);
				var ans = ((dropdt - pickdt) / (24 * 3600 * 1000)+1) ;
				var diff= ((pickdt - appdt) / (24 * 3600 * 1000)+1) ;
				document.getElementById("diff").value=diff;
				return ans;
        }

        function call(){
        if(document.getElementById("drop_date")){
            document.getElementById("numdays").value=GetDays();
           
        }  
    }


    </script>


    <script type="text/javascript">
        function GetDays1(){
			var appdt = new Date(document.getElementById("date").value);
                var dropdt = new Date(document.getElementById("drop_date1").value);
                var pickdt = new Date(document.getElementById("pick_date1").value);
				var ans = ((dropdt - pickdt) / (24 * 3600 * 1000)+1) ;
				var diff1= ((pickdt - appdt) / (24 * 3600 * 1000)+1) ;
				document.getElementById("diff1").value=diff1;
				return ans;
        }

        function call1(){
        if(document.getElementById("drop_date1")){
            document.getElementById("numdays1").value=GetDays1();
           
        }  
    }

    </script>
	
    <script type="text/javascript">
        function GetDays2(){
			var appdt = new Date(document.getElementById("date").value);
                var dropdt = new Date(document.getElementById("drop_date2").value);
                var pickdt = new Date(document.getElementById("pick_date2").value);
				var ans = ((dropdt - pickdt) / (24 * 3600 * 1000)+1) ;
				var diff2= ((pickdt - appdt) / (24 * 3600 * 1000)+1) ;
				document.getElementById("diff2").value=diff2;
				return ans;
        }

        function call2(){
        if(document.getElementById("drop_date2")){
            document.getElementById("numdays2").value=GetDays2();
           
        }  
    }

    </script>



  <style type="text/css">
  	body
  	{
  		color: black;
  	}
  </style>

</head>
<body onload="call();call1();call2();">
	<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method ="POST" action="#">
								<input type="hidden" name="leave_type" value="other_than_casual">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for Leave on other than casual leave for <?php echo "$department" ;?> </h2><br><br>
							
								<div class="form-group">
									<label for="date"  class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" id="date" placeholder="" name="date" id="date" value="<?php echo "$applied_on" ;?>" readonly>
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" id="firstname" placeholder="First Name"  value="<?php echo "$firstname   $middlename   $lastname" ;?>" readonly>
									</div>
									
								
								
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>" readonly>
									</div>
									
								
								
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="Designation" name="desgn" value="<?php echo "$designation" ;?>"readonly>
									</div>
								</div>
							


								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Earned Leave :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date" class="form-control" id="pick_date" onchange="call()" max="2020-12-31" min="2020-01-01" value="<?php echo "$el_from" ;?>" readonly>
									
									</div>
								    <label class="col-sm-1 control-label" style="text-align:center;">to</label>
								    <div class="col-sm-2">
										<input type="date" name="dropup_date" class="form-control" id="drop_date"  
									onchange="call()"  max="2020-12-31" min="2020-01-01" value="<?php echo "$el_to" ;?>" readonly> 
									</div>
									<div class="col-sm-3">
										<input type="text"  class="form-control" name="numdays" id="numdays" placeholder="Total number of days" readonly>
										<input type="hidden" class="form-control" name="diff" id="diff" >
									</div>
								</div>


								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Haf pay leave :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date1" class="form-control" id="pick_date1"  
									onchange="call1()"  max="2020-12-31" min="2020-01-01" value="<?php echo "$el_from" ;?>" readonly> 
									</div>
								    <label class="col-sm-1 control-label" style="text-align:center;">to</label>
								    <div class="col-sm-2">
										<input type="date" name="dropup_date1" class="form-control" id="drop_date1"  
									onchange="call1()"  max="2020-12-31" min="2020-01-01" value="<?php echo "$el_to" ;?>" readonly> 
									</div>
									<div class="col-sm-3">
										<input type="text" name="numdays1" class="form-control" id="numdays1" placeholder="Total number of days" readonly>
										<input type="hidden" class="form-control" name="diff1" id="diff1">
									</div>
								</div>

								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Extraordinary leave :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date2" class="form-control" id="pick_date2" 
									onchange="call2()"  max="2020-12-31" min="2020-01-01" value="<?php echo "$hp_from" ;?>" readonly> 
									</div>
								    <label class="col-sm-1 control-label" style="text-align:center;">to</label>
								    <div class="col-sm-2">
										<input type="date" name="dropup_date2" class="form-control" id="drop_date2" 
									onchange="call2()"  max="2020-12-31" min="2020-01-01" value="<?php echo "$hp_to" ;?>" readonly> 
									</div>
									<div class="col-sm-3">
										<input type="text" name="numdays2" class="form-control" id="numdays2" placeholder="Total number of days" readonly>
										<input type="hidden" class="form-control" name="diff2" id="diff2">
									</div>
									<input type="hidden" class="form-control" name="total_days" id="total_days" value ="<?php echo "$total_days"; ?>" readonly>
								</div>

								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-8">
										<input type="text" class="form-control"  name="reason" value="<?php echo "$reason" ;?>" readonly> 
									</div>
									
										
								</div>


								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Address during leave period :</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="add_ress" id="add" value='<?php echo "$address" ;?>' readonly> 
									</div>		
								</div>

								<div class="form-group">
									<label for="employee no." class="col-sm-2 control-label">probation or confirmed:</label>
									<div class="col-sm-1">
										<input type="text" class="form-control1" id="wop" placeholder="" name="wop" value="<?php echo "$probation" ;?>" readonly>
									</div>
	  </div>

								<div class=" form-group">
									<label  class="col-sm-3 control-label" >Arrangement for duties in absence</label>
									<div class="col-sm-3">
										<input type="text" id='autocomplete1'  name="atd_empname" class="form-control1" placeholder="Enter Employee Initals" value="<?php echo "$atd_name" ;?>" readonly>
									</div>
									<div  class="col-sm-2">
									<input type="text" id='selectuser_id1' name="atd_emp_no" class="form-control1" placeholder="Employee No" value="<?php echo "$atd_empno" ;?>"/>
									</div>
									
								</div>
								<br>

							
						<div class="form-group">
						<label  for="HOD_APPROVED" class="col-sm-3 control-label">HOD APPROVED REMARKS :</label>
							<div class="col-sm-6">
								<input type="text" class="form-control"  name="hod_remark" name="HOD_APPROVED"  > 									
						</div>
						<div class="col-sm-2" >
										<input type="date" class="form-control1" id="date" placeholder="" name="hod_date"
										value="<?php echo date("Y-m-d");?> ">
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


		
