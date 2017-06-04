<?php include "check_session.php"; ?>

<?php
    $link = mysql_connect('localhost', 'root', 'Crg@1234');
    if (!$link) {
            die('Could not connect: ' . mysql_error());
    }

    @mysql_select_db('crgv2', $link) or die( "Unable to select database");

   if(isset($_REQUEST['submit'])){
		//print_r($_REQUEST);die;
		//echo "UPDATE `checks` SET `check_date`='".$_REQUEST['check_date']."' WHERE check_id='".$_REQUEST['id']."'";die;
		$Query = "UPDATE `checks` SET `check_date`='".$_REQUEST['check_in']."' WHERE check_id='".$_REQUEST['check_in_id']."'";
	   $result4 = mysql_query($Query, $link);
	   
	   $Query1 = "UPDATE `checks` SET `check_date`='".$_REQUEST['check_out']."' WHERE check_id='".$_REQUEST['check_out_id']."'";
	   $result12 = mysql_query($Query1, $link);
	   
	   if($result12){
		    echo "<div id=\"successmsg\"> Update Success </div>";
                echo "<script>setTimeout(\"location.href = 'index.php';\",1400);</script>";
		   }
		
		//print_r($_REQUEST);	die;
		}
	
	

    $sql = "select count(distinct email) from checks where check_date >= '".date('Y-m-d')."' ";
    $result = mysql_query($sql, $link);
    if($result){
        $total_present = mysql_fetch_row($result);
    }else{
        $total_present[0] = 0;
    }
    
    $sql1 = "select count(id) from employees where status = 'active'";
    $result1 = mysql_query($sql1, $link);
    
    if($result1){
        $total_emp = mysql_fetch_row($result1);
    }else{
        $total_emp[0] = 0;
    }
    
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
   
$sql5 = "Select name,client_id,username,check_date,checks.check_status,checks.check_id,customers.name, concat(users.`first_name`,' ',users.`last_name`) as employee_name 
        FROM checks 
        LEFT JOIN customers ON checks.client_id = customers.id
        LEFT JOIN users ON checks.email = users.username 
        
        GROUP BY username,check_date
        ORDER BY username DESC";
		

$result5 = mysql_query($sql5, $link);

//echo "hi <pre>"; print_r(mysql_fetch_array($result5)); exit;

