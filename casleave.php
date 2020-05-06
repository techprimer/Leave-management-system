<?php

require_once "header1.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$applied_date = $_POST['date'];
	$l_from = $_POST['pickup_date']; 
	$l_to = $_POST['drop_date'];
	$total_days =$_POST['total_days'];
	$reason = $_POST['reason'];
	$emp_no = $_SESSION['Emp_no'];
	$status = 'Pending';
	$pr_status = "Pending";
	
	$adm_status = "Pending";
	$leave_type = $_POST['leave_type'];
	$fn = $_POST['fn'];
	$halfdate = $_POST['half_day_date'];
	$permission=$_POST['permission'];
	$atd_empno=$_POST['atd_emp_no'];
	$atd_name= $_POST['atd_empname'];
	$days1 = $_POST['diff'];
//echo "inside post";
if (isset($_POST['submit']))
{
/*	if(	($total_days > 4 ) && (	$days1 < 7	)){
		echo "<script type='text/javascript'>  window.onload = function(){alert(\"pls change start point of ur leave\");}</script>";
	}
	elseif(	($total_days > 10 ) &&(	$days1<15	)){
		echo "<script type='text/javascript'>  window.onload = function(){alert(\"pls change start point of ur leave\");}</script>";
	}
	*/
	if(($l_from != $halfdate ) && ($l_to != $halfdate) && ($fn=='half-day'))
		{
			echo "<script type='text/javascript'>  window.onload = function(){alert(\"your half day date dosent match with leave period\");}</script>";
		}
		
	if ($t_leave < $total_days)
		{
			echo "<script type='text/javascript'>  window.onload = function(){alert(\"Remaining leaves are less than applied leaves\");}</script>";
		}
	
	else{	
		
		$query3 = "	SELECT * FROM mt_emp WHERE EMP_NO = '$atd_empno' ";
		$result3 = mysqli_query($conn , $query3)or die( mysqli_error($conn));
		if (mysqli_num_rows($result3) > 0) 
		{
			while ($row3 = mysqli_fetch_array($result3))
		 {		
				$atd_department = $row3['DEPARTMENT'];		
		 }
		}	

		$query4 = "SELECT * FROM mt_leave WHERE (EMP_NO = '$emp_no') AND ( L_FROM  Between '$l_from' AND '$l_to'  ) AND ( L_TO  Between '$l_from' AND '$l_to'  ) ;" ;
		$result4 = mysqli_query($conn , $query4)or die( mysqli_error($conn));
		if (mysqli_num_rows($result4) > 0) 
		{
			echo "<script type='text/javascript'>  window.onload = function(){alert(\"Leave already applied for this time period\");}</script>";
		}	
		elseif(	$atd_department !=	$department)
		{
			echo "<script type='text/javascript'>  window.onload = function(){alert(\"pls select a person from your department for addressing duties\");}</script>";
		}
		else {	


				$query = "INSERT INTO mt_leave (EMP_NO,L_FROM, L_TO,NO_OF_DAYS,APPLIED_ON,REASON,L_type,HOD_APPROVED,PRINCIPAL_APPROVED,ADM_APPROVED,FN) 
						VALUES (?,?,?,?,?,?,?,?,?,?,?)";

				$stmt = mysqli_prepare($conn, $query);
				if ($stmt)
				{
							mysqli_stmt_bind_param($stmt, "sssssssssss",$param_emp_no , $param_l_from ,$param_l_to ,$param_no_of_days,$param_applied_on,$param_reason,$param_leave_type,$param_status,$param_pr_status,$param_adm_status,$param_fn);
							// Set these parameters
							$param_l_from = $l_from;
							$param_l_to = $l_to;
							$param_no_of_days = $total_days;
							$param_applied_on = $applied_date;
							$param_reason = $reason;
							$param_emp_no = $emp_no;
							$param_status =$status ;
							$param_pr_status = $pr_status ;
							$param_leave_type = $leave_type ;
							$param_adm_status = $adm_status ;
							$param_fn = $fn;
							
							if (mysqli_stmt_execute($stmt))
							{

								echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
							//	echo "query 1";

							}
							else
							{
								echo "Something went wrong... cannot redirect!";
							}
						
						
							mysqli_stmt_close($stmt); 
					}
					$count="SELECT LEAVE_ID FROM mt_leave";
					$counter = mysqli_query($conn , $count)or die( mysqli_error($conn));
							if(mysqli_num_rows($counter))
							{
								while ($row = mysqli_fetch_array($counter))
								{
								//echo "<script type='text/javascript'> window.onload = function(){alert(\"remaining casual leaves = $row[0]\");}</script>";
									//echo "query 2";
								$last_id = $row['LEAVE_ID'];
							//	echo "<script type='text/javascript'>  window.onload = function(){alert(\"$last_id\");}</script>";
								

								}
							}// echo "query3";

							
				$query2="INSERT INTO  casual_leave (LEAVE_ID,EMP_NO,type_of_day,atd_emp_no,atd_emp_name,half_day_date,permission) VALUES (?,?,?,?,?,?,?)";
				$stmt2= mysqli_prepare($conn, $query2);
				if ($stmt2)
				{		  
					
							mysqli_stmt_bind_param($stmt2, "sssssss",$param_last_id,$param_emp_no,$param_type_of_day,$param_atd_emp_no,$param_atd_emp_name,$param_half_day_date,$param_prefix_suffix);
							// Set these parameters
						
							$param_emp_no = $emp_no ;
							$param_last_id =$last_id ;
							$param_type_of_day = $fn ;
							$param_atd_emp_no = $atd_empno ;
							$param_atd_emp_name = $atd_name ;
							$param_half_day_date = $halfdate;
							$param_prefix_suffix = $permission;
					
							// Try to execute the query
							if (mysqli_stmt_execute($stmt2))
							{

								//echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
								

							}
							else
							{
								echo "Something went wrong... cannot redirect!";
							}
					
							mysqli_stmt_close($stmt2); 
					}
			}
		}	
}
}





