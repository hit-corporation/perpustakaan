'use strict';

const form = document.forms['form-input'];
const formSearch = document.forms['form-search'];

// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/order/get_all');
        const j = await f.json();

        return j;
    }   
    catch(err)
    {
        console.log(err);
    }    
}

// SETTING
const setting = async () => {
	try
	{
		const f = await fetch(BASE_URL + '/setting/get_all');
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
            url: BASE_URL + '/order/get_all_paginated'
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
					const date1 = new Date(row.trans_timestamp);
					const date2 = new Date(row.return_date);
					const diffTime = Math.abs(date2 - date1);
					const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

					return diffDays + ' hari';
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
				//DENDA
				data: 'denda',
				render(data, type, row, _meta) {
					return new Intl.NumberFormat('id', { style: 'currency', currency: 'IDR'}).format(data);
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

	// Update data
	$('#table-main').on('click', '.update_data', function() {
	
		const data = tableMain.row($(this).parents('tr')).data();
		const id = data.id;
		const book_id = data.book_id;
		const member_name = data.member_name;
		const book_title = data.title;
		const return_date = data.return_date;
		const diffDays = Math.floor((Math.abs(new Date(return_date) - new Date())) / (1000 * 60 * 60 * 24));
		let jumlah_hari_terlambat = 0;
		let denda = 0;
		
		// JUMLAH HARI TERLAMBAT
		if (new Date(return_date) >= new Date())
		{
			jumlah_hari_terlambat = 0;
		} 
		else 
		{ 
			jumlah_hari_terlambat = diffDays;
		}

		// DENDA
		if (jumlah_hari_terlambat > 0)
		{
			denda = jumlah_hari_terlambat * 500;
			if (denda > 10000)
			{
				denda = 10000;
			}
		}
		else
		{
			denda = 0;
		}

		// show modal
		$('#modal-update').modal('show');

		// set value
		$('#modal-update input[name="transaction_book_id"]').val(id);
		$('#modal-update input[name="book_id"]').val(book_id);
		$('#modal-update input[name="member_name"]').val(member_name);
		$('#modal-update input[name="book_title"]').val(book_title);
		$('#modal-update input[name="jumlah_hari_terlambat"]').val(jumlah_hari_terlambat);
		$('#modal-update input[name="denda"]').val(denda);
		$('#modal-update input[name="bayar"]').val(denda);

	
	});

})(jQuery);

const loading = () => {
    Swal.fire({
        html: 	'<div class="d-flex flex-column align-items-center">'
        + '<span class="spinner-border text-primary"></span>'
        + '<h3 class="mt-2">Loading...</h3>'
        + '<div>',
        showConfirmButton: false,
        width: '10rem'
    });
}
