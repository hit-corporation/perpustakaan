'use strict';

const form = document.forms['form-input'];

// get all data
const getCategories = async () => {
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

(async $ => {

    // category tree
    const categories = [...(await getCategories())].map(x => ({id: x.id, text: x.category_name, parent: x.parent_category == null ? '#' : x.parent_category }));

    $('#category-tree').jstree({
        core: {
            multiple: false,
            data: categories
        },
        checkbox: {
            'three_state': false,
            'tie_selection': true
        },
        plugins: ['checkbox']
    })
    .bind('select_node.jstree', (e, data) => {
        form["book-category"].value = data.node.id;
        form["book-category_text"].value = data.node.text;
    })
    .bind('deselect_node.jstree', (e, data) => {
        form["book-category"].value = '';
        form["book-category_text"].value = '';
    })
    .bind('loaded.jstree', (e, data) => {
        if(form["book-category"].value.value)
            $('#category-tree').jstree(true).select_node(form["book-category"].value);
    });

    $('#category-tree').on('click', e => {
        e.stopPropagation();
    });
})(jQuery);