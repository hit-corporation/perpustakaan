<?php $this->layout('layouts::main_template', ['title' => 'Dashboard'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>

<style>
	.highcharts-figure,
	.highcharts-data-table table {
	min-width: 320px;
	max-width: 800px;
	margin: 1em auto;
	}

	.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #ebebeb;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
	}

	.highcharts-data-table caption {
	padding: 1em 0;
	font-size: 1.2em;
	color: #555;
	}

	.highcharts-data-table th {
	font-weight: 600;
	padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
	padding: 0.5em;
	}

	.highcharts-data-table thead tr,
	.highcharts-data-table tr:nth-child(even) {
	background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
	background: #f1f7ff;
	}

	input[type="number"] {
	min-width: 50px;
	}
</style>

<?php $this->stop() ?>


<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<!-- highchart  -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- apex charts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Begin Page Content -->

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Total Member (All) -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Member</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_member?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Buku (All) -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Total Buku</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_book?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-book fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Buku Dipinjam (All) -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Buku Dipinjam
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$total_borrow_book?></div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Telat (All) -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Telat Pengembalian</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$late_borrow?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-comments fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-6">
			<div class="container border rounded-lg shadow p-3">

				<figure class="highcharts-figure" style="height: 473px;">
					<div id="container"></div>
					<!-- <p class="highcharts-description">
						Pie charts are very popular for showing a compact overview of a
						composition or comparison. While they can be harder to read than
						column charts, they remain a popular choice for small datasets.
					</p> -->
				</figure>
			</div>
		</div>

		<div class="col-6">
			<div class="container border rounded-lg shadow p-3">
				
				<div id="chartdiv2" style="width: 100%; height: 500px;"></div>
				</div>
		</div>
	</div>


</div>
<!-- /.container-fluid -->



<?php $this->stop() ?>
















<!-- SECTION JS -->
<?php $this->start('js') ?>


<script>
	// Data retrieved from https://netmarketshare.com
	Highcharts.chart('container', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Persentase Siswa Meminjam Buku',
			align: 'left'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
			valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				format: '<b>{point.name}</b>: {point.percentage:.1f} %'
			}
			}
		},
		series: [{
			name: 'Siswa',
			colorByPoint: true,
			data: [
				{
				name: 'Pernah Meminjam | <?=$percentage_book_borrow['has_borrow']?> ',
				y: <?=$percentage_book_borrow['has_borrow']?>,
				}, {
				name: 'Belum Pernah Meminjam | <?=$percentage_book_borrow['never_borrow']?> ',
				y: <?=$percentage_book_borrow['never_borrow']?>
				}
			]
		}]
	});
</script>




















<script>
var options = {
		series: [{
			// data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
			data: <?= json_encode(array_column($top_book_borrow , 'total')) ?>,
		}],
		chart: {
			type: 'bar',
			height: 430
		},
		plotOptions: {
			bar: {
				barHeight: '100%',
				distributed: true,
				horizontal: true,
				dataLabels: {
					position: 'bottom'
				},
			}
		},
		colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e', '#f48024', '#69d2e7'],
		dataLabels: {
			enabled: true,
			textAnchor: 'start',
			style: {
				colors: ['#fff']
			},
			formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
			},
			offsetX: 0,
			dropShadow: {
				enabled: true
			}
		},
		stroke: {
			width: 1,
			colors: ['#fff']
		},
		xaxis: {
			// categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'India'],
			categories: <?= json_encode(array_column($top_book_borrow , 'title')) ?>,
		},
		yaxis: {
			labels: {
				show: false
			}
		},
		title: {
			text: 'TOP 5 BUKU TERBANYAK DIPINJAM',
			align: 'center',
			floating: true
		},
		subtitle: {
			text: 'Nama buku terdapat di dalam grafik',
			align: 'center',
		},
		tooltip: {
			theme: 'dark',
			x: {
				show: false
			},
			y: {
				title: {
					formatter: function () {
						return '';
					}
				}
			}
		}
};

var chart = new ApexCharts(document.querySelector("#chartdiv2"), options);
chart.render();
</script>

















<?php $this->stop() ?>
