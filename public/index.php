<?php
$environment = array_merge($_SERVER, $_ENV);
$cutoff = $_GET['cutoff'] ? $_GET['cutoff'] : "1 week ago";
$testedService = $environment['TESTED_SERVICE_LABEL'];
?>
<html>
<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the piechart package.
        google.charts.load('current', {'packages':['line', 'corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var jsonData = $.ajax({
                url: "data.php?cutoff=<?=urlencode($cutoff);?>",
                dataType: "json",
                async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);

            var options = {
                chart: {
                    title: '<?=$testedService;?>',
                },
                series: {
                    0: { axis: "Bandwidth" },
                    1: { axis: "Bandwidth" },
                    2: { axis: "Latency" }
                },
                axes: {
                    y: {
                        Bandwidth: {label: 'Bandwidth (Mbps)'},
                        Latency: {label: 'Latency (ms)'}
                    }
                }
            };

            var chart = new google.charts.Line(document.getElementById('chart_div'));

            chart.draw(data, options);

        }

    </script>
</head>

<body>
<div id="chart_div" style="width: 100%; height: 100%"></div>
</body>
</html>