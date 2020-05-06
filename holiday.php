	<?php

require_once "header1.php"
?>
<!DOCTYPE html>
<html>
<head>
	<title>Permission to work on holidays and non-working day</title>
</head>
<body>
<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method="POST" action="#">
							 	<h2 style="text-align: center; margin-top: 15px;">APPLICTION FOR PERMISSION ON WORKING ON NON-WORKING DAY FOR <?php echo '$department'; ?></h2><br>
							
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" id="date" placeholder=""value="<?php echo date("Y-m-d");?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" id="firstname" placeholder="Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>">
									</div>
						
								
							
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>">
									</div>
									
								
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="Designation" value="<?php echo "$designation" ;?>">
									</div>
								</div>

								<div class="form-group">
									<label for="department" class="col-sm-2 control-label">Department :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="department" placeholder="Department" value="<?php echo "$department" ;?>">
									</div>
								</div>
								

								<div class="form-group">
									<label for="date" class="col-sm-2 control-label">Date of visit :</label>
									<div class="col-sm-8" >
										<input type="date" style="width: 20%;" class="form-control" id="date" placeholder="">
									</div>
									
								</div>

								<div class="form-group">
									<label for="purpose" class="col-sm-2 control-label">Purpose of vist :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="reason" placeholder="purpose of visit">
									</div>
								</div>

								

								<div class="form-group">
									<label for="date" class="col-sm-2 control-label">Date :</label>
									<div class="col-sm-4">
										<input type="date" style="width: 40%;" class="form-control1" id="date" placeholder=""value="<?php echo date("Y-m-d");?>">
									</div>
									<label for="sign" class="col-sm-2 control-label">Applicant's signature :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="sign" placeholder="">
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
	
   
</body>
</html>
		<!-- //header-ends -->
		<!-- main content start-->
		
