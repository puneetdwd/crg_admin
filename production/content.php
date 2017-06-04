<?php include "check_session.php"; ?>

<?php
    $link = mysql_connect('localhost', 'root', 'Crg@1234');
    if (!$link) {
            die('Could not connect: ' . mysql_error());
    }
    @mysql_select_db('crgv2', $link) or die( "Unable to select database");

if(isset($_REQUEST['Update']) && $_REQUEST['Update']=='Update'){
		//print_r($_REQUEST);die;
		
		$Query = "UPDATE `checks` SET `check_date`='".$_REQUEST['check_in_value']."' WHERE check_id='".$_REQUEST['check_in_id']."'";
	   $result4 = mysql_query($Query, $link);
	   if(isset($_REQUEST['check_out_id']) && !empty($_REQUEST['check_out_id'])){
	   $Query1 = "UPDATE `checks` SET `check_date`='".$_REQUEST['check_out_value']."' WHERE check_id='".$_REQUEST['check_out_id']."'";
	   $result12 = mysql_query($Query1, $link);
	   }else{
		    $Query1 = "INSERT INTO `checks` SET `check_date`='".$_REQUEST['check_out_value']."' ,`client_id`='".$_REQUEST['client_id']."',`email`='".$_REQUEST['email']."',`check_status`='out'";
	   $result12 = mysql_query($Query1, $link);
		   
		   }
	   
	   if($result12){
		    echo "<div id=\"successmsg\"> Update Success </div>";
                echo "<script>setTimeout(\"location.href = 'index.php';\",1400);</script>";
		   }
		
		}
	
	
   
    $sql = "select count(distinct email) from checks where check_date between '".date('Y-m-d').' 00:00:00'."'  AND '".date('Y-m-d').' 23:59:59'."'";
    $result = mysql_query($sql, $link);
    
    if($result){
        $total_present = mysql_fetch_row($result);
    }else{
        $total_present[0] = 0;
    }
    
    $sql1 = "select count(id) from users  where is_active = 1";
    $result1 = mysql_query($sql1, $link);
    
    if($result1){
        $total_emp = mysql_fetch_row($result1);
    }else{
        $total_emp[0] = 0;
    }
   // echo  $total_emp[0];
	//echo  $total_present[0];die;
    $total_absent = $total_emp[0] - $total_present[0];
    
    $sql2 = "select count(distinct email) from checks where check_date >= '".date('Y-m-d')."' and check_status = 'in' ";
    //echo $sql; exit;
    $result2 = mysql_query($sql2, $link);
    
    if($result2){
        $total_checkin = mysql_fetch_row($result2);
    }else{
        $total_checkin[0] = 0;
    }
    
    $sql3 = "select count(distinct email) from checks where check_date >= '".date('Y-m-d')."' and check_status = 'out' ";
    //echo $sql; exit;
    $result3 = mysql_query($sql3, $link);
    
    if($result3){
        $total_checkout = mysql_fetch_row($result3);
    }else{
        $total_checkout[0] = 0;
    }
    
    $sql4 = "select CONCAT(u.`first_name`,' ', u.`last_name`) as 'Name', c.email, c.latitude, c.longitude, c.check_status 
             FROM checks c 
             LEFT JOIN users u ON u.username = c.email 
             where c.check_date >= '".date('Y-m-d')."' 
             and c.latitude !='' AND c.longitude !='' 
             GROUP BY c.email 
             ORDER BY c.check_date desc ";
    //echo $sql; exit;
    $result4 = mysql_query($sql4, $link);
    if(isset($_REQUEST['data']) && $_REQUEST['data']=='Present'){
	   $startDate = date('Y-m-d').' 00:00:00';
	   $endDate =  date('Y-m-d').' 23:59:59';
	    $sql5 = "Select name,client_id,username,check_date,checks.check_status,checks.check_id,customers.name, concat(users.`first_name`,' ',users.`last_name`) as employee_name 
        FROM checks 
        LEFT JOIN customers ON checks.client_id = customers.id
        LEFT JOIN users ON checks.email = users.username 
        WHERE client_id != 0 AND checks.check_status='in' AND checks.check_date between '".$startDate."' and '".$endDate."' 
        GROUP BY username,check_date
        ORDER BY check_date DESC";
		$result5 = mysql_query($sql5, $link);
		$data = array();
		$records = array();
		$i=0;
		if (mysql_num_rows($result5) > 0) {
			while ($row = mysql_fetch_assoc($result5)) {
		
		
		if(isset($_REQUEST['data'])){
				$records[$i]['name'] = $row['name'];
				$records[$i]['employee_name'] = $row['employee_name'];
				$records[$i]['check_date'] = $row['check_date'];
				$records[$i]['client_id'] = $row['client_id'];
				$records[$i]['email'] = $row['username'];
				$records[$i]['in'] = date('H:i', strtotime($row['check_date']));
				$records[$i]['check_id'] = $row['check_id'];
				$in = $row['check_date'];
				$CheckOutQ= "select * from checks where client_id='".$row['client_id']."' AND check_date >= '".date('Y-m-d',strtotime($row['check_date']))."' AND   check_status='in'";
				$checkOut1 = mysql_query($CheckOutQ, $link);
				$CheckOut = mysql_fetch_assoc($checkOut1);
						if(!empty($CheckOut)){
								$records[$i]['check_id_out'] = $CheckOut['check_id'];
								$records[$i]['out'] = date('H:i', strtotime($CheckOut['check_date']));
								$datetime1 = strtotime($CheckOut['check_date']);
								$datetime2 = strtotime($in);
								$interval = abs($datetime2 - $datetime1);
								$minutes = round($interval / 60);
								$hr = round($minutes/60);
								$min = round($minutes%60);
								$records[$i]['diff'] = date('H:i', mktime(0, $minutes));
					}
				
			$i++;}
			}
			
			}
	   
	   }else 
	   
 if(isset($_REQUEST['data']) && $_REQUEST['data']=='Absent'){
	    $sql5 = "Select name,client_id,username,check_date,checks.check_status,checks.check_id,customers.name, concat(users.`first_name`,' ',users.`last_name`) as employee_name 
        FROM users 
        LEFT JOIN checks ON users.username  = checks.email
		LEFT JOIN customers ON checks.client_id = customers.id
		GROUP BY users.username";
		//echo $sql5;die;
		$result5 = mysql_query($sql5, $link);
		$data = array();
		$records = array();
		$i=0;
		if (mysql_num_rows($result5) > 0) {
			while ($row = mysql_fetch_assoc($result5)) {
				//print_r($row);
				/*$date1 =  date('Y-m-d');
				$date2 =  date('Y-m-d',strtotime($row['check_date']));
				echo  $date1 .'======>'.$date2 .'<br>';*/
				if(date('Y-m-d')== date('Y-m-d',strtotime($row['check_date']))){
				$records[$i]['name'] = $row['name'];
						$records[$i]['employee_name'] = $row['employee_name'];
						$records[$i]['check_date'] = $row['check_date'];
						$records[$i]['client_id'] = $row['client_id'];
						$records[$i]['email'] = $row['username'];
						$records[$i]['in'] = date('H:i', strtotime($row['check_date']));
						$records[$i]['check_id'] = $row['check_id'];
						
							
					   } else {
						$records[$i]['name'] = $row['name'];
						$records[$i]['employee_name'] = $row['employee_name'];
						$records[$i]['check_date'] = $row['check_date'];
						$records[$i]['client_id'] = $row['client_id'];
						$records[$i]['email'] = $row['username'];
						$records[$i]['in'] = date('H:i', strtotime($row['check_date']));
						$records[$i]['check_id'] = $row['check_id'];
						
						
							
					  $i++; 
						  }
			  }}//die;
			   } 
			  
			  
			  
			  else if(isset($_REQUEST['data']) && $_REQUEST['data']=='checkOut'){
	   
	    $sql5 = "Select name,client_id,username,check_date,checks.check_status,checks.check_id,customers.name, concat(users.`first_name`,' ',users.`last_name`) as employee_name 
        FROM checks 
        LEFT JOIN customers ON checks.client_id = customers.id
        LEFT JOIN users ON checks.email = users.username 
        WHERE client_id != 0 AND checks.check_status='out' AND checks.check_date >= '".date('Y-m-d')."' 
        GROUP BY username,checks.check_date
        ORDER BY check_date DESC";
		$result5 = mysql_query($sql5, $link);
		$data = array();
		$records = array();
		$i=0;
		if (mysql_num_rows($result5) > 0) {
			while ($row = mysql_fetch_assoc($result5)) {
		
		
		if(isset($_REQUEST['data'])){
				$records[$i]['name'] = $row['name'];
				$records[$i]['employee_name'] = $row['employee_name'];
				$records[$i]['check_date'] = $row['check_date'];
				$records[$i]['client_id'] = $row['client_id'];
				$records[$i]['email'] = $row['username'];
				$records[$i]['in'] = date('H:i', strtotime($row['check_date']));
				$records[$i]['check_id'] = $row['check_id'];
				$in = $row['check_date'];
				$CheckOutQ= "select * from checks where client_id='".$row['client_id']."' AND check_date >= '".date('Y-m-d',strtotime($row['check_date']))."' AND   check_status='in'";
				$checkOut1 = mysql_query($CheckOutQ, $link);
				$CheckOut = mysql_fetch_assoc($checkOut1);
						if(!empty($CheckOut)){
								$records[$i]['check_id_out'] = $CheckOut['check_id'];
								$records[$i]['out'] = date('H:i', strtotime($CheckOut['check_date']));
								$datetime1 = strtotime($CheckOut['check_date']);
								$datetime2 = strtotime($in);
								$interval = abs($datetime2 - $datetime1);
								$minutes = round($interval / 60);
								$hr = round($minutes/60);
								$min = round($minutes%60);
								$records[$i]['diff'] = date('H:i', mktime(0, $minutes));
					}
				
			$i++;}}}
	   
	   }
	   
	   else if(isset($_REQUEST['serchByDate']) && $_REQUEST['serchByDate']=='Search'){
		   //print_r($_REQUEST);die;
		   $startDate = $_REQUEST['start_date'];
		   $endDate = $_REQUEST['end_date'].' 23:59:59';
	   
	    $sql5 = "Select name,client_id,username,check_date,checks.check_status,checks.check_id,customers.name, concat(users.`first_name`,' ',users.`last_name`) as employee_name 
        FROM checks 
        LEFT JOIN customers ON checks.client_id = customers.id
        LEFT JOIN users ON checks.email = users.username 
        WHERE client_id != 0 AND checks.check_status='in' AND checks.check_date between '".$startDate."' and '".$endDate."' 
        GROUP BY username,checks.check_date
        ORDER BY check_date DESC";
		$result5 = mysql_query($sql5, $link);
		$data = array();
		$records = array();
		$i=0;
		if (mysql_num_rows($result5) > 0) {
			while ($row = mysql_fetch_assoc($result5)) {
				
				
		if(isset($_REQUEST['data'])){
				$records[$i]['name'] = $row['name'];
				$records[$i]['employee_name'] = $row['employee_name'];
				$records[$i]['check_date'] = $row['check_date'];
				$records[$i]['client_id'] = $row['client_id'];
				$records[$i]['email'] = $row['username'];
				$records[$i]['in'] = date('H:i', strtotime($row['check_date']));
				$records[$i]['check_id'] = $row['check_id'];
				$in = $row['check_date'];
				$CheckOutQ= "select * from checks where client_id='".$row['client_id']."' AND check_date >= '".date('Y-m-d',strtotime($row['check_date']))."' AND   check_status='in'";
				$checkOut1 = mysql_query($CheckOutQ, $link);
				$CheckOut = mysql_fetch_assoc($checkOut1);
						if(!empty($CheckOut)){
								$records[$i]['check_id_out'] = $CheckOut['check_id'];
								$records[$i]['out'] = date('H:i', strtotime($CheckOut['check_date']));
								$datetime1 = strtotime($CheckOut['check_date']);
								$datetime2 = strtotime($in);
								$interval = abs($datetime2 - $datetime1);
								$minutes = round($interval / 60);
								$hr = round($minutes/60);
								$min = round($minutes%60);
								$records[$i]['diff'] = date('H:i', mktime(0, $minutes));
					}
				
			$i++;}}}
	   
	   }
	   else{
    
$sql5 = "Select name,client_id,username,check_date,checks.check_status,checks.check_id,customers.name, concat(users.`first_name`,' ',users.`last_name`) as employee_name 
        FROM checks 
        LEFT JOIN customers ON checks.client_id = customers.id
        LEFT JOIN users ON checks.email = users.username 
        WHERE client_id != 0 And checks.check_status='in'
        GROUP BY username,check_date
        ORDER BY check_date DESC";
	//	echo $sql5;die;
$result5 = mysql_query($sql5, $link);
$data = array();
$records = array();
$i=0;
if (mysql_num_rows($result5) > 0) {
    while ($row = mysql_fetch_assoc($result5)) {
		 $records[$i]['name'] = $row['name'];
            $records[$i]['employee_name'] = $row['employee_name'];
            $records[$i]['check_date'] = $row['check_date'];
            $records[$i]['client_id'] = $row['client_id'];
            $records[$i]['email'] = $row['username'];
            $records[$i]['in'] = date('H:i', strtotime($row['check_date']));
			$records[$i]['check_id'] = $row['check_id'];
            $in = $row['check_date'];
			$CheckOutQ= "select * from checks where client_id='".$row['client_id']."' AND check_date >= '".date('Y-m-d',strtotime($row['check_date']))."' AND   check_status='out'";
			$checkOut1 = mysql_query($CheckOutQ, $link);
			$CheckOut = mysql_fetch_assoc($checkOut1);
			if(!empty($CheckOut)){
			$records[$i]['check_id_out'] = $CheckOut['check_id'];
            $records[$i]['out'] = date('H:i', strtotime($CheckOut['check_date']));
			 $datetime1 = strtotime($CheckOut['check_date']);
             $datetime2 = strtotime($in);
			  $interval = abs($datetime2 - $datetime1);
                $minutes = round($interval / 60);
                $hr = round($minutes/60);
                $min = round($minutes%60);
                $records[$i]['diff'] = date('H:i', mktime(0, $minutes)); 
				
				}
				
				$i++;}

	   }
		
	   }

