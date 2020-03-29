<!DOCTYPE html>
<html>
<head>
    <title>Grafik Penjualan Pertahun</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
foreach ($report as $result) {
	$bulan[] = $result->bulan;
	$value[] = (float) $result->total;
}

?>

<div id="report"></div>

<script src="<?php echo base_url() . 'assets/js/grafik/jquery.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/grafik/highcharts.js' ?>"></script>
<script type="text/javascript">
$(function () {
    $('#report').highcharts({
        chart: {
            type: 'line',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik Penjualan Tahun <?php echo $thn ?>',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: '',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($bulan); ?>
        },
        exporting: {
            enabled: false
        },
        yAxis: {
            title: {
                text: 'Penjualan'
            },
            min : 0,
        },
        tooltip: {
             formatter: function() {
                 return 'Total Penjualan Bulan <b>' + this.x + '</b> Adalah Rp <b>' + Highcharts.numberFormat(this.y,0,',','.') + '</b>';
             }
          },
        series: [{
            name: 'Bulan',
            data: <?php echo json_encode($value); ?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#FF0000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0,',','.');
                },
                y: 0,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
</body>
</html>


