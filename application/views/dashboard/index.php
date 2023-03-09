<?php $this->layout('layouts::main_template', ['title' => 'Dashboard'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>

<style>
	.highcharts-credits {
		display: none;
	}
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

	#top-ten-member {
  height: 400px;
}

</style>

<?php $this->stop() ?>


<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<!-- highchart  -->
<script src="./assets/js/dashboard/highcharts/highcharts.js"></script>
<script src="./assets/js/dashboard/highcharts/exporting.js"></script>
<script src="./assets/js/dashboard/highcharts/export-data.js"></script>
<script src="./assets/js/dashboard/highcharts/accessibility.js"></script>

<!-- apex charts -->
<script src="./assets/js/dashboard/apexcharts/apexcharts.js"></script>

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
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
			<div class="container border rounded-lg shadow p-3">

				<figure class="highcharts-figure" style="height: 417px;">
					<div id="container"></div>
					<!-- <p class="highcharts-description">
						Pie charts are very popular for showing a compact overview of a
						composition or comparison. While they can be harder to read than
						column charts, they remain a popular choice for small datasets.
					</p> -->
				</figure>
			</div>
		</div>

		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="container border rounded-lg shadow p-3">
				
				<div id="chartdiv2" style="width: 100%; height: 400px;"></div>
				</div>
		</div>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2 mt-3">
			<div class="container border rounded-lg shadow mx-0">
				<figure class="highcharts-figure">
					<div id="top-ten-member"></div>
				</figure>
			</div>
		</div>

		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
		</div>
	</div>

</div>
<!-- /.container-fluid -->



<?php $this->stop() ?>
















<!-- SECTION JS -->
<?php $this->start('js') ?>

<script src="./assets/js/dashboard/percentageBookBorrow.js"></script>
<script src="./assets/js/dashboard/topBookBorrow.js"></script>
<script>
	percentage_book_borrow(<?= json_encode($percentage_book_borrow) ?>);
	top_book_borrow(<?= json_encode(array_column($top_book_borrow , 'total')) ?>, <?= json_encode(array_column($top_book_borrow , 'title')) ?>);
</script>
















<script>

	// create data for chart
	var dataTopMember = [];
	<?php foreach($top_member_borrow as $key => $value) : ?>
		dataTopMember.push({
			name: '<?= $value['member_name'] ?>',
			y: <?= $value['total'] ?>
		});
	<?php endforeach; ?>


	Highcharts.chart('top-ten-member', {
		chart: {
			type: 'column',
		},
		title: {
			text: '<h6>Top 10 Siswa Meminjam Buku selama 1 bulan terakhir</h6>'
		},
		xAxis: {
			type: 'category',
			labels: {
			rotation: -45,
			style: {
				fontSize: '11px',
				fontFamily: 'Verdana, sans-serif'
			}
			}
		},
		yAxis: {
			min: 0,
			title: {
			text: 'Banyaknya (buku)'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Total: <b>{point.y:.f} Buku</b>'
		},
		series: [{
			name: 'Population',
			// data: [
			// ['Tokyo', 37.33],
			// ['Delhi', 31.18],
			// ['Shanghai', 27.79],
			// ['Sao Paulo', 22.23],
			// ['Mexico City', 21.91],
			// ['Dhaka', 21.74],
			// ['Cairo', 21.32],
			// ['Beijing', 20.89],
			// ['Mumbai', 20.67],
			// ['Osaka', 19.11]
			// ],
			data: dataTopMember,
			dataLabels: {
			enabled: true,
			rotation: 0,
			color: '#FFFFFF',
			align: 'right',
			format: '{point.y:.f}', // one decimal
			y: 25, // 10 pixels down from the top
			style: {
				fontSize: '13px',
				fontFamily: 'Verdana, sans-serif'
			}
			}
		}]
	});

	// set temout for change font
	setTimeout(() => {
		// change font
		let SvgjsText1005 = document.querySelector('#SvgjsText1005');
		SvgjsText1005.style.fontSize = '12px';
		SvgjsText1005.style.fontFamily = '"Poppins",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"'

	}, 500);


</script>














<?php $this->stop() ?>