?>
<!DOCTYPE html>
<html>
<head>
	<title>APPLICATION FOR CASUAL LEAVE</title>
	<!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
	<!-- Script -->
	
	

	
</head>
<body>
	
<!-- //header-ends -->
		<!-- main content start-->
		
		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method="POST" action="#"  onsubmit=" confirm('Are you sure you want to submit this form?');">
								<input type="hidden" name="leave_type" value="casual leave">
									
								 <h2 style="text-align: center; margin-top: 5px;font-sixe:30px;">APPLICATION FOR CASUAL LEAVE FOR <?php echo "$department" ;?></h2><br>
							    
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label" >Date :</label>
									<div class="col-sm-2" >
										<input type="date" class="form-control1" id="date" placeholder="" name="date"
										value="<?php echo date("Y-m-d");?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>" readonly>
									</div>
									
								
								
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>"	readonly>
									</div>
									
								<div class="form-group">
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="Designation"
										value="<?php echo "$designation" ;?>" readonly>
									</div>
								</div> 
								

							
	
								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label" >Leave from :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date" class="form-control" id="pick_date" 
									onchange="call_func()" max="2020-12-31" min="2020-01-01"> 
									</div>
								    <label class="col-sm-1 control-label">to</label>
								    <div class="col-sm-2">
										<input type="date" name="drop_date" class="form-control" id="drop_date" 
									onchange="call_func()" max="2020-12-31" min="2020-01-01"> 
									</div>
									
									
									<div class="col-sm-3">
									<input type="text" name="total_days" class="form-control" id="numdays" placeholder="Total number of days"	readonly>										<input type="hidden" class="form-control" name="diff" id="diff">
									</div>
								</div>
	
							<div class="form-group">	
									
									<label for="Halfday" class="col-sm-3 control-label">Halfday/FN/AN :</label>
									<div class="col-sm-5">
										<label class="col-sm-2 control-label">halfday: </label>
										<input class="col-sm-1 " type="radio"  id="half_day" placeholder="" name="fn"  value="half-day"  style="margin-top:15px;"
										 onclick="document.getElementById('half_day_date').style.display = 'block'; " onchange="call_func()" >
										<label class="col-sm-2 control-label" >fullday: </label>
										<input type="radio"  class="col-sm-1" id="half_day" placeholder="" name="fn" value="full-day"  style="margin-top:15px;"
										onclick="document.getElementById('half_day_date').style.display = 'none'; 
										document.getElementById('half_day_date').value='0000-00-00';"onchange="call_func()" >

									</div>

									
									<div class="col-sm-2">
									<input type="date" name="half_day_date" class="col-sm-2 form-control" id="half_day_date" onchange="if(document.getElementById('halfday').value=='half-day')
										{
											if((document.getElementById('half_day_date').value != document.getElementById('pick_date').value )&&
												(document.getElementById('half_day_date').value != document.getElementById('drop_date').value))
											{
												
												document.getElementById('button').style.display = 'none';
										
											}
										}">
									</div>
								</div>

							

								<div class="form-group">
									<label for="" class="col-sm-4 control-label">with permission to prefix/suffix sunday/holiday on :</label>
									<div class="col-sm-7">
										<input type="text" name="permission" class="form-control1" style="margin-top: 10px;">
									</div>
									
									
								</div>


						

<script type='text/javascript'>
    $( function() {
  
        $( "#autocomplete1" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete1').val(ui.item.label); // display the selected text
                $('#selectuser_id1').val(ui.item.value); // save selected id to input
			
                return false;
            }
        });

        // Multiple select
        $( "#multi_autocomplete" ).autocomplete({
            source: function( request, response ) {
                
                var searchText = extractLast(request.term);
                $.ajax({
                    url: "fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: searchText
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function( event, ui ) {
                var terms = split( $('#multi_autocomplete').val() );               
                terms.pop();                
                terms.push( ui.item.label );               
                terms.push( "" );               
                return false;
            }    
        });
    });
</script>


								<div class=" form-group">
									<label  class="col-sm-3 control-label" >Arrangement for duties in absence</label>
									<div class="col-sm-3">
										<input type="text" id='autocomplete1'  name="atd_empname" class="form-control1" placeholder="Enter Employee Initals" >
									</div>
									<div  class="col-sm-2">
									<input type="text" id='selectuser_id1' name="atd_emp_no" class="form-control1" placeholder="Employee No" readonly/> 
									</div>
									
								</div>
							

 


								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  name="reason"> 
									</div>		
								</div>

								

								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 35%;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info"  
										value="Submit"  name="submit" onclick='' >
										
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
		
