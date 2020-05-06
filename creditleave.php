<?php


require_once "header1.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	

	$l_date = $_POST['pickup_date1'];
	$start_time =$_POST['ftime'];
	$end_time =$_POST['ttime'];
	$total_time =$_POST['dtime'];

	$reason = $_POST['extra_work']; 
	$applied_date = $_POST['date'];
	$emp_no = $_SESSION['Emp_no'];
	$status = 'Pending';
	$pr_status = "Pending";
	$leave_type = $_POST['leave_type'];
	

	// validations else for correct information
	
	
		$query = "INSERT INTO mt_leave (EMP_NO,L_FROM,L_TO,NO_OF_DAYS,APPLIED_ON,REASON,L_type,HOD_APPROVED,PRINCIPAL_APPROVED) VALUES (?,?,?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($conn, $query);
        if ($stmt)
           {
					mysqli_stmt_bind_param($stmt, "sssssssss",$param_emp_no , $param_l_date ,$param_l_date,$param_total_time,$param_applied_on,$param_reason,$param_leave_type,$param_status,$param_pr_status);
                    // Set these parameters
                    $param_l_date = $l_date;
                    
					$param_total_time = $total_time;
					
                    $param_applied_on = $applied_date;
                    $param_reason = $reason;
                    $param_emp_no = $emp_no;
                    $param_status =$status ;
                    $param_pr_status = $pr_status ;
                    $param_leave_type = $leave_type ;
            
                    // Try to execute the query
                    if (mysqli_stmt_execute($stmt))
                    {

                    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";	
					}
					else
					{
                        echo "Something went wrong... cannot redirect!";
					}
                     mysqli_stmt_close($stmt); 
			}		                         

			$query1 = "INSERT INTO crdt_leave (EMP_NO,LEAVE_ID, credit_date ,credit_time ,s_time,e_time) VALUES (?,?,?,?,?,?)";

			$stmt1 = mysqli_prepare($conn, $query1);
			if ($stmt1)
	   		{
			mysqli_stmt_bind_param($stmt1, "ssssss",$param_emp_no, $param_leave_id ,$param_l_date,$param_total_time,$param_start_time,$param_end_time);
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
				 
				
				$param_l_date =$l_date ;
				$param_start_time =	$start_time ;
				$param_end_time =$end_time;
				$param_total_time =$total_time ;
	


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
	<title>Application for credit period of extra work done</title>


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
								
							 	<h2 style="text-align: center; margin-top: 15px;">Application for creadit period of extra work done for <?php echo "$department" ;?></h2><br>
							
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1"  name="date" id="date" placeholder=""
										value="<?php echo date("Y-m-d");?>" readonly>
									</div>
									
								</div>

								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" name="firstame" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?> " readonly>
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
										<input type="text" class="form-control1" name="extra_work" id="extra_work" placeholder="Detail of extra work carried out " required>
									</div>
								</div>


								

       							<div class="form-group">
									<label for="Leavedate" class="col-sm-1 control-label"> Date :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date1" class="form-control" id="pick_date1" required>
									 
									</div>

									
									<div class="col-sm-5">
										<input class="Time1"  type="time" name="ftime" required>
										<input class="Time2"  type="time" name="ttime" onchange="calculate()" required/>
										<input class="Hours" type="text" name="dtime" value="0" readonly />


									</div>
								</div>
									
								
								<br>
								<br>

								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 35%;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info" value="Submit">
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