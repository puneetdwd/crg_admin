   <?php include "check_session.php"; ?>    
<!-- footer content -->
        <footer>
          <div class="pull-right">
            Designed and Developed by <a href="https://itmindmap.com">IT Mind Map</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!--  Google Maps Plugin   -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCajg2gehjcPV6DEmPRoKOtoXo4y4QOdY0&angular.noop=initMap"></script>

 

<script type="text/javascript">

	/*var locations = [
    ['Gaurav Raheja , Michelin',  'Gurgaon,GN', 'Location 1 URL'],
    ['Mr. X , Dainik Bhaskar', 'Bhopal,BPL', 'Location 2 URL'],
    ['Mr. Y , LG Electronics', 'Pune,PU', 'Location 3 URL']
];*/

var locations = [
    <?php
        while($row_data = mysql_fetch_array($result4))
        { ?>
            ['<?php echo $row_data['email'] ?>',  '<?php echo $row_data['latitude'] ?>', '<?php echo $row_data['longitude'] ?>','<?php echo $row_data['check_status'] ?>'],
       <?php }
    ?>

];

//alert(locations);


var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();


function initialize() {
    map = new google.maps.Map(
    document.getElementById("map"), {
        center: new google.maps.LatLng(20.5937, 78.9629),
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    geocoder = new google.maps.Geocoder();
	
	

    for (i = 0; i < locations.length; i++) {


        geocodeAddress(locations, i);
    }
	
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
    var name = locations[i][0];
    var latitude = locations[i][1];
    var longitude = locations[i][2];
    var check_status = locations[i][3];
    geocoder.geocode({
        'address': locations[i][1]
    },

    function (results, status) {
        /*if (status == google.maps.GeocoderStatus.OK) {*/
            var marker = new google.maps.Marker({
                icon: 'http://maps.google.com/mapfiles/ms/icons/red.png',
                map: map,
                /*position: results[0].geometry.location,*/
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                title: name,
                animation: google.maps.Animation.DROP,
                /*address: address,
                url: url*/
            })
            infoWindow(marker, map, name, latitude, longitude, check_status);
            bounds.extend(marker.getPosition());
            map.fitBounds(bounds);
        /*} else {
            alert("geocode of " + address + " failed:" + status);
        }*/
    });
}

function infoWindow(marker, map, name, latitude, longitude, check_status) {
    google.maps.event.addListener(marker, 'click', function () {
        var html = "<div><h3>" + name + "</h3><p>Status : " + check_status + "<br></p></div>";
        iw = new google.maps.InfoWindow({
            content: html,
            maxWidth: 350
        });
        iw.open(map, marker);
    });
}

function createMarker(results) {
    var marker = new google.maps.Marker({
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
        map: map,
        position: results[0].geometry.location,
        title: title,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url
    })
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
}


</script>
<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#datatable-buttons tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#datatable-buttons').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );

function enable_box(name){
      
      //$(this).removeAttr("readonly");
      $("input[name='"+name+"']").removeAttr("readonly");
      
      return true;
  }
  
  
  function update_field(field, id){
      
    var base_url = $('#base_url').val();
    
    var attendance;
    
    var name = field+'_'+id;
    
    var value = $("input[name='"+name+"']").val();
    
    var in_time = $("input[name='in_time_"+id+"']").val();
    
    var out_time = $("input[name='out_time_"+id+"']").val();
    
    if(in_time != '' && out_time != ''){
        attendance = 'P';
    }else{
        attendance = 'A';
    }
    
    /*alert(value);
    alert(field);
    alert(id);
    alert(name);*/
    
    App.blockUI({
        target: '.'+id,
        boxed: true
    });
    
    $.ajax({
        type: 'POST',
        url: base_url+'attendance/update_punching_data',
        data: { id : id, field_name: field, field_value : value, attendance : attendance},
        dataType: 'json',
        success: function(resp) {
            //alert("Success");
            $("input[name='"+name+"']").attr("readonly", true);
            $(".att_"+id).html(attendance);

            App.unblockUI('.'+id);
        }
    });
      
  }
</script>

  </body>
</html>