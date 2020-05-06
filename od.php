<?php
require_once "header1.php";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$applied_date = $_POST['date'];
	$emp_no = $_SESSION['Emp_no'];
	$remarks = $_POST['remarks'];										//message noted store in remarks	
	$leave_type = $_POST['leave_type'];
	$type_of_work =  $_POST['type_work'];
	$details_of_work =   $_POST['details_of_work'];
	$date1 =   $_POST['date1'];
	$time1 =   $_POST['time1'];
	$text1 =   $_POST['text1'];
	
	$status = 'Pending';
	$pr_status = "Pending";


	

	$query = "INSERT INTO mt_leave (EMP_NO,APPLIED_ON,L_type,Remarks,HOD_APPROVED,PRINCIPAL_APPROVED,REASON,L_FROM,L_TO,NO_OF_DAYS) VALUES (?,?,?,?,?,?,?,?,?,?)";

	$stmt = mysqli_prepare($conn, $query);
        if ($stmt)
           {
                    mysqli_stmt_bind_param($stmt, "ssssssssss",$param_emp_no ,$param_applied_on,$param_leave_type,$param_Remarks,$param_status,$param_pr_status,$param_details_of_work,$param_date1,$param_date1,$param_no_of_days);

                    // Set these parameters
                   
           
					$param_date1=$date1;
					$param_no_of_days="1";
                   
                    $param_emp_no = $emp_no;
                    $param_applied_on = $applied_date;
                    $param_leave_type = $leave_type ;
					$param_Remarks=$remarks;
					$param_status=$status;
					$param_pr_status=$pr_status;
					$param_details_of_work = $details_of_work;

                    // Try to execute the query
                    if (mysqli_stmt_execute($stmt))
                    {

                    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
                    	

					}
                    else{
                        echo "Something went wrong..aaa. cannot redirect!";
                    }
                    mysqli_stmt_close($stmt); 
                }
              

                           		

	$query1 = "INSERT INTO outside_official_work (EMP_NO,LEAVE_ID, DATE_1 ,TIME_1,VENUE_1,TYPE_OF_WORK,DETAILS_OF_WORK) VALUES (?,?,?,?,?,?,?)";

	$stmt1 = mysqli_prepare($conn, $query1);
        if ($stmt1)
           {
                    mysqli_stmt_bind_param($stmt1, "sssssss",$param_emp_no, $param_leave_id ,$param_date1,
                    	$param_time1,$param_venue1,$param_type_of_work,$param_details_of_work);
                    // Set these parameters
                   
           		$count="SELECT LEAVE_ID FROM mt_leave";
	$counter = mysqli_query($conn , $count)or die( mysqli_error($conn));
	if(mysqli_num_rows($counter))
{
		  while ($row = mysqli_fetch_array($counter))
		  {
		  		  //echo "<script type='text/javascript'> window.onload = function(){alert(\"remaining casual leaves = $row[0]\");}</script>";
		  		 
		  		 $last_id = $row['LEAVE_ID'];
		  		
	             //$leave_id=$row[0] + 2 ;
	             //echo "$leave_id";


		  }
}


                   // $param_leave_id=$leave_id;
					$param_emp_no = $emp_no;
					$param_leave_id = $last_id;
				   	$param_date1 = $date1;
					$param_time1 = $time1;
					$param_venue1 = $text1;

			

					$param_type_of_work = $type_of_work;
					$oaram_details_of_work=$details_of_work;
		


                    // Try to execute the query
                    if (mysqli_stmt_execute($stmt1))
                    {

                    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
                    	

					}
                    else{
                        echo "Something went wrong... cannot redirect!";
                    }
                    mysqli_stmt_close($stmt1); 
                }        

 }                          
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
					
							<form class="form-horizontal" method="POST">
								<input type="hidden" name="leave_type" value="outside official work">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for permission for outside offical work for <?php echo "$department" ;?></h2><br>
								
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" name="date" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>" readonly>
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
									<label for="type_of_work" class="col-sm-2 control-label">C.A.S/EXAM WORK/Others:</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1"  name="type_work" placeholder="" required />
									</div>
								

								
									<label  for="reason" class="col-sm-2 control-label">details of work:</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"  name="details_of_work" required> 
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
									
										<input  type="text" class="form-control1" name="srno1" id="srno1" placeholder=" Srno1" required>
								
									</td>
									<td>
										<div >
										<input type="date" style="width: 100%;" class="form-control1" name="date1" id="date1" placeholder="" required>
									</div>

									</td>
									<td>
									<div >
										<input type="time" style="width: 100%;" class="form-control1" name="time1" id="time1" placeholder="" required>
									</div>	
									</td>
									<td>
										<div >
										<input type="text" style="width: 100%;" class="form-control1" name="text1" id="text1" placeholder="" required>
									</div>
									</td>	

								</tr>

								
								
								</table>
								<br>
						





								<div class="form-group">
									<label  for="reason" class="col-sm-1 control-label">Remarks</label>
									<div class="col-sm-6">
										<input type="text" class="form-control"  name="remarks" id="remarks" required>
									</div>	
								
									<label for="date" class="col-sm-1 control-label">Date :</label>
									<div class="col-sm-4">
										<input type="date" style="width: 40%;" class="form-control1" name ="date" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>">
									</div>
									
									
								</div>
							
								

								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 35%;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info" value="Submit">
									</div>
								</div>
							<br>
							<br>

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
	