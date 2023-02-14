'use strict';

// INIT
(async ($) => {
    // Datatable
    const tableMain = $('#table-main').DataTable({
        ajax: {
            url: BASE_URL + '/kategori/get_all'
        },
        pageLength: 8,
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'category_name',
            },
            {
                data: 'parent_category',
                visible: false
            },
            {
                data: null,
                render(data, type, row, _meta)
                {
                    console.log(row);
                    return '';
                }
            },
            {
                data: null,
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


