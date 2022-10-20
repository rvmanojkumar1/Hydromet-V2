 <?php 

include_once 'database.php';
session_start();
$filename = "graph_csv.csv";
$file = fopen('php://output', 'w');
   
   header('Content-type: application/csv');
   header('Content-Disposition: attachment; filename='.$filename);
 header("Pragma: no-cache");
      header("Expires: 0");
 // fputcsv($file, array("Date/Time","Sensor", "Value" ));  
      fputcsv($file, array("Date/Time", "Value" ));  


$result_s=$_SESSION['result_set3'];
for ($i=0; $i < count($result_s) ; $i++) { 


$result_se=pg_query($result_s[$i]);
//$result_set3=$_SESSION['result_set3'];

if( pg_num_rows($result_se)>0)
{
        while($row=pg_fetch_row($result_se)) {

        fputcsv($file,$row);   

     
      }
  
  }
  }

 //      
 ?>