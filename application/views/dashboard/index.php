<?php $this->layout('layouts::main_template', ['title' => 'Dashboard'])?>







<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>


<script src="//cdn.amcharts.com/lib/5/index.js"></script>
<script src="//cdn.amcharts.com/lib/5/xy.js"></script>
<script src="//cdn.amcharts.com/lib/5/themes/Animated.js"></script>


<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
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

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Total Buku</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_buku?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-book fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Buku Dipinjam
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">75</div>
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

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Pending Requests</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
				<div id="chartdiv" style="width: 100%; height: 500px;"></div>
			</div>
		</div>

		<div class="col-6">
			<div class="container border rounded-lg shadow p-3">
				<div id="chartdiv" style="width: 100%; height: 500px;"></div>
			</div>
		</div>
	</div>


</div>
<!-- /.container-fluid -->



<?php $this->stop() ?>
















<!-- SECTION JS -->
<?php $this->start('js') ?>

<script>
	/**
 * ---------------------------------------
 * This demo was created using amCharts 5.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v5/
 * ---------------------------------------
 */

// Create root and chart
var root = am5.Root.new("chartdiv"); 

root.setThemes([
  am5themes_Animated.new(root)
]);

var chart = root.container.children.push( 
  am5xy.XYChart.new(root, {
    panY: false,
    wheelY: "zoomX",
    layout: root.verticalLayout,
    maxTooltipDistance: 0
  }) 
);

// Define data
var data = [{
  date: new Date(2021, 0, 1).getTime(),
  value: 1,
  value2: 2.5
}, {
  date: new Date(2021, 0, 2).getTime(),
  value: 3,
  value2: 2.1
}, {
  date: new Date(2021, 0, 3).getTime(),
  value: 2,
  value2: 3
}, {
  date: new Date(2021, 0, 4).getTime(),
  value: 1,
  value2: 2
}, {
  date: new Date(2021, 0, 5).getTime(),
  value: 1.5,
  value2: 0.5
}];

// Create Y-axis
var yAxis = chart.yAxes.push(
  am5xy.ValueAxis.new(root, {
    extraTooltipPrecision: 1,
    renderer: am5xy.AxisRendererY.new(root, {})
  })
);

// Create X-Axis
var xAxis = chart.xAxes.push(
  am5xy.DateAxis.new(root, {
    baseInterval: { timeUnit: "day", count: 1 },
    renderer: am5xy.AxisRendererX.new(root, {
      minGridDistance: 20
    }),
  })
);

// Create series
function createSeries(name, field) {
  var series = chart.series.push( 
    am5xy.SmoothedXLineSeries.new(root, { 
      name: name,
      xAxis: xAxis, 
      yAxis: yAxis, 
      valueYField: field, 
      valueXField: "date",
      tooltip: am5.Tooltip.new(root, {})
    }) 
  );
  
  series.strokes.template.set("strokeWidth", 2);
  
  series.get("tooltip").label.set("text", "[bold]{name}[/]\n{valueX.formatDate()}: {valueY}")
  series.data.setAll(data);
}

createSeries("Series #1", "value");
createSeries("Series #2", "value2");

// Add cursor
chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "zoomXY",
  xAxis: xAxis
}));

xAxis.set("tooltip", am5.Tooltip.new(root, {
  themeTags: ["axis"]
}));

yAxis.set("tooltip", am5.Tooltip.new(root, {
  themeTags: ["axis"]
}));
</script>

<?php $this->stop() ?>
