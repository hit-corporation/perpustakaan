'use strict';

const form = document.forms['form-input'];
const formSearch = document.forms['form-search'];

// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/user/get_all');
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
            url: BASE_URL + '/user/get_all_paginated'
        },
        pageLength: 10,
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'user_name',
                className: 'align-middle pl-2'
            },
            {
                data: 'full_name'
            },
            {
                data: 'email'
            },
            {
                data: 'user_pass',
				visible: false
            },
            {
                data: 'status'
            },
            {
                data: 'rolename'
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
        form.action = BASE_URL + 'user/store';

    });

    // update
    $('#table-main').on('click', 'button.edit_data', e => {
        let row = tableMain.row($(e.target).parents('tr')[0]).data();
        
        form.reset();
        form['user_id'].value = row.id;
        form['user_name'].value = row.user_name;
        form['full_name'].value = row.full_name;
        form['email'].value = row.email;
        form['user_pass'].value = row.user_pass;
        form['status'].value = row.status;
        form['rolename'].value = row.rolename;

        form.action = BASE_URL + 'user/edit';

        $('#modal-input').modal('show');
    });

	// Search submit
    formSearch.addEventListener('submit', e => {
        e.preventDefault();

        if(formSearch['s_user_name'].value) 
			tableMain.columns(1).search(formSearch['s_user_name'].value).draw();
        
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
