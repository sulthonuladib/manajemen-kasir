<!DOCTYPE html>
<html>
<head>
    <title>Grafik Porsi Bahan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png"/>
</head>
<body>

<?php
foreach ($report as $result) {
	$nama[] = substr($result->nm_barang, 0, 15);
	$value[] = (float) $result->stok;
}
?>

<div id="report"></div>

<script src="<?php echo base_url() . 'assets/js/grafik/jquery.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/grafik/highcharts.js' ?>"></script>
<script type="text/javascript">
$(function () {
    $('#report').highcharts({
        chart: {
            type: 'column',
            height: 640,
            spacingBottom: 1,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik Porsi Bahan',
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
            categories:  <?php echo json_encode($nama); ?>
        },
        exporting: {
            enabled: false
        },
        yAxis: {
            title: {
                text: 'Total Porsi'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'Total Stok <b>' + this.x + '</b> Adalah <b>' + Highcharts.numberFormat(this.y,0) + '</b> Porsi ';
             }
          },
        series: [{
            name: 'Porsi Bahan',
            data: <?php echo json_encode($value); ?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                useHTML: true,
                color: '#FF0000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                },
                y: 0,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
</body>
</html>