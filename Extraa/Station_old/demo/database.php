<?php
ini_set('max_execution_time', 300); 
    $con = pg_connect("host='localhost' port='5433'  dbname='Hydromet' user='postgres' password='pass@123'");
                         date_default_timezone_set('America/Los_Angeles'); 
                         // date_default_timezone_set('Asia/Kolkata');
error_reporting(0);


?>