//echo "<pre>";
//print_r($records);
//die;
?>

<style>
    tfoot {
        display: table-header-group;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
.center-button button{ margin:auto; text-align:center;}


</style>

<!-- page content -->
<div class="right_col" role="main" style="max-height: 1000px">
    <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <a href="index.php?data=Present">
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-present.png"/></div>
                  <div class="count"><?php echo $total_present[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Present</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="index.php?data=Absent">
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-absent.png"/></div>
                  <div class="count"><?php echo $total_absent; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Absent</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-check-in.png"/></div>
                  <div class="count"><?php echo $total_checkin[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Checked In Outside</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
               
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="index.php?data=checkOut"><div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-log-out.png"/></div>
                  <div class="count"><?php echo $total_checkout[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Logged Out</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div> </a>
              </div>
            </div>

              
            
        

<!-- Modal -->

    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Attendance Sheet </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#SearchByDate">Search by Date Range</button>
                    <div id="ReplaceData">
                        <table id="datatable-buttons" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th style="display:none;">Se No.</th>
                                    <th>Employee Name</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Total Time Spent</th>
                                     <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot id="">
                                <tr>
                                    <th  style="display:none;"></th>
                                    <th>Employee Name</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Total Time Spent</th>
                                    <th id="ActionRemove">Action</th>

                                </tr>
                            </tfoot>

                            <tbody>
                                
                                <?php 
								
								//echo "<pre>";
								//print_r($records);exit;
								$j=1;
								for ($i=0; $i < sizeof($records); $i++) { 
								?>
                                    
                                        <tr  <?php if(isset($records[$i]['diff']) && !empty($records[$i]['diff']) && $records[$i]['diff']<8){?>style="background:#F00;" <?php } ?>>
                                         <td  style="display:none;" ><?= $j ;?></td>
                                            <td ><?= $records[$i]['employee_name'] ;?></td>
                                            <td><?= $records[$i]['name'] ?></td>
                                            <td><?php if(isset($records[$i]['check_date'])){echo date('d M Y',strtotime($records[$i]['check_date']));}{
												
												
												
												 }?></td>
                                            <td><?php if(isset($records[$i]['check_date'])){ echo $records[$i]['in']; } ?>
                                            
                                            
                                            
                                            
                                            <!--
                                                <input type="text" class="form-control" onclick="return enable_box('<?php echo "in_time_".$id; ?>');" onblur="return update_field('in_time',<?php echo $id; ?>);"
                                                               name="in_time_<?php echo $id; ?>" value="<?= $data['in'] ?>" readonly="readonly" />-->
                                            </td>
                                            <td><?= (isset($records[$i]['out']) && !empty($records[$i]['out'])) ? $records[$i]['out'] : "Not Checked Out"; ?>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                               <!-- <input type="text" class="form-control" onclick="return enable_box('<?php echo "out_time_".$id; ?>');" onblur="return update_field('out_time',<?php echo $id; ?>);"
                                                               name="out_time_<?php echo $id; ?>" value="<?= (isset($records[$i]['out']) && !empty($records[$i]['out'])) ?$records[$i]['out'] : "Not Checked Out"; ?>" readonly="readonly" />-->
                                            </td>
                                            <td><?=  (isset($records[$i]['diff']) && !empty($records[$i]['diff'])) ? $records[$i]['diff'] : "";  ?></td>
                                       <td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal<?php echo $records[$i]['check_id'];?>">Edit</button></td>
                                        </tr>
                                    <div id="myModal<?php echo $records[$i]['check_id'];?>" class="modal fade" role="dialog">
                                            <?php /*?><div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search By Date Range</h4>
      </div>
      <div class="modal-body">
       <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="first-name" required="required" name="start_date" class="form-control DatePicker" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">End Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="last-name" name="end_date" required="required" class="form-control DatePicker" type="text">
                        </div>
                      </div>
                      
                      
                      
                     
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
                          <button type="submit" name="serchByDate" value="Search" class="btn btn-success">Search</button>
                        </div>
                      </div>

                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div><?php */?>
                                                <div class="modal-dialog">
                                                
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Update Check-In</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                     <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                                                     
                                                     
                                                     
                              
                               
                                    <div class="form-group">
                                    
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Time In  </label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text"  required="required" name="check_in_value" value="" class="form-control timePicker ">
                                      <input type="hidden" name="check_in_id" value="<?php echo $records[$i]['check_id'];?>" />
                                      </div>
                                      </div>
                                      
                                         <div class="clearfix"></div>
                                    <div class="form-group" style="padding-top:10px;" >
                                    
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Time Out  </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text"  required="required" name="check_out_value" value="" class="form-control timePicker ">
                                      <input type="hidden" name="check_out_id" value="<?php echo $records[$i]['check_id_out'];?>" />
                                       <input type="hidden" name="client_id" value="<?php echo $records[$i]['client_id'];?>" />
                                        <input type="hidden" name="email" value="<?php echo $records[$i]['email'];?>" />
                                      </div>
                                       </div>              
                                          <div class="clearfix"></div>
                                        
                      <div class="form-group" style="text-align:center;padding-top:10px;">
                        <div class="">
                         
                          <button type="submit" name="Update" value="Update" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                           
                                                      
                      

                    </form>
                                                   </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                
                                                  </div>
                                                </div>
                                <?php $j++;}  ?>        
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
<!--Google Map-->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Google Map </h2>
                      <!--<div class="pull-right">
                        
                        <small>Last Refreshed on 15-May-2017 at 4:02 pm</small>
                        <button class="btn btn-default btn-refresh" c><i class="glyphicon glyphicon-refresh"></i></button></div>-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="card card-map">
                            <div class="map">
                                <div id="map"></div>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
            
<!--Google Map Ends Here-->


    </div>
</div>
		  
		  
</div>
<!-- /page content -->
 <div id="SearchByDate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search By Date Range</h4>
      </div>
      <div class="modal-body">
       <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="first-name" required="required" name="start_date" class="form-control DatePicker" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">End Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="last-name" name="end_date" required="required" class="form-control DatePicker" type="text">
                        </div>
                      </div>
                      
                      
                      
                     
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
                          <button type="submit" name="serchByDate" value="Search" class="btn btn-success">Search</button>
                        </div>
                      </div>

                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