$data = array();
$records = array();
$i=0;
//echo "<pre>";
if (mysql_num_rows($result5) > 0) {
    while ($row = mysql_fetch_assoc($result5)) {
        
        //echo "<pre>"; print_r($row); exit;
        
		
		if ($row['check_status'] == 'out') {
            
            $records[$i]['name'] = $row['name'];
            $records[$i]['employee_name'] = $row['employee_name'];
            $records[$i]['check_date'] = $row['check_date'];
            $records[$i]['client_id'] = $row['client_id'];
            $records[$i]['email'] = $row['username'];
		
            //$mail_arr[] = $row['username'].'~'.date('Y-m-d', strtotime($row['check_date']));
            $records[$i]['check_id_out'] = $row['check_id'];
            $records[$i]['out'] = date('H:i', strtotime($row['check_date']));
            $in = $row['check_date'];
            $email = $row['username'];
            $client_id = $row['client_id'];
            $i++;
        }else{
           //if((date('Y-m-d', strtotime($row['check_date'])) == date('Y-m-d', strtotime($in)) ) && ($client_id == $row['client_id']) && ($email == $row['username']) ){
            if((date('Y-m-d', strtotime($row['check_date'])) == date('Y-m-d', strtotime($in)) ) && ($email == $row['username']) ){
                $records[$i-1]['in'] = date('H:i', strtotime($row['check_date']));
                $datetime1 = strtotime($row['check_date']);
                $datetime2 = strtotime($in);
                
                	$records[$i-1]['check_id'] = $row['check_id'];
                
                $interval = abs($datetime2 - $datetime1);
                $minutes = round($interval / 60);
                $hr = round($minutes/60);
                $min = round($minutes%60);
                $records[$i-1]['diff'] = date('H:i', mktime(0, $minutes));
                //$records[$i-1]['diff'] = $hr.":".$min;
           }
            
        }
		
    }
}

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
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-present.png"/></div>
                  <div class="count"><?php echo $total_present[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Present</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-absent.png"/></div>
                  <div class="count"><?php echo $total_absent; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Absent</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
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
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-log-out.png"/></div>
                  <div class="count"><?php echo $total_checkout[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Logged Out</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
              </div>
            </div>

        
    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Attendance Sheet </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <!--
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                              </ul>
                            </li>
                            -->
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <!--<p class="text-muted font-13 m-b-30">
                        The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                      </p>-->
                        <table id="datatable-buttons" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Total Time Spent</th>
                                     <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Total Time Spent</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>

                            <tbody>
                                <?php /* foreach ($records as $record) : ?>
                                    <?php foreach ($record as $key => $data) : ?>
                                        <tr>
                                            <td><?= $data['employee_name'] ?></td>
                                            <td><?= $data['name'] ?></td>
                                            <td><?= date('d M Y',strtotime($data['check_date'])) ?></td>
                                            <td><?= $data['in'] ?>
                                                <!--<input type="text" class="form-control" onclick="return enable_box('<?php echo "in_time_".$id; ?>');" onblur="return update_field('in_time',<?php echo $id; ?>);"
                                                               name="in_time_<?php echo $id; ?>" value="<?= $data['in'] ?>" readonly="readonly" />-->
                                            </td>
                                            <td><?= (isset($data['out']) && !empty($data['out'])) ? $data['out'] : "Not Checked Out"; ?>
                                                <!--<input type="text" class="form-control" onclick="return enable_box('<?php echo "out_time_".$id; ?>');" onblur="return update_field('out_time',<?php echo $id; ?>);"
                                                               name="out_time_<?php echo $id; ?>" value="<?= (isset($data['out']) && !empty($data['out'])) ? $data['out'] : "Not Checked Out"; ?>" readonly="readonly" />-->
                                            </td>
                                            <td><?= (isset($data['diff']) && !empty($data['diff'])) ? $data['diff'] : ""; ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; */ ?>
                                <?php 
								
								/*echo "<pre>";
								print_r($records);exit;*/
								for ($i=0; $i < sizeof($records); $i++) { ?>
                                    
                                        <tr>
                                            <td><?= $records[$i]['employee_name'] ;?></td>
                                            <td><?= $records[$i]['name'] ?></td>
                                            <td><?= date('d M Y',strtotime($records[$i]['check_date'])) ?></td>
                                            <td><?= $records[$i]['in']  ?>
                                            
                                            
                                            <div id="myModal<?php echo $records[$i]['check_id'];?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Update Check-In</h4>
                                                      </div>
                                                     <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                                                     
                                                     
                                                     <div class="row" style="text-align:center; margin:10px;">
                              
                               <div class="col-md-12">
                                    <div class="form-group" style="text-align:center; margin:10px;">
                                    
                                     <label class="control-label"  for="latitude">Time In  </label>
                                     <input type="text"  required="required" name="check_in" value="" class="form-control timePicker ">
                                      <input type="hidden" name="check_in_id" value="<?php echo $records[$i]['check_id'];?>" />
                                      </div>
                                      </div>
                                      
                                       
                               <div class="col-md-12">
                                    <div class="form-group" style="text-align:center; margin:10px;">
                                    
                                     <label class="control-label" for="latitude">Time Out  </label>
                                     <input type="text"  required="required" name="check_in" value="" class="form-control timePicker ">
                                      <input type="hidden" name="check_in_id" value="<?php echo $records[$i]['check_id'];?>" />
                                      </div>
                                      </div>
                                                     
                             </div>                        
                                          <div class="row" style="text-align:center; padding-bottom:10px;">
                      <div class="form-group">
                        <div class="">
                         
                          <button type="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                      </div>           
                                                      
                      

                    </form>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                
                                                  </div>
                                                </div>
                                            
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
                                    
                                <?php } ?>        
                            </tbody>
                        </table>
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
  