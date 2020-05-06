<?php
//require_once "config.php";
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
	$leave_type = $_POST['leave_type'];
	$certificate = $_POST['radio1'];
	$add = $_POST['address'];
	$atd_empno=$_POST['atd_emp_no'];
	$atd_name= $_POST['atd_empname'];

	$file=$_FILES["myFile"]["name"];
	$file=preg_replace("/\s+/","-",$file);   // removes blank spaces in file name
	$file_temp_name=$_FILES["myFile"]["tmp_name"];
	$file_size=$_FILES["myFile"]["size"];
	$file_type=$_FILES["myFile"]["type"];
	$file_ext=pathinfo($file,PATHINFO_EXTENSION);
	$file_name=pathinfo($file,PATHINFO_FILENAME);
	

	if (($file_ext !='pdf') &&	($certificate == "Yes"))
					{// file validations
						echo "<script type='text/javascript'>  window.onload = function(){alert(\" pls upload  pdf files\");}</script>";
					}
	elseif ($t_md_leave <  $total_days)
					{
						echo "<script type='text/javascript'>  window.onload = function(){alert(\" remaining leaves is less than applied leaves\");}</script>";
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
		$query = "INSERT INTO mt_leave (EMP_NO,L_FROM, L_TO,NO_OF_DAYS,APPLIED_ON,REASON,L_type,HOD_APPROVED,PRINCIPAL_APPROVED) VALUES (?,?,?,?,?,?,?,?,?)";

	$stmt = mysqli_prepare($conn, $query);
        if ($stmt)
           {
                    mysqli_stmt_bind_param($stmt, "sssssssss",$param_emp_no , $param_l_from ,$param_l_to ,$param_no_of_days,$param_applied_on,$param_reason,$param_leave_type,$param_status,$param_pr_status);

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
				
					
					
				    	if (mysqli_stmt_execute($stmt))
                    	{
                    		echo "<script type='text/javascript'>  window.onload = function(){alert(\" data inserted successfully\");}</script>";
                    	
						}
                    	else{
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
							
									$last_id = $row['LEAVE_ID'];
									echo "<script type='text/javascript'>  window.onload = function(){alert(\"$last_id\");}</script>";
								 
		 
								   }
							 } 



	$final_path = "files/".$file_name."---".$empname."-".$last_id.".".$file_ext;
	echo "$final_path";
	$path = move_uploaded_file($file_temp_name,$final_path);

					 
		$query2="INSERT INTO  medical_leave (LEAVE_ID,EMP_NO,certi,atd_emp_no,atd_emp_name,add_ress,file_path) VALUES (?,?,?,?,?,?,?)";
		$stmt2= mysqli_prepare($conn, $query2);
				 if ($stmt2)
					{		echo "<script type='text/javascript'>  window.onload = function(){alert(\"i am here\");}</script>";
							 mysqli_stmt_bind_param($stmt2, "sssssss",$param_last_id,$param_emp_no,$param_certificate,$param_atd_emp_no,$param_atd_emp_name,$param_add,$param_file);
							 // Set these parameters
							 
							 $param_emp_no = $emp_no ;
							 $param_last_id =$last_id ;
							 $param_certificate = $certificate ;
							 $param_atd_emp_no = $atd_empno ;
							 $param_atd_emp_name = $atd_name ;					 
							 $param_add = $add ;
							 $param_file=$final_path;
							
							echo "<script type='text/javascript'>  window.onload = function(){alert(\" file uploaded\");}</script>";
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
	}	 }							
}
?>		 

<!DOCTYPE html>
<html>
<head>
	<title>APPLICATION FOR MEDICAL  LEAVE </title>
	<!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
	<script type="text/javascript">
        function GetDays(){
        	    var fullday = document.getElementById("half_day");
        	    if(fullday.checked)
                {
	                var dropdt = new Date(document.getElementById("drop_date").value);
	                var pickdt = new Date(document.getElementById("pick_date").value);
	                var ans = (dropdt - pickdt) / (24 * 3600 * 1000) + 0.5;
	                return ans;
       			 }
        		else
        		{	
	        		var dropdt = new Date(document.getElementById("drop_date").value);
	                var pickdt = new Date(document.getElementById("pick_date").value);
	                var ans = ((dropdt - pickdt) / (24 * 3600 * 1000)+1) ;
	                return ans;	
        		}
    }
        function call_func(){
        if(document.getElementById("drop_date")){
            document.getElementById("numdays").value=GetDays();
        }  
    }

	
