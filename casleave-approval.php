<?php

require_once "header1.php";
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
					
							<form class="form-horizontal">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for Casual Leave</h2><br>
							    
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">Name :</label>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="firstname" placeholder="First Name">
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="firstname" placeholder="Middle Name">
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="firstname" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="designation" placeholder="employee number">
									</div>
									
								</div>
								<div class="form-group">
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="designation" placeholder="Designation">
									</div>
								</div>
								<div class="form-group">
									<label for="department" class="col-sm-2 control-label">Department :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="department" placeholder="Department">
									</div>
								</div>
								<div class="form-group">
									<label for="Halfday" class="col-sm-2 control-label">Halfday,FN/AN on :</label>
									<div class="col-sm-9">
										<input type="text" class="form-control1" id="halfday" placeholder="">
									</div>
								</div>

								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Leave from :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date" class="form-control" id="pick_date" 
									onchange="call()"> 
									</div>
								    <label class="col-sm-1 control-label">to</label>
								    <div class="col-sm-2">
										<input type="date" name="drop_date" class="form-control" id="drop_date" 
									onchange="call()"> 
									</div>
									<div class="col-sm-3">
										<input type="text" name="total_days" class="form-control" id="numdays" placeholder="Total number of days">
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-sm-2 control-label">with permission to prefix/suffix sunday/holiday on :</label>
									<div class="col-sm-8"><input type="text" name="permission" class="form-control1" style="margin-top: 10px;"></div>
									
									
								</div>


								<div class="form-group">
									<label for="namepersoninfomed" class="col-sm-2 control-label">Arrangement for performance of duties in his/her absent :</label>
									<div class="col-sm-3">
										<input  class="form-control1" type="text" class="form-control1" id="firstname" placeholder="First Name" style="margin-top: 10px;">
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="firstname" placeholder="Middle Name"
										 style="margin-top: 10px;">
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="firstname" placeholder="Last Name"style="margin-top: 10px;">
									</div>
								</div>





								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="4" name="reason"> </textarea>
									</div>
									
										
								</div>

								
								<br>
								<br>


								<div class="form-group">
									<label for="date" class="col-sm-2 control-label">Date :</label>
									<div class="col-sm-4">
										<input type="date" style="width: 40%;" class="form-control1" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>">
									</div>
									<label for="sign" class="col-sm-2 control-label">Applicant's signature :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="sign" placeholder="">
									</div>


									<div class="form-group">
									<label for="date" class="col-sm-2 control-label">Date :</label>
									<div class="col-sm-4">
										<input type="date" style="width: 40%;" class="form-control1" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>">
									</div>
									<select class="col-sm-4" name="approval">
										<option value="approved">approved</option>
										<option value="not_approved">not approved</option>
										
									</select> 
                        
									<label for="sign" class="col-sm-2 control-label">Hods signature :</label>
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
		
