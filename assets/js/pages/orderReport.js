'use strict'

const formSearch = document.forms['form-search'];

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
			},
            {
                data: null,
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 update_data"><i class="fas fa-edit"></i></button>' + 
                                '</span>';

					// jika tanggal pengembalian sudah diupdate hide button
					if(row.updated_at != null)
					{
						// add class disabled to button
						return btn.replace('update_data', 'd-none disabled update_data');
					} else {
                    	return btn;
					}
                }
            }
		]
	});

	// Search submit
    formSearch.addEventListener('submit', e => {
        e.preventDefault();
		
        // if(formSearch['s_member_name'].value)
		tableMain.columns(1).search(formSearch['s_member_name'].value).draw();
        
    });

	// Search daterangepicker
	$('input[name="daterange"]').daterangepicker({
		opens: 'left',
	}, function(start, end, label) {
		console.log(tableMain.columns(2).search(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD')));
		tableMain.columns(2).search(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD')).draw();
	});
	
	
})(jQuery);
