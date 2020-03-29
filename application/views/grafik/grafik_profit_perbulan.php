<!DOCTYPE html>
<html>
<head>
    <title>Grafik Profit Bulanan</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>

<?php
if ($report) {
	foreach ($report as $x => $result) {
		$tot_diskon = (float) $result->tot_diskonrp + $diskon[$x]->tot_diskon2;
		$bulan[] = $result->tanggal;
		$value[] = (float) $result->tot_pendapatan - (float) $result->tot_modal - (float) $tot_diskon;
	}
} else {
	$this->load->view('error404');
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
            text: 'Grafik Profit Bulan <?php echo $nama_bulan[$bln] ?> Tahun <?php echo $thn ?>',
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
            categories:  <?php echo json_encode($bulan); ?>,
             endOnTick: true
        },
        exporting: {
            enabled: false
        },
        yAxis: {
            title: {
                text: 'Profit'
            },
            min : 0,
        },
        tooltip: {
             formatter: function() {
                 return 'Total Profit Tanggal <b>' + this.x + '</b> Adalah Rp <b>' + Highcharts.numberFormat(this.y,0,',','.') + '</b>';
             }
          },
        series: [{
            name: 'Tanggal',
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


