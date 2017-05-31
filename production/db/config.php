
<?php
$connection = mysqli_connect('localhost', 'root','','new_crg');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>
