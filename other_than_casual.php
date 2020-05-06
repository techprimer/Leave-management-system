<?php

require_once "header1.php";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$applied_date = $_POST['date']; 	
	$total_days = (intval($_POST['numdays']) + intval($_POST['numdays1']) + intval($_POST['numdays2']));				
	$reason = $_POST['reason'];
	$emp_no = $_SESSION['Emp_no'];
	$status = 'Pending';
	$pr_status = "Pending";
	$leave_type = $_POST['leave_type'];
	$probation = $_POST['wop'];
			
	$atd_empno=$_POST['atd_emp_no'];			
	$atd_name= $_POST['atd_empname'];			
	$el_from = $_POST['pickup_date'];
	$el_to = $_POST['dropup_date'];
	$hp_from = $_POST['pickup_date1'];
	$hp_to = $_POST['dropup_date1'];
	$eo_from = $_POST['pickup_date2'];

	$eo_to = $_POST['dropup_date2'];	
	$address=$_POST['add_ress'];
	
	$days1 = $_POST['diff'];
	$days2 =$_POST['diff1'];
	$days3 =$_POST['diff2'];
	

	if(	($total_days < 15 ) &&((	$days1<10	)||(	$days2<10	)||(	$days3<10	))){
		echo "<script type='text/javascript'>  window.onload = function(){alert(\"pls change start point of ur leave\");}</script>";
	}
	elseif(	($total_days >15 &&  $total_days <30	) &&((	$days1<20		)(	$days2<20	)(	$days3<20	))){
		echo "<script type='text/javascript'>  window.onload = function(){alert(\"pls change start point of ur leave\");}</script>";
	}
	elseif(	($total_days >30 	) &&((	$days1<30		)(	$days2<30	)(	$days3<30	))){
		echo "<script type='text/javascript'>  window.onload = function(){alert(\"pls change start point of ur leave\");}</script>";
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
		else{
	$query = "INSERT INTO mt_leave (EMP_NO,L_FROM,L_TO,NO_OF_DAYS,APPLIED_ON,REASON,L_type,HOD_APPROVED,PRINCIPAL_APPROVED) VALUES (?,?,?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($conn, $query);
        if ($stmt)
           {
					mysqli_stmt_bind_param($stmt,"sssssssss",$param_emp_no,$param_el_from,$param_el_to,$param_no_of_days,$param_applied_on,$param_reason,$param_leave_type,$param_status,$param_pr_status);
                    // Set these parameters
                  
                    $param_no_of_days = $total_days;
                    $param_applied_on = $applied_date;
                    $param_reason = $reason;
                    $param_emp_no = $emp_no;
                    $param_status =$status ;
                    $param_pr_status = $pr_status ;
					$param_leave_type = $leave_type ;
					$param_el_from	=$el_from;
					$param_el_to = $el_to;
				

				
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
			$count="SELECT LEAVE_ID FROM mt_leave";
			$counter = mysqli_query($conn , $count)or die( mysqli_error($conn));
					if(mysqli_num_rows($counter))
					{
		 				 while ($row = mysqli_fetch_array($counter))
		  				{
		  		 		$last_id = $row['LEAVE_ID'];
						   echo "<script type='text/javascript'>  window.onload = function(){alert(\"$last_id\");}</script>";
		 				 }
					} echo "<script type='text/javascript'>  window.onload = function(){alert(\"query 3\");}</script>";

					
		$query2="INSERT INTO  other_than_casual (EMP_NO,LEAVE_ID,probation,el_from,el_to,hp_from,hp_to,eo_from,eo_to,add_ress,atd_emp_no,atd_emp_name) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt2= mysqli_prepare($conn, $query2);
        if ($stmt2)
           {		echo "<script type='text/javascript'>  window.onload = function(){alert(\"i am here\");}</script>";
					mysqli_stmt_bind_param($stmt2, "ssssssssssss",
					$param_emp_no,$param_last_id,$param_probation,$param_el_from,$param_el_to,$param_hp_from,$param_hp_to,$param_eo_from,$param_eo_to,$param_address,$param_atd_emp_no,$param_atd_emp_name);
                    // Set these parameters
				
					$param_emp_no = $emp_no ;
					$param_last_id =$last_id ;
					
					$param_atd_emp_no = $atd_empno ;
					$param_atd_emp_name = $atd_name ;
                 
					
					$param_probation = $probation;
					$param_address= $address;
	
					$param_el_from = $el_from;
					$param_el_to = $el_to;
					$param_hp_from = $hp_from;
					$param_hp_to = $hp_to;
					$param_eo_from = $eo_from;
					$param_eo_to = $eo_to;
			
                    // Try to execute the query
                    if (mysqli_stmt_execute($stmt2))
                    {

                    	echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
                    	

					}
					else
					{
                        echo "Something went wrong... cannot redirect!";
					}
			
                     mysqli_stmt_close($stmt2); 
            }
	}}                 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Application for Leave on other than casual leave</title>


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

<!-- Script -->
<script src='jquery-3.1.1.min.js' type='text/javascript'></script>

<!-- jQuery UI -->
<link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
<script src='jquery-ui.min.js' type='text/javascript'></script>
<!-- Script -->

  <style type="text/css">
  	body
  	{
  		color: black;
  	}
  </style>

</head>
<body>
	<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method="POST" action="#">
								<input type="hidden" name="leave_type" value="other_than_casual">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for Leave on other than casual leave for <?php echo "$department" ;?> </h2><br><br>
							
								<div class="form-group">
									<label for="date"  class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" id="date" placeholder="" name="date" id="date" value="<?php echo date("Y-m-d");?>" readonly>
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
										<input type="text" class="form-control1" id="designation" placeholder="Designation" name="desgn" value="<?php echo "$designation" ;?>" readonly>
									</div>
								</div>
							


								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Earned Leave :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date" class="form-control" id="pick_date" onchange="call()" max="2020-12-31" min="2020-01-01" required >
									
									</div>
								    <label class="col-sm-1 control-label" style="text-align:center;">to</label>
								    <div class="col-sm-2">
										<input type="date" name="dropup_date" class="form-control" id="drop_date"  
									onchange="call()"  max="2020-12-31" min="2020-01-01" required> 
									</div>
									<div class="col-sm-3">
										<input type="text"  class="form-control" name="numdays" id="numdays" placeholder="Total number of days" readonly>
										<input type="hidden" class="form-control" name="diff" id="diff">
									</div>
								</div>

								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Haf pay leave :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date1" class="form-control" id="pick_date1"  
									onchange="call1()"  max="2020-12-31" min="2020-01-01" required> 
									</div>
								    <label class="col-sm-1 control-label" style="text-align:center;">to</label>
								    <div class="col-sm-2">
										<input type="date" name="dropup_date1" class="form-control" id="drop_date1"  
									onchange="call1()"  max="2020-12-31" min="2020-01-01" required> 
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
									onchange="call2()"  max="2020-12-31" min="2020-01-01" required> 
									</div>
								    <label class="col-sm-1 control-label" style="text-align:center;">to</label>
								    <div class="col-sm-2">
										<input type="date" name="dropup_date2" class="form-control" id="drop_date2" 
									onchange="call2()"  max="2020-12-31" min="2020-01-01" required> 
									</div>
									<div class="col-sm-3">
										<input type="text" name="numdays2" class="form-control" id="numdays2" placeholder="Total number of days" readonly>
										<input type="hidden" class="form-control" name="diff2" id="diff2">
									</div>
								</div>

								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-8">
										<input type="text" class="form-control"  name="reason" required> 
									</div>
									
										
								</div>


								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Address during leave period :</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="add_ress" id="add" required> 
									</div>		
								</div>

								<div class="form-group">
									<label for="employee no." class="col-sm-2 control-label">probation or confirmed:</label>
									<div class="col-sm-1">
										<input type="text" class="form-control1" id="wop" placeholder="" name="wop" value="<?php echo "$emp_type" ;?>" readonly>
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
										<input type="text" id='autocomplete1'  name="atd_empname" class="form-control1" placeholder="Enter Employee Initals" required >
									</div>
									<div  class="col-sm-2">
									<input type="text" id='selectuser_id1' name="atd_emp_no" class="form-control1" placeholder="Employee No" readonly/>
									</div>
									
								</div>
								

								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 35%;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info" value="Submit" style="">
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


		
