 <?php
	$q=$_GET['q'];
	$my_data=$q;
	require("auto_connect.php");
	//$q="select * from applications where disease_serious_illness like '%$my_data%' order by application_id";
	//$res=mysql_query($q,$mysqli) or die(mysql_error()); 
	$sql="SELECT dept_forw_no FROM   pension_receipt_register_master WHERE dept_forw_no LIKE '%$my_data%' ORDER BY slno";
	$result = mysql_query($sql,$mysqli) or die(mysql_error()); 
	 
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['dept_forw_no']."\n";
			//echo "<small>".$row['allergy_description_pop_up_with_title']."</small>";
		}
	}
	
?>
 
 
 
 
