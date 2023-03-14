'use strict';

const getBooks = async () => {

    try
    {
        const f = await fetch(`${BASE_URL}book/get_all`);
        const j = await f.json();

        return j;
    }
    catch(err)
    {

    }
}

(async $ => {

    const table = $('#table-main').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'stock/get_all_paginated'
        },
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'stock_code'
            },
            {
                data: 'book_id',
                visible: false
            },
            {
                data: 'title'
            },
            {
                data: 'rack_no'
            },
            {
                data: 'is_available',
                render(data, type, row, _meta) {
                    switch(data)
                    {
                        case 1:
                            return '<span class="badge badge-success">Tersedia</span>';
                        case 0:
                            return '<span class="badge badge-danger">Tidak Tersedia</span>';
                    }
                }
            },
           
            {
                data: null,
                render(data, type, row, _meta) {
                    var btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 edit_data"><i class="fas fa-edit"></i></button>' + 
                                `<a role="button" class="btn-circle btn-danger rounded-circle border-0 delete_data"><i class="fas fa-trash"></i></a>` + 
                              '</span>';
                    return btn;
                }
            }
        ]
    });

    console.log(crypto);
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