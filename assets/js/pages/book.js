'use strict';

const form = document.forms['form-input'];

// get all Categories
const getCategories = async () => {
    try
    {
        const f = await fetch(BASE_URL + 'kategori/get_all');
        const j = await f.json();

        return j;
    }   
    catch(err)
    {
        console.log(err);
    }    
}

// get all publisher
const getPublisher = async () => {
    try
    {
        const f = await fetch(BASE_URL + 'publisher/get_all');
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
        if(form["book-category"].value)
            $('#category-tree').jstree(true).select_node(form["book-category"].value);
    });

    $('#category-tree').on('click', e => {
        e.stopPropagation();
    });

    // penerbit
    const publisher = [...(await getPublisher())].map(x => ({'id': x.id, 'text': x.publisher_name}));

    $('select[name="book-publisher"]').selectize({
        valueField: 'id',
        labelField: 'text',
        options: publisher
    });

    // file upload
    const imgCover = document.querySelector('#img-cover'),
          fileInput = document.getElementById('book-image');

    fileInput.addEventListener('change', e => {
        if(e.target.files && e.target.files[0]) {
            const fReader = new FileReader();
            const file = e.target.files;

            fReader.addEventListener('load', e => {
                imgCover.src = e.target.result;
                console.log(file);
            });

            fReader.readAsDataURL(e.target.files[0]);
        }
    });
})(jQuery);