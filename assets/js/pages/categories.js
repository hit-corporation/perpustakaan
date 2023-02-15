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
    const allData = await getAll();

    // Datatable
    const tableMain = $('#table-main').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + '/kategori/get_all_paginated'
        },
        pageLength: 7,
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
                    let parent = '';

                    if(allData.find(x => x.id == data))
                        parent = allData.find(x => x.id == data).category_name;
                    return parent;
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
    const treedata = allData.map(x => ({id: x.id, text: x.category_name, parent: x.parent_category == null ? '#' : x.parent_category }));

    $('#tree-container').jstree({
        core: {
            multiple: false,
            data: treedata
        },
        checkbox: {
            'three_state': false,
            'tie_selection': true
        },
        plugins: ['checkbox']
    })
    .bind('select_node.jstree', (e, data) => {
        console.log(data);
        document.querySelector('input[name="category_parent"]').value = data.node.id;
    });


})(jQuery);






