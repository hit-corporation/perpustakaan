'use strict';

// INIT
(async ($) => {
    // Datatable
    const tableMain = $('#table-main').DataTable({
       columnDefs: [
            {
                targets: [0,2],
                visible: false,
            },
            {
                target: 4,
                render(data, type, row, _meta)
                {
                    const btn = '<button class"btn btn-success rounded-circle border-0"><i class="fas fa-edit"></i></button>' + 
                                '<button class"btn btn-danger rounded-circle border-0"><i class="fas fa-trash"></i></button>';

                    return btn;
                }
            }
       ]
    });


    // TREE
    $('#tree-container').jstree({
        core: {
            data: {
                url: BASE_URL + '/kategori/get_all',
                method: 'POST'
            }
        },
        checkbox: {
            'deselect_all': true,
            'three_state' : true, 
        },
        plugins: ['checkbox']
    });
})(jQuery);

// 