</script>

<script type="text/javascript">
        function GetDays(){
                var dropdt = new Date(document.getElementById("drop_date").value);
                var pickdt = new Date(document.getElementById("pick_date").value);
                return parseInt(((dropdt - pickdt) / (24 * 3600 * 1000))+1);
        }

        function call(){
        if(document.getElementById("drop_date")){
            document.getElementById("numdays").value=GetDays();
        }  
    }

    </script>
	<!-- Script -->
</head>
<body>
<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
							<form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data">
								<input type="hidden" name="leave_type" value="medical leave">
							 	<h2 style="text-align: center; margin-top: 15px;">Application for Leave on Medical Ground FOR <?php echo "$department" ;?></h2><br>
							
								<div class="form-group">
									<label for="date" class="col-sm-9 control-label">Date :</label>
									<div >
										<input type="date" style="width: 15%;" class="form-control1" id="date" name="date" placeholder=""
										value="<?php echo date("Y-m-d");?>" readonly>
									</div>
									
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-1 control-label">Name :</label>
									<div class="col-sm-2">
										<input  type="text" class="form-control1" id="firstname" placeholder="First Name" value="<?php echo  "$firstname   $middlename   $lastname";?>" name="firstname" readonly>
									</div>
									
							
								<div class="form-group">
									<label for="employee no." class="col-sm-2 control-label">Employee no.</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>" readonly>
									</div>
									
								
								<div class="form-group">
									<label for="designation" class="col-sm-2 control-label">Designation :</label>
									<div class="col-sm-2">
										<input type="text" class="form-control1" id="designation" placeholder="Designation"
										value="<?php echo $designation ?>" readonly>
									</div>
								</div>
								
								<div class="form-group">
								
									<label  class="col-sm-3 control-label">Medical practitioner's Certificate :</label>
									<div class="col-sm-3">
										<label class="col-sm-2 control-label">Yes </label>
										<input class="col-sm-1 " type="radio"  id="radio1" placeholder="" name="radio1"  value="Yes"  style="margin-top:15px;"
										onclick	= "document.getElementById('myFile').style.display = 'block'; " >
										<label class="col-sm-2 control-label" >No </label>
										<input class="col-sm-1 " type="radio"  class="col-sm-1" id="radio1" placeholder="" name="radio1" value="No"	style="margin-top:15px;"
										onclick="	document.getElementById('myFile').style.display = 'none';"></div>
									<div class="col-sm-2">	<input type="file" class="form-control1" style="margin-left:-150px;"  id= "myFile" name="myFile" accept="pdf" /></div>

								
								
										<label for="probation" class="col-sm-2 control-label"> probation or confirmed :</label>
										<div class="col-sm-1">
											<input type="text" class="form-control1" id="" placeholder="" value="<?php echo $emp_type; ?>" readonly>
										</div>
								
								
								</div>

								<div class="form-group">
									<label for="Leavedate" class="col-sm-2 control-label">Leave from :</label>
									<div class="col-sm-2">
										<input type="date" name="pickup_date" class="form-control" id="pick_date" 
									onchange="call_func()" > 
									</div>
								    <label class="col-sm-1 control-label">to</label>
								    <div class="col-sm-2">
										<input type="date" name="drop_date" class="form-control" id="drop_date" 
									onchange="call_func()"> 
									</div>
									<div class="col-sm-3">
										<input type="text" name="total_days" class="form-control" id="numdays" placeholder="Total number of days" readonly>
									</div>
								</div>

								<div class="form-group">
									<label  for="reason" class="col-sm-2 control-label">Reason for leave :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control"  id="reason" name="reason">
									</div>	
								</div>


								<div class="form-group">
									<label  for="address" class="col-sm-2 control-label">Address During Leave :</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" rows="3" name="address">
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
							



								<div class="form-group" >
									<div class="col-sm-10" style="margin-left: 35%;">
										<input type="submit" id="button" class="col-sm-2 btn btn-info" value="Submit">
									</div>
									
								</div>
						</form>


								







		<!--footer-->
		<div id="footer2" style="background: #6495Ed; height: 100px;">
		
			<div id="site-copyright" style="margin-top: 20px; margin-left: 30%; padding: 20px; font-size: 12px; color: black;">Shah & Anchor Kutchhi Engineering College<br>
Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br>
© Shah & Anchor Kutchhi Engineering College.</div>	<!-- #site-info -->
				
		</div><!-- #footer2 -->	
	</div>
	
	
</body>
</html>		
   
