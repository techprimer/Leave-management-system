<?php
require_once "header1.php";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$applied_date = $_POST['date'];
	$emp_no = $_SESSION['Emp_no'];
	$l_from = $_POST['drop_date']; 
	$l_to = $_POST['drop_date'];
	$total_days =1;
	$reason = $_POST['reason'];
	$remarks=$_POST['message']	;										//message noted store in remarks	
	//$status = 'Pending';
	//$pr_status = "Pending";
	$leave_type = $_POST['leave_type'];
	//$fn = $_POST['fn'];

	$query = "INSERT INTO mt_leave (EMP_NO,L_FROM, L_TO,NO_OF_DAYS,APPLIED_ON,REASON,L_type,Remarks) VALUES (?,?,?,?,?,?,?,?)";

	$stmt = mysqli_prepare($conn, $query);
        if ($stmt)
           {
                    mysqli_stmt_bind_param($stmt, "ssssssss",$param_emp_no , $param_l_from ,$param_l_to ,$param_no_of_days,$param_applied_on,$param_reason,$param_leave_type,$param_Remarks);

                    // Set these parameters
                   
                    $param_l_from = $l_from;
                    $param_l_to = $l_to;
                    $param_no_of_days = $total_days;
                    $param_applied_on = $applied_date;
                    $param_reason = $reason;
                    $param_emp_no = $emp_no;
                   // $param_status =$status ;
                    //$param_pr_status = $pr_status ;
                    $param_leave_type = $leave_type ;
                    //$param_fn = $fn;
					$param_Remarks=$remarks;

                    // Try to execute the query
                    if (mysqli_stmt_execute($stmt))
                    {

                    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
                    	

					}
                    else{
                        echo "Something went wrong... cannot redirect!";
                    }
                     mysqli_stmt_close($stmt); 
                }
              

                           
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Application for telephonic message regarding absence</title>
</head>
<body>
	<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method = "POST" action="#">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for telephonic message regarding absence</h2><br>
								 
								<input type="hidden" name="leave_type" value="telephonic absence">
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" id="date" name="date" placeholder=""
										value="<?php echo date("Y-m-d");?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">Name :</label>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" name="firstname" id="firstname" placeholder="First Name" value="<?php echo "$firstname" ;?>" required>
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" name="middlename" id="middlename" placeholder="Middle Name" value="<?php echo "$middlename" ;?>" required>
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo "$lastname" ;?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" name="employee number" id="employee number" placeholder="employee number" value="<?php echo "$emp_no" ;?>" required>
									</div>
									
								</div>
								<div class="form-group">
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" name="designation" id="designation" placeholder="Designation" value="<?php echo "$designation" ;?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="department" class="col-sm-2 control-label">Department :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" name="department" id="department" placeholder="Department" value="<?php echo "$department" ;?>"  required>
									</div>
								</div>
								<div class="form-group">
									<label for="probation" class="col-sm-2 control-label">Message</label>
									<div class="col-sm-9">
										<input type="text" class="form-control1" name="message" id="message" placeholder="" required>
									</div>
								</div>

								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="4" name="reason" id="reason" required> </textarea>
									</div>
								</div>
									

								<div class="form-group">
									<label class="col-sm-2 control-label"> Message taken by</label>
									<label for="msgtaker" class="col-sm-2 control-label"> Name :</label>
									<div class="col-sm-2">
										<input type="text" name="signature" class="form-control1" id="signature" required> 
									</div>
								   
								    <div class="col-sm-2">
										<input type="date" name="drop_date" class="form-control" name="drop_date"  id="drop_date" 
							value="<?php echo date("Y-m-d");?>" required> 
									</div>
								</div>

								
									
										
						
								<div class="form-group">
									<label  for="message-noted" class="col-sm-2 control-label">Message noted :</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="3" name="message noted" id="message noted" required> </textarea>
									</div>	
								</div>
								<br>
								<br>


								
								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 35%;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info" value="Submit">
									</div>
									
								</div>


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
</html>	<!-- //header-ends -->
		<!-- main content start-->
	
   
