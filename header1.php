
<?php

session_start();

require_once "config.php";


if (isset($_SESSION["Emp_no"]))
 {	
 	$empname = $_SESSION["Emp_no"];
 	//$firstname = isset($_SESSION['firstname']);
 } 



$sql = "SELECT F_NAME,M_NAME,L_NAME,EMP_NO,EMP_TYPE,mt_grade_mst.DESIGNATION,mt_dept_mst.dept_nm 
		FROM mt_emp  INNER JOIN mt_grade_mst 
		ON mt_emp.GRADE_ID = mt_grade_mst.GRADE_ID  
		INNER JOIN mt_dept_mst ON mt_emp.dept_id = mt_dept_mst.dept_id   WHERE Emp_no = '" . $_SESSION['Emp_no'] . "'";
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
		 		$emp_type = $row['EMP_TYPE'];


		}


}


$total_leave = 10 ;

$query1 = "SELECT SUM(NO_OF_DAYS) FROM mt_leave  WHERE L_TYPE = 'casual leave' AND EMP_NO = '$empname'  AND (	(HOD_APPROVED ='Pending') OR (HOD_APPROVED ='Approved') OR (PRINCIPAL_APPROVED ='Pending') OR (PRINCIPAL_APPROVED ='Approved') )	;"; 
$result1 = mysqli_query($conn , $query1)or die( mysqli_error($conn));
if(mysqli_num_rows($result1) < $total_leave)
{
		  while ($row = mysqli_fetch_array($result1))
		  {
		  		  //echo "<script type='text/javascript'> window.onload = function(){alert(\"remaining casual leaves = $row[0]\");}</script>";

		  		  $t_leave = $total_leave - $row[0];


		  }
}

$total_md_leave = 10 ;

$query1 = "SELECT SUM(NO_OF_DAYS) FROM mt_leave  WHERE L_TYPE = 'medical leave' AND EMP_NO = '$empname'  AND (	(HOD_APPROVED ='Pending') OR (HOD_APPROVED ='Approved') OR (PRINCIPAL_APPROVED ='Pending') OR (PRINCIPAL_APPROVED ='Approved') )	;";
$result1 = mysqli_query($conn , $query1)or die( mysqli_error($conn));
if(mysqli_num_rows($result1) < $total_md_leave)
{
		  while ($row = mysqli_fetch_array($result1))
		  {
		  		  //echo "<script type='text/javascript'> window.onload = function(){alert(\"remaining casual leaves = $row[0]\");}</script>";

		  		  $t_md_leave = $total_md_leave - $row[0];


		  }
}

$total_credit = 0;

$query1 = "SELECT SUM(NO_OF_DAYS) FROM mt_leave  WHERE L_TYPE = 'credit work' AND EMP_NO = '$empname'   AND (	 (HOD_APPROVED ='Approved') AND (PRINCIPAL_APPROVED ='Approved') )	;";
$result1 = mysqli_query($conn , $query1)or die( mysqli_error($conn));
if(mysqli_num_rows($result1))
{
		  while ($row = mysqli_fetch_array($result1))
		  {
		  		  //echo "<script type='text/javascript'> window.onload = function(){alert(\"remaining casual leaves = $row[0]\");}</script>";

		  		  $t_credit = $total_credit + $row[0];


		  }
		  $remainder = $t_credit % 7;
		  if ($remainder < 4)
		  {
			  $credit = intval($t_credit / 7) ;
		  }
		  else{
			$credit = floatval(intval($t_credit / 7) + 0.5 ) ;
		  }
}
// link credit leave and coff in header and credit view
$total_coff_leave = $credit;

