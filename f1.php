<?php

require_once "header1.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>APPLICATION FOR APPRAISAL</title>
	<!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
	<!-- Script -->	
  <script>
        function _(x){
            return document.getElementById(x);
          }
      
        function displayPhase1(){
              _("phase1").style.display = "block";
              _("phase2").style.display = "none";
              _("phase3").style.display = "none";
              _("phase4").style.display = "none";
              _("phase5").style.display = "none";
              _("phase6").style.display = "none";


              _("progress-bar").style.width="0%";
              _("phase-value").textContent="Phase 1";
              _("progress-bar-value").textContent="0%";
        }

        function  displayPhase2(){
              _("phase1").style.display = "none";
              _("phase2").style.display = "block";
              _("phase3").style.display = "none";
              _("phase4").style.display = "none";
              _("phase5").style.display = "none";
              _("phase6").style.display = "none";

              _("progress-bar").style.width="25%";
              _("phase-value").textContent="Phase 2";
              _("progress-bar-value").textContent="25%";
          } 

        function  displayPhase3(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "block";
            _("phase4").style.display = "none";
            _("phase5").style.display = "none";
            _("phase6").style.display = "none";

            _("progress-bar").style.width="50%";
            _("phase-value").textContent="Phase 3";
            _("progress-bar-value").textContent="50%";
        } 

        function  displayPhase4(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "none";
            _("phase4").style.display = "block";
            _("phase5").style.display = "none";
            _("phase6").style.display = "none";

            _("progress-bar").style.width="50%";
            _("phase-value").textContent="Phase 3";
            _("progress-bar-value").textContent="50%";
        } 

        function  displayPhase5(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "none";
            _("phase4").style.display = "none";
            _("phase5").style.display = "block";
            _("phase6").style.display = "none";

            _("progress-bar").style.width="50%";
            _("phase-value").textContent="Phase 5";
            _("progress-bar-value").textContent="50%";
        } 

        function  displayPhase6(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "none";
            _("phase4").style.display = "none";
            _("phase5").style.display = "none";
            _("phase6").style.display = "block";

            _("progress-bar").style.width="50%";
            _("phase-value").textContent="Phase 6";
            _("progress-bar-value").textContent="50%";
        } 

        function submitForm(){
            _("multiphase").method = "post";
            _("multiphase").action = "#";
            _("multiphase").submit();
          } 
  </script>

