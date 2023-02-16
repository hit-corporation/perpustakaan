'use strict';

const form = document.forms['form-input'];

// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/member/get_all');
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
            url: BASE_URL + '/member/get_all_paginated'
        },
        pageLength: 7,
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
                data: 'no_induk'
            },
            {
                data: 'email'
            },
            {
                data: 'address'
            },
            {
                data: 'phone'
            },
            {
                data: null,
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 edit_data"><i class="fas fa-edit"></i></button>' + 
                                '<button role="button" class="btn-circle btn-danger rounded-circle border-0 delete_data"><i class="fas fa-trash"></i></button>' + 
                                '</span>';

                    return btn;
                }
            }
       ]
    });
    

    // store
    document.getElementById('btn-add').addEventListener('click', e => {
        form.reset();
        form.action = BASE_URL + 'member/store';

    });

    // update
    $('#table-main').on('click', 'button.edit_data', e => {
        let row = tableMain.row($(e.target).parents('tr')[0]).data();
        
        form.reset();
        form['member_id'].value = row.id;
        form['member_name'].value = row.member_name;
        form['no_induk'].value = row.no_induk;
        form['email'].value = row.email;
        form['address'].value = row.address;
        form['phone'].value = row.phone;

        form.action = BASE_URL + 'member/edit';

        $('#modal-input').modal('show');
    });

})(jQuery);