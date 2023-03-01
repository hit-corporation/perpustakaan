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
					const date1 = new Date(row.return_date);
					const date2 = new Date();
					
					// JIKA TANGGAL SEKARANG LEBIH BESAR DARI TANGGAL PENGEMBALIAN DAN TANGGAL PENGEMBALIAN BELUM DIUPDATE
					if(date2 > date1 && row.updated_at == null)
					{
						// TANGGAL SEKARANG - TANGGAL PENGEMBALIAN = JUMLAH HARI TERLAMBAT
						const diffTime = Math.abs(date2 - date1);
						const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

						return diffDays + ' hari';
					}
					// JIKA TANGGAL SEKARANG LEBIH BESAR DARI TANGGAL PENGEMBALIAN DAN TANGGAL PENGEMBALIAN SUDAH DIUPDATE 
					else if(date2 > date1 && row.updated_at != null) {
						const date3 = new Date(row.updated_at);

						// TANGGAL PENGEMBALIAN YANG DIUPDATE - TANGGAL PENGEMBALIAN = JUMLAH HARI TERLAMBAT
						const diffTime = Math.abs(date3 - date1);
						const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

						return diffDays + ' hari';
					} else {
						return '0 hari';
					}

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
						const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

						return 'Rp. ' + (diffDays * 500).toLocaleString('id-ID');
					} else if (date2 > date1 && row.updated_at != null) {
						const date3 = new Date(row.updated_at);
						const diffTime = Math.abs(date3 - date1);
						const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

						return 'Rp. ' + (diffDays * 500).toLocaleString('id-ID');

					} else {
						return 'Rp. 0';
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
                data: null,
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 edit_data"><i class="fas fa-edit"></i></button>' + 
                                '</span>';

                    return btn;
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
