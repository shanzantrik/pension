<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		<script type="text/javascript">
            $(function () {    

    // Create the chart
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Basic drilldown'
            },
            xAxis: {
                type: 'category'
            },

            legend: {
                enabled: false
            },

            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                    }
                }
            },
/*{
                    name: 'Animals',
                    y: 5,
                    drilldown: 'animals'
                }, 
                {
                    name: 'Fruits',
                    y: 2,
                    drilldown: 'fruits'
                }, 
                {
                    name: 'Cars',
                    y: 4,
                    drilldown: 'cars'
                }*/
            series: [
                {
                name: 'Year',
                colorByPoint: true,
                data: [
                    <?php 
                    $res=mysql_query("SELECT DISTINCT (class_of_pension) FROM pensioner_personal_details");
                    while($row=mysql_fetch_array($res)){
                        $name=$row['class_of_pension'];
                        $sql="SELECT count(*) as cnt FROM `pensioner_personal_details` WHERE class_of_pension='$name'";
                        $res2=mysql_query($sql);
                        $row2=mysql_fetch_array($res2);
                        $val=$row2['cnt'];
                        echo "{";
                        echo 'name: '."'".$name."',";
                        echo 'y:'.$val.',';
                        echo 'drilldown: '."'".$name."'";
                        echo "}, ";
                    }
                 ?>
                ]
            }],
            drilldown: {
                series: [
                       /* {
                        id: 'Voluntary_Retirement_Pension',
                            data: [
                                ['Cats', 4],
                                ['Dogs', 2],
                                ['Cows', 1],
                                ['Sheep', 2],
                                ['Pigs', 1]
                            ]
                        }*/
                        <?php 
                            $rx=mysql_query("SELECT DISTINCT class_of_pension from pensioner_personal_details");
                            while($rtx=mysql_fetch_array($rx)){
                                 $result=mysql_query("SELECT distinct YEAR(STR_TO_DATE(cash_received, "%Y-%m-%d")) as year from pensioner_personal_details");
                                while($row=mysql_fetch_array($result)){
                                    $year=$row['year'];
                                    
                                }
                            }

                        
                         ?>
                    ]
            }
        })
    });
    


		</script>
	</head>
	<body>
<script src="<?php echo base_url();?>includes/high_chart/js/highcharts.js"></script>
<script src="<?php echo base_url();?>includes/high_chart/js/modules/data.js"></script>
<script src="<?php echo base_url();?>includes/high_chart/js/modules/drilldown.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->


	</body>
</html>