$query1 = "SELECT SUM(NO_OF_DAYS) FROM mt_leave  WHERE L_TYPE = 'coff' AND EMP_NO = '$empname'  AND (	(HOD_APPROVED ='Pending') OR (HOD_APPROVED ='Approved') OR (PRINCIPAL_APPROVED ='Pending') OR (PRINCIPAL_APPROVED ='Approved') )	;";
$result1 = mysqli_query($conn , $query1)or die( mysqli_error($conn));
if(mysqli_num_rows($result1) < $total_leave)
{
		  while ($row = mysqli_fetch_array($result1))
		  {
		  		  //echo "<script type='text/javascript'> window.onload = function(){alert(\"remaining casual leaves = $row[0]\");}</script>";

		  		  $coff_leave = $total_coff_leave - $row[0];


		  }
}




?>






<!DOCTYPE HTML>
<html>
<head>
<title>LEAVE MANAGEMENT SYSTEM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href = "/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
<script src = "/scripts/jquery.min.js"></script>
<script src = "/bootstrap/js/bootstrap.min.js"></script>
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="icon" href="sakec.PNG">

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS -->

 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

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
   	$(document).ready(function () {
	function calculate() {
        var hours = parseInt($(".Time2").val().split(':')[0], 10) - parseInt($(".Time1").val().split(':')[0], 10);
        if(hours < 0) hours = 24 + hours;
        $(".Hours").val(hours);
    }
    $(".Time1,.Time2").change(calculate);
    	calculate();
});

    </script>

		
<script type="text/javascript">
        function GetDays(){
        	    var fullday = document.getElementById("half_day");
        	    if(fullday.checked)
                {	
					var appdt = new Date(document.getElementById("date").value);
	                var dropdt = new Date(document.getElementById("drop_date").value);
	                var pickdt = new Date(document.getElementById("pick_date").value);
	                var ans = (dropdt - pickdt) / (24 * 3600 * 1000) + 0.5;
					var diff= ((pickdt - appdt) / (24 * 3600 * 1000)+1) ;
					document.getElementById("diff").value=diff;
	                return ans;
       			 }
        		else
        		{						
					var appdt = new Date(document.getElementById("date").value);
	        		var dropdt = new Date(document.getElementById("drop_date").value);
	                var pickdt = new Date(document.getElementById("pick_date").value);
	                var ans = ((dropdt - pickdt) / (24 * 3600 * 1000)+1) ;
					var diff= ((pickdt - appdt) / (24 * 3600 * 1000)+1) ;
					document.getElementById("diff").value=diff;
	                return ans;	
        		}
    }
        function call_func(){
        if(document.getElementById("drop_date")){
            document.getElementById("numdays").value=GetDays();
        }  
    }