</head>
<body onload="displayPhase1();">
<!-- //header-ends -->
		<!-- main content start-->

		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
          <form class="form-horizontal" id="multiphase" onsubmit="return false"  >
            
								
                                        <br>	
                        <h2 style="text-align: center; margin-top: 5px;font-sixe:30px;">APPLICATION FOR APPRAISAL</h2><br>
                        <div style="margin-left:40%;margin-right:40%">
                            <div class="task-info" >
                              <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 1</span><span class="percentage" id="progress-bar-value">0%</span>
                              <div class="clearfix"></div>	
                            </div>
                            <div class="progress progress-striped active">
                              <div class="bar green" id="progress-bar"  value="0" max="100"></div>
                            </div>
                        </div>

              <div id="phase1" style="display:none;"> 
                        <div class="form-group">
                          <label for="date" class="col-sm-9 control-label" style="" >Date :</label>
                          <div class="col-sm-2" >
                            <input type="date" class="form-control1" id="date" placeholder="" name="date"
                            value="<?php echo date("Y-m-d");?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="name" class="col-sm-1 control-label" >Name :</label>
                          <div class="col-sm-2">
                            <input  type="text" class="form-control1" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>" readonly>
                          </div>
                          
                        
                        
                          <label for="employee no." class="col-sm-2 control-label">Employee no.</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>"	readonly>
                          </div>
                          
                        
                          <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Designation :</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control1" id="designation" placeholder="Designation"
                            value="<?php echo "$designation" ;?>" readonly>
                          </div>
                        </div> 
                        

                  
          
                        <div class="form-group">
                          <label for="duaration" class="col-sm-1 control-label" >Duration : </label>
                          <div class="col-sm-2">
                            <input type="date" name="pickup_date" class="form-control" id="pick_date" > 
                          </div>
                        </div>

                        <label for="Title" class="col-sm-4 control-label" >Performance of engaging Lectures / Practicals :</label>

                        <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                        <tr>
                          <th style="width:3%;"> Srno
                          </th>
                          <th>Class
                          </th>
                          <th>Subject
                          </th>
                          <th>Lectures Targeted
                          </th>
                          <th>Lectures Enaged
                          </th>	
                          <th>Percentage 
                          </th>
                          
                        </tr>
                        <tr>
                          <td style="width:3%;">				
                          <input  type="text" class="form-control1"  id="Srno1" placeholder=" Srno1" value="1">
                          </td>

                          <td style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="class1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="subject1" placeholder="">
                          </div>	
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="lt1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="le1" placeholder="">
                          </div>
                          </td>	

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="p1" placeholder="">
                          </div>
                          </td>	

                        </tr>	
                        <tr>
                          <td style="width:3%;">				
                          <input  type="text" class="form-control1"  id="Srno1" placeholder=" Srno1" value="1">
                          </td>

                          <td style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="class1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="subject1" placeholder="">
                          </div>	
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="lt1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="le1" placeholder="">
                          </div>
                          </td>	

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="p1" placeholder="">
                          </div>
                          </td>	

                        </tr>	
                        <tr>
                          <td style="width:3%;">				
                          <input  type="text" class="form-control1"  id="Srno1" placeholder=" Srno1" value="1">
                          </td>

                          <td style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="class1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="subject1" placeholder="">
                          </div>	
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="lt1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="le1" placeholder="">
                          </div>
                          </td>	

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="p1" placeholder="">
                          </div>
                          </td>	

                        </tr>	
                        <tr>
                          <td style="width:3%;">				
                          <input  type="text" class="form-control1"  id="Srno1" placeholder=" Srno1" value="1">
                          </td>

                          <td style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="class1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:10%;">
                          <div >
                          <input type="text" class="form-control1" name="subject1" placeholder="">
                          </div>	
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="lt1" placeholder="">
                          </div>
                          </td>

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="le1" placeholder="">
                          </div>
                          </td>	

                          <td  style="width:5%;">
                          <div >
                          <input type="text" class="form-control1" name="p1" placeholder="">
                          </div>
                          </td>	

                        </tr>	
                        
                        
                        </table>
                          <br>

                          <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder=""  readonly>
                              </div>
                              
                            
                            
                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" 	readonly>
                              </div>
                              
                            
                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder=""
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
                                readonly>
                              </div>
                            </div> 
                            

                            <br>
                                <div class="form-group" >
                                                <div class="col-sm-10"style="margin-left: 35%;">
                                  <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="background: #ffb121;"
                                    value="Next"  name="submit" onclick=" displayPhase2()" >
                                    
                                  </div>
                                  
                                  </div>
                            
                  </div> <!-- end of phase 1 -->
                  
                  <div id="phase2" style="display:none;">
                          
                                 <label for="Title" class="col-sm-4 control-label" >Phase 2:</label>
                                  
                                <div class="form-group" >
                                                <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                    <input type="submit" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                    value="Previous"  name="submit" onclick="displayPhase1() " >
                                    
                                  
                                    <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                    value="Next"  name="submit" onclick=" displayPhase3()" >
                                    
                                  </div>
                                  
                                </div>

    

                  </div>  <!-- end of phase 2>  -->
                  <div id="phase3" style="display:none;"> 

                            <label for="Title" class="col-sm-4 control-label" >Phase 3:</label>

                            <div class="form-group" >
                                            <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                <input type="submit" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Previous"  name="submit" onclick=" displayPhase2()" >
                                
                              
                                <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Next"  name="submit" onclick=" displayPhase4()" >
                                
                              </div>
                              
                            </div>
                  
                  </div>  <!-- end of phase 3 -->

                  <div id="phase4" style="display:none;">
                        
                            <div class="form-group">
                              <label for="Title" class="col-sm-2 control-label" >phase 4 :</label><br><br>
                            </div>
                                                <br>
                              <div class="form-group" >
                                            <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                <input type="submit" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Previous"  name="submit" onclick="displayPhase3(); " >
                                
                              
                                <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Next"  name="submit" onclick=" displayPhase5();" onclick="document.getElementById('phase5')='block';" >
                                
                            </div>
                            </div>
                        
                            <!-- phase 5 3 rd mcq is not shown -->


                </div> <!-- end of phase 4 -->
                <div id="phase5" style="display:none;">
                                <div class="form-group">
                                    <label for="Title" class="col-sm-2 control-label" style="margin-left:5%;">Phase 5 :</label>
                                </div>  

                              <div class="form-group" >
                                            <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                <input type="submit" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Previous"  name="submit" onclick="displayPhase4() " >
                                
                              
                                <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Next"  name="submit" onclick=" displayPhase6()" >
                                
                              </div>

                </div>  <!-- end of phase 5 -->

                <div id="phase6" style="display:none;">
                   <div class="form-group" >

                                <div class="form-group">
                                    <label for="Title" class="col-sm-2 control-label" style="margin-left:5%;">Phase 6 :</label>
                                </div>  
                                
                                 <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                <input type="submit" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Previous"  name="submit" onclick="displayPhase5() " >
                                
                              
                                <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"
                                value="Next"  name="submit" onclick=" displayPhase7()" >
                                
                              </div>
                </div>
                </div>
              
            </form>
          </div>
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
		
