<?php



//require_once "config.php";
require_once "header1.php";



if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$applied_date = $_POST['date'];
	$l_from = $_POST['pickup_date']; 
	$l_to = $_POST['drop_date'];
	$l1_from = $_POST['pickup_date1']; 
	$l1_to = $_POST['drop_date1'];
	$l2_from = $_POST['pickup_date2']; 
	$l2_to = $_POST['drop_date2'];
	$status = 'Pending';
	$pr_status = "Pending";
	$leave_type = $_POST['leave_type'];
	$emp_no = $_SESSION['Emp_no'];

	
	$query1 = "SELECT * FROM mt_leave ; "; 
	$result1 = mysqli_query($conn , $query1)or die( mysqli_error($conn));
	$row = mysqli_num_rows($result1);
	
    $count = $row;
	echo $count;




	$query = "INSERT INTO mt_leave (EMP_NO,APPLIED_ON,L_type,HOD_APPROVED,PRINCIPAL_APPROVED) VALUES (?,?,?,?,?);";

	$stmt = mysqli_prepare($conn, $query);
        if ($stmt)
           {
                    mysqli_stmt_bind_param($stmt, "sssss",$param_emp_no ,$param_applied_on,$param_leave_type,$param_status,$param_pr_status);






                    	

                    // Set these parameters
                   
                   /* $param_l_from = $l_from;
                    $param_l_to = $l_to;
                    $param_no_of_days = $total_days;*/
                    $param_applied_on = $applied_date;
                   // $param_reason = $reason;
                    $param_emp_no = $emp_no;
                    $param_status =$status ;
                    $param_pr_status = $pr_status ;
					$param_leave_type = $leave_type ;
					
					
		   }


$query2 = "INSERT INTO vacation (EMP_NO,vsn1from,vsn1to,vsn2from,vsn2to,vsn3from,vsn1to,leave_id) VALUES (?,?,?,?,?,?,?,?);";

