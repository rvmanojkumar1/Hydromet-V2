 <?php 

include_once 'database.php';
session_start();
$filename = "graph_csv.csv";
$file = fopen('php://output', 'w');
   
   header('Content-type: application/csv');
   header('Content-Disposition: attachment; filename='.$filename);
 header("Pragma: no-cache");
      header("Expires: 0");

$header=$_SESSION["header"];



$header=str_replace('"', '', $header);
 fputcsv($file,array($header));   
$temp=$_SESSION['query'];




$result_se=pg_query($temp);


if( pg_num_rows($result_se)>0)
{
       while($row=pg_fetch_row($result_se)) {

        fputcsv($file,$row);   

     
     }
     
  }
  

       
 ?>