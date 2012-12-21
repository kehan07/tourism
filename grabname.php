<?php 

require_once("init.php"); 
$sql1="SELECT * FROM data";

$results = mysql_query($sql1);
     while($row = mysql_fetch_array($results))
{
echo (" ".$row['id']." \"".$row['name']."\",<br>");
}
?>

sdsd