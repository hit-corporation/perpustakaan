// Data retrieved from https://netmarketshare.com
const percentage_book_borrow = (percentage_book_borrow) => {
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
				name: 'Pernah Meminjam | ' + percentage_book_borrow['has_borrow'],
				y: percentage_book_borrow['has_borrow'],
				}, {
				name: 'Belum Pernah Meminjam | ' + percentage_book_borrow['never_borrow'],
				y: percentage_book_borrow['never_borrow']
				}
			]
		}]
	});
}
