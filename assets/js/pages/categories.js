'use strict';


// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/kategori/get_all');
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
    // Datatable
    const tableMain = $('#table-main').DataTable({
        serverSide: true,
        ajax: {
            url: BASE_URL + '/kategori/get_all_paginated'
        },
        pageLength: 8,
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'category_name',
                className: 'align-center'
            },
            {
                data: 'parent_category',
                visible: false
            },
            {
                data: 'parent_category',
                render(data, type, row, _meta)
                {
                    let parentName = (typeof data !== 'undefined' && data !== null) ? _meta.settings.json.data.find(x => x.id == data).category_name : '';
                    return parentName;
                }
            },
            {
                data: null,
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0"><i class="fas fa-edit"></i></button>' + 
                                '<button role="button" class="btn-circle btn-danger rounded-circle border-0"><i class="fas fa-trash"></i></button>' + 
                                '</span>';

                    return btn;
                }
            }
       ]
    });
    
    // tree
    const treedata = [...(await getAll())].map(x => ({id: x.id, text: x.category_name, parent: x.parent_category}));

    $('tree-container').jstree({
        core: {
            data: treedata
        },
        plugins: ['checkbox']
    });


})(jQuery);