$stmt = mysqli_prepare($conn, $query2);
	if ($stmt)
	   {
				mysqli_stmt_bind_param($stmt, "ssssssss",$param_emp_no ,$param_0_from,$param_0_to,$param_1_from,$param_1_to,$param_2_from,$param_2_to,$param_count);					

				// Set these parameters


			    
			    $param_0_from = $l_from;
				$param_0_to = $l_to;
				$param_l_from = $l1_from;
				$param_l_to = $l1_to;
				$param_2_from = $l2_from;
				$param_2_to = $l2_to;
				$param_count = $count;
				$param_emp_no = $emp_no;
				

				
                    // Try to execute the query
                    if (mysqli_stmt_execute($stmt))
                    {

                    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
                    	header("locationn : holiday.php");

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
	<title>APPLICATION FOR vacation leave </title>
	<script type="text/javascript">
        function GetDays(){
                var dropdt = new Date(document.getElementById("drop_date").value);
                var pickdt = new Date(document.getElementById("pick_date").value);
                return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }

        function call(){
        if(document.getElementById("drop_date")){
            document.getElementById("numdays").value=GetDays();
            
        }  
    }

    </script>

    <script type="text/javascript">
        function GetDays1(){
                var dropdt = new Date(document.getElementById("drop_date1").value);
                var pickdt = new Date(document.getElementById("pick_date1").value);
                return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }

        function call1(){
        if(document.getElementById("drop_date1")){
            document.getElementById("numdays1").value=GetDays1();
           
        }  
    }

    </script>



    <script type="text/javascript">
        function GetDays2(){
                var dropdt = new Date(document.getElementById("drop_date2").value);
                var pickdt = new Date(document.getElementById("pick_date2").value);
                return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }

        function call2(){
        if(document.getElementById("drop_date2")){
            document.getElementById("numdays2").value=GetDays2();
           
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
								<input type="hidden" name="leave_type" value="vacation leave">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for Leave on Medical Ground</h2><br>
							
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
										<input  type="text" class="form-control1" id="firstname" placeholder="First Name" value="<?php echo "$firstname" ;?>" name="firstname">
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="middlename" placeholder="Middle Name"value="<?php echo "$middlename" ;?>">
									</div>
									<div class="col-sm-3">
										<input  type="text" class="form-control1" id="lastname" placeholder="Last Name" value="<?php echo "$lastname" ;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="designation" placeholder="Designation"
										value="<?php echo $designation ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="department" class="col-sm-2 control-label">Department :</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" id="department" placeholder="Department"
										value="<?php echo $department ?>">
									</div>
								</div>
                                <br>

                                <table style="margin-left: 215px;">
								<tr>
									<th> Srno
									</th>
									<th>from 
									</th>
									<th>to
									</th>
									<th>No of days
									</th>	
								</tr>
								<tr>
									<td>
									
										<input  type="text" class="form-control1" id="Srno1" placeholder=" Srno1" value="1">
								
									</td>
									<td>
										<div >
										<input type="date" name="pickup_date" class="form-control1" id="pick_date" 
									onchange="call()">
									</div>

									</td>
									<td>
									<div >
                                    <input type="date" name="drop_date" class="form-control1" id="drop_date" 
									onchange="call()">
									</div>	
									</td>
									<td>
										<div >
										<input type="text" name="total_days" class="form-control1" id="numdays" placeholder="Total number of days">
									</div>
									</td>	

								</tr>

								<tr>
									<td>
										<input  type="text" class="form-control1" id="Srno2" placeholder=" Srno2" value="2">
									</td>
									<td>
										<div >
										<input type="date" name="hppickup_date" class="form-control1" id="pick_date1" 
									onchange="call1()"> 
									</div>

									</td>
									<td>
									<div >
									<input type="date" name="hpdrop_date1" class="form-control1" id="drop_date1" 
									onchange="call1()">
									</div>	
									</td>
									<td>
										<div >
										<input type="text" name="hptotal_days" class="form-control1" id="numdays1" placeholder="Total number of days">
										</div>
									</td>	

								</tr>

								<tr>
									<td>
										<input  type="text" class="form-control1" id="Srno1" placeholder=" Srno3" value ="3">
									</td>
									<td>
										<div >
										<input type="date" name="pickup_date2" class="form-control1" id="pick_date2" 
									onchange="call2()">
									</div>

									</td>
									<td>
									<div >
                                    <input type="date" name="drop_date2" class="form-control1" id="drop_date2" 
									onchange="call2()">
									</div>	
									</td>
									<td>
										<div >
										<input type="text" name="total_days2" class="form-control1" id="numdays2" placeholder="Total number of days">
									</div>
									</td>	

								</tr>
								</table>
								<br>

                                <!--
								<div class="form-group">
									<label for="probation" class="col-sm-2 control-label">Whether on probation or confirmed :</label>
									<div class="col-sm-9">
										<input type="text" class="form-control1" id="department" placeholder="" value="<?php echo $emp_type; ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Leave from :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date" class="form-control" id="pick_date" 
									onchange="call()" value="<?php echo date("Y-m-d");?>"> 
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
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="4" name="reason" name="reason"> </textarea>
									</div>
									
										
								</div>

								<div class="form-group">
									<label  class="col-sm-2 control-label">Medical practitioner's Certificate with reg.no. attached ,yes/no :</label>
											<div class="radio-inline"><label><input type="radio"> Yes</label></div>
										<div class="radio-inline"><label><input type="radio" checked=""> No</label></div>
									
								</div>



								<div class="form-group">
									<label  for="address" class="col-sm-2 control-label">Address During Leave :</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="3" name="reason"> </textarea>
									</div>
									
										
								</div>


								<div class="form-group">
									<label for="namepersoninfomed" class="col-sm-2 control-label">Name Of the person informed :</label>
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
									<label  for="arr_duties" class="col-sm-2 control-label">Arrangement for performance of duties during absence:</label>
									<div class="col-sm-5">
										<input type="text" name="" class="form-control1" >
									</div>
									
										
								</div>
								<br>
								<br>
-->

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
   