</script>


  <style type="text/css">
  	body
  	{
  		color: black;
  	}
  	.form-control1
  	{
  		color: black;

  	}
  </style>

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left" >
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"  href="#"><span class="fa fa-area-chart"></span> Leave<span class="dashboard_text">system Dashboard</span></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
			 <li class="treeview">
                
                
               
                  <li><a href="casleave.php"> Casual Leave  <span style="background: orange; border-radius: 50%;color: white;font-size: 18px;text-align: center;padding: 2px 5px; float:right;" ><?php echo $t_leave;?></span></a></li>
                  <li><a href="medicalleave.php"> Medical leave <span style="background: orange; border-radius: 50%;color: white;font-size: 18px;text-align: center;padding: 2px 5px; float:right;"><?php echo $t_md_leave;?></a></li>
                  <li><a href="coff.php"> Compensatory leave <span style="background: orange; border-radius: 50%;color: white;font-size: 18px;text-align: center;padding: 2px 5px; float:right;"><?php echo $coff_leave;?></a></li>
                  <li><a href="tel.php">Telephonic message regarding absence </a></li>
                  <li><a href="od.php"> Outside offical work</a></li>
                  <li><a href="other_than_casual.php"> Other than casual leave</a></li>
                  <li><a href="creditleave.php"> credit period of extra work <span style="background: orange; border-radius: 50%;color: white;font-size: 18px;text-align: center;padding: 2px 5px; float:right;"><?php echo $credit;?> </a></li>
                  <li><a href="holiday.php"> Work on holidays and non-working day</a></li>
				  <li><a href="vacation.php"> Vacation leave</a></li>
                 <li><a href="emp_status.php" > My leaves </a></li>   
				 <li><a href="pending_leave.php" > My Pending leaves </a></li> 
          </li>
          </ul>
      </div>

              <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
					<ul class="nofitications-dropdown">
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">4</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 3 new messages</h3>
									</div>
								</li>
								<li><a href="#">
								   <div class="user_img"><img src="images/1.jpg" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor amet</p>
									<p><span>1 hour ago</span></p>
									</div>
								   <div class="clearfix"></div>	
								</a></li>
								<li class="odd"><a href="#">
									<div class="user_img"><img src="images/4.jpg" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor amet </p>
									<p><span>1 hour ago</span></p>
									</div>
								  <div class="clearfix"></div>	
								</a></li>
								<li><a href="#">
								   <div class="user_img"><img src="images/3.jpg" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor amet </p>
									<p><span>1 hour ago</span></p>
									</div>
								   <div class="clearfix"></div>	
								</a></li>
								<li>
									<div class="notification_bottom">
										<a href="#">See all messages</a>
									</div> 
								</li>
							</ul>
						</li>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">4</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 3 new notification</h3>
									</div>
								</li>
								<li><a href="#">
									<div class="user_img"><img src="images/4.jpg" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor amet</p>
									<p><span>1 hour ago</span></p>
									</div>
								  <div class="clearfix"></div>	
								 </a></li>
								 <li class="odd"><a href="#">
									<div class="user_img"><img src="images/1.jpg" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor amet </p>
									<p><span>1 hour ago</span></p>
									</div>
								   <div class="clearfix"></div>	
								 </a></li>
								 <li><a href="#">
									<div class="user_img"><img src="images/3.jpg" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor amet </p>
									<p><span>1 hour ago</span></p>
									</div>
								   <div class="clearfix"></div>	
								 </a></li>
								 <li>
									<div class="notification_bottom">
										<a href="#">See all notifications</a>
									</div> 
								</li>
							</ul>
						</li>	
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">8</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 8 pending task</h3>
									</div>
								</li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Database update</span><span class="percentage">40%</span>
										<div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										<div class="bar yellow" style="width:40%;"></div>
									</div>
								</a></li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
									   <div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										 <div class="bar green" style="width:90%;"></div>
									</div>
								</a></li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
										<div class="clearfix"></div>	
									</div>
								   <div class="progress progress-striped active">
										 <div class="bar red" style="width: 33%;"></div>
									</div>
								</a></li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
									   <div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										 <div class="bar  blue" style="width: 80%;"></div>
									</div>
								</a></li>
								<li>
									<div class="notification_bottom">
										<a href="#">See all pending tasks</a>
									</div> 
								</li>
							</ul>
						</li>	
					</ul>
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				
				<!--search-box-->
				<div class="search-box">
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>
				</div><!--//end-search-box-->
				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/2.jpg" alt=""> </span> 
									<div class="user-name">
										<p><?php echo $firstname ." ". $lastname; ?></p>
										<span><?php echo $designation;?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li>
								<li> <a href="#"><i class="fa fa-suitcase"></i> Profile</a> </li> 
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>



	
		<div id="header-full">
			<header id="header" style="padding-left:10%;">
				<div id="masthead">
					<div id="branding" role="banner">
							<img id="bg_image" alt=""  style="width: 70%; height: 65px; margin: 70px 0px 0px 260px; max-width: 100%; " title="" src="http://www.shahandanchor.com/home/wp-content/uploads/SKAEC-New_Header.png">	<div id="header-container">
				</div>			<div style="clear:both;"></div>
			</div><!-- #branding -->
		<a id="nav-toggle"><span>&nbsp;</span></a>
			<nav id="access" role="navigation">
	</nav>
</div>
</header>

</div>

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