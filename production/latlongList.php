<?php
 include "check_session.php"; ?>

<?php
    $link = mysql_connect('localhost', 'root', 'Crg@1234');
    if (!$link) {
            die('Could not connect: ' . mysql_error());
    }

    @mysql_select_db('crgv2', $link) or die( "Unable to select database");
   if(isset($_REQUEST['submit']) && $_REQUEST['submit']='Submit'){
	   $Query = "UPDATE `customers` SET `latitude`='".$_REQUEST['latitude']."',`longitude`='".$_REQUEST['longitude']."' WHERE id='".$_REQUEST['id']."'";
	   $result4 = mysql_query($Query, $link);
	   if($result4){
		    echo "<div id=\"successmsg\"> Update Success </div>";
                echo "<script>setTimeout(\"location.href = 'updateLatLong.php';\",1400);</script>";
		   }
	   }
    
  

$sql = "select count(id) from customers where status='active'";
    $result = mysql_query($sql, $link);
    
    if($result){
        $TotalCOustomer = mysql_fetch_row($result);
    }else{
        $TotalCOustomer[0] = 0;
    }
	
$sqlLatLongAviableC = "select count(id) from customers where status='active' AND latitude <> ''  and longitude <> ''";
    $resultLatLongAvilableR = mysql_query($sqlLatLongAviableC, $link);
    
    if($resultLatLongAvilableR){
        $AvilableTotalLatLongCOustomer = mysql_fetch_row($resultLatLongAvilableR);
    }else{
        $AvilableTotalLatLongCOustomer[0] = 0;
    }	
	
$sqlLatLongUnAviableC = "select count(id) from customers where status='active' AND latitude = ''  and longitude = ''";
    $resultLatLongUnAvilableR = mysql_query($sqlLatLongUnAviableC, $link);
    
    if($resultLatLongUnAvilableR){
        $UnAvilableTotalLatLongCOustomer = mysql_fetch_row($resultLatLongUnAvilableR);
    }else{
        $UnAvilableTotalLatLongCOustomer[0] = 0;
    }		
	
	if(isset($_REQUEST['data'])){
		if($_REQUEST['data']=='Available'){
			$condation = "status='active' AND latitude <> ''  and longitude <> ''";
			}if($_REQUEST['data']=='UnAvailable'){
		$condation = "status='active'  AND latitude = ''  and longitude = ''";
			}
		}else{
			
			$condation = "status='active' ";
			}
	
	
	$sqlTotal = "Select * from customers where " .$condation;
    $result4 = mysql_query($sqlTotal, $link);

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
</style>

<!-- page content -->
<div class="right_col" role="main" style="max-height: 1000px">
    <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-present.png"/></div>
                  <div class="count"><?php echo $TotalCOustomer[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Total Lat & Long</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <a href="updateLatLong.php?data=Available">
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-check-in.png"/></div>
                  <div class="count"><?php echo $AvilableTotalLatLongCOustomer[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Available Lat & Long</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <a href="updateLatLong.php?data=UnAvailable">
                <div class="tile-stats">
                  <div class="icon"><img  class="img-responsive" src="images/emp-absent.png"/></div>
                  <div class="count"><?php echo $UnAvilableTotalLatLongCOustomer[0]; ?></div>
                  <!--<h3>Employees</h3>-->
                  <h4>Un Available Lat & Long</h4>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
                </a>
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Lat Long Customer<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                  <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='Edit'){
					  
						$sql4 = "Select * from customers where status='active' and id='".$_REQUEST['edit_id']."' ";
						//echo $sql; exit;
						$result4 = mysql_query($sql4, $link);
						$row = mysql_fetch_assoc($result4);
						print_r($row);?>
					  <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitude">Latitude <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  required="required" name="latitude" value="<?php echo $row['latitude']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <input type="hidden" name="id" value="<?php echo $row['id']?>" />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitude">Longitude <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="longitude" required="required" value="<?php echo $row['longitude']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
                          <button type="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
					<?php   }else{?>

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                           
                            <th class="column-title">Customer Name </th>
                            <th class="column-title">Latitude</th>
                            <th class="column-title">Longitude </th>
                            <th class="column-title">Bill to Name </th>
                           
                          </tr>
                        </thead>

                        <tbody>
                        <?php   if (mysql_num_rows($result4) > 0) {
                              while ($row = mysql_fetch_assoc($result4)) {?>
                          <tr class="even pointer">
                            <td class=" "><?php echo $row['name']?></td>
                            <td class=" "><?php echo $row['latitude']?> </td>
                            <td class=" "><?php echo $row['longitude']?></td>
                            <td class=" "><a class="btn btn-info btn-sm" href="updateLatLong.php?action=Edit&edit_id=<?php echo $row['id']?>">Edit</a></td>
                           
                          </tr>
                          <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                    <?php } ?>
							
						
                  </div>
                </div>
              </div>
                    </div>
                </div>
            </div>
        </div>  
<!--Google Map-->
            
            
<!--Google Map Ends Here-->


    </div>
</div>
		  
		  
</div>
<!-- /page content -->
