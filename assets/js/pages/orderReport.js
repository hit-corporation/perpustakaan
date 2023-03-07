'use strict'

const formSearch = document.forms['form-search'];
const formSearchName = document.forms['form-search-name'];

// get all data
const getAll = async () => {
	try
	{
		const f = await fetch(BASE_URL + '/report/get_all');
		const j = await f.json();

		return j;
	}
	catch(err)
	{
		console.log(err);
	}
}

// INIT
(async ($) => {
	const allData = await getAll();

	// Datatable
	const tableMain = $('#table-main').DataTable({
		serverSide: true,
		processing: true,
		ajax: {
			url: BASE_URL + '/report/get_all_paginated'
		},
		pageLength: 10,
		columns: [
			{
                data: 'id',
                visible: false
            },
            {
                data: 'book_id',
                visible: false
            },
            {
                data: 'member_name',
                className: 'align-middle pl-2'
            },
			{
                data: 'title',
            },
            {
                data: 'trans_timestamp',
				render(data, type, row, _meta)
				{
					const date = new Date(data);
					const dateStr = date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });

					return dateStr;
				}
            },
			{
				// JUMLAH HARI PINJAM
				data: 'jumlah_hari_pinjam',
				render(data, type, row, _meta)
				{
					return data.replace('days', 'hari').replace('day', 'hari').replace('00:00:00', '0');
				}

				
			},
            {
                data: 'return_date',
				render(data, type, row, _meta)
				{
					const date = new Date(data);
					const dateStr = date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });

					return dateStr;
				}
            },
            {
				// JUMLAH HARI TERLAMBAT
				data: 'jumlah_hari_terlambat',
				render(data, type, row, _meta)
				{ 
					var results = null;
					if(data)
					{
						results = data.replace('days', 'hari').replace('day', 'hari');
						results = results.replace('mons', 'bulan').replace('mon', 'bulan');
						results = results.replace('years', 'tahun').replace('year', 'tahun');
					}
					
					return results;
				}

            },
			{
				// DENDA
				data: 'denda',
				render(data, type, row, _meta)
				{
					const date1 = new Date(row.return_date);
					const date2 = new Date();
					
					if(date2 > date1 && row.updated_at == null)
					{
						const diffTime = Math.abs(date2 - date1);
						const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
						const denda = diffDays * 500;

						if(denda > 10000){
							return 'Rp. 10.000';
						} else {
							return 'Rp. ' + denda.toLocaleString('id-ID');
						}

					} else if (date2 > date1 && row.updated_at != null) {
						const date3 = new Date(row.updated_at);
						const diffTime = Math.abs(date3 - date1);
						const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
						const denda = diffDays * 500;

						if(denda > 10000){
							return 'Rp. 10.000';
						} else {
							return 'Rp. ' + denda.toLocaleString('id-ID');
						}

					} else {
						return 'Rp. 0';
					}

				}
			},
			{
				// paid amount
				data: 'amount_paid',
				render(data, type, row, _meta)
				{
					if (data == null) {
						return 'Rp. 0';
					} else {
						return 'Rp. ' + data.toLocaleString('id-ID');
					}
				}
			},
			{
				// tanggal pengembalian
				data: 'updated_at',
				render(data, type, row, _meta)
				{
					if(data != null)
					{
						const date = new Date(data);
						const dateStr = date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });
						const timeStr = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
						const dateTimeStr = dateStr + ' ' + timeStr;

						return dateTimeStr;
					} else {
						return '-';
					}
				}

			},
			{
				// note
				data: 'note',
				render(data, type, row, _meta)
				{
					if(data != null || data != '')
					{
						return data;
					} else {
						return '-';
					}
				}
			}
		]
	});

	// Search submit
    formSearchName.addEventListener('submit', e => {
        e.preventDefault();
		
		// Get daterange value
        let daterange 		= formSearch['daterange'].value;
		let daterangeArr 	= daterange.split(' - ');
		let daterangeStart 	= daterangeArr[0];
		let daterangeEnd	= daterangeArr[1];
		
		// Create a date object from a date string
		let start 	= new Date(daterangeStart);
		let end 	= new Date(daterangeEnd);

		// Get year, month, and day part from the date
		let startYear 	= start.toLocaleString("default", { year: "numeric" });
		let startMonth 	= start.toLocaleString("default", { month: "2-digit" });
		let startDay 	= start.toLocaleString("default", { day: "2-digit" });

		let endYear 	= end.toLocaleString("default", { year: "numeric" });
		let endMonth 	= end.toLocaleString("default", { month: "2-digit" });
		let endDay 		= end.toLocaleString("default", { day: "2-digit" });

		// Generate yyyy-mm-dd date string
		start 	= startYear + '-' + startMonth + '-' + startDay;
		end 	= endYear + '-' + endMonth + '-' + endDay;

		// search by daterange
		tableMain.columns(1).search(formSearchName['s_member_name'].value).draw();
		tableMain.columns(2).search(start + ' - ' + end).draw();
		tableMain.columns(3).search(formSearchName['status'].value).draw();
		
    });

	// Search daterangepicker
	$('input[name="daterange"]').daterangepicker({
		opens: 'left',
	}, function(start, end, label) {
		tableMain.columns(1).search(formSearchName['s_member_name'].value).draw();
		tableMain.columns(2).search(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD')).draw();
		tableMain.columns(3).search(formSearchName['status'].value).draw();
	});
	
	
})(jQuery);
