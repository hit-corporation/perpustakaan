'use strict';

const form = document.forms['form-input'],
      display = document.querySelector('#ul-display');

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
    var $select = $('select[name="book-publisher"]').selectize({
        create: false,
        valueField: 'id',
        labelField: 'text',
        options: publisher
    });

    var selectize = $select[0].selectize;
    selectize.load(e => {
        if(form['book-publisher'].getAttribute('value'))
           selectize.setValue(form['book-publisher'].getAttribute('value'));
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

    // yearpicker
    const thisYear =  (new Date()).getFullYear();
    form['book-year'].max = thisYear;
    if(!form['book-year'].getAttribute('value'))
        form['book-year'].value = thisYear;
    

    // Datatable
    var table = $('#table-main').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'book/get_all_paginated'
        },
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'cover_img',
                render: (data, type, row, _meta) => {
                    if(data)
                        return '<img src="'+BASE_URL+'assets/img/books/'+data+'" height="'+(165 - 50)+'" width="'+(128 - 50)+'">';
                    return  '<img src="'+BASE_URL+'assets/img/Placeholder_book.svg" height="'+(165 - 50)+'" width="'+(128 - 50)+'">';;
                }
            },
            {
                data: 'title',
                className:'align-middle'
            },
            {
                data: 'category_id',
                visible: false
            },
            {
                data: 'category_name',
                className: 'align-middle'
            },
            {
                data: 'publisher_id',
                visible: false
            },
            {
                data: 'publisher_name',
                className: 'align-middle'
            },
            {
                data: 'isbn',
                className: 'align-middle'
            },
            {
                data: null,
                className: 'align-middle',
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-info rounded-circle border-0 show_data"><i class="fas fa-eye"></i></button>' + 
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 edit_data"><i class="fas fa-edit"></i></button>' + 
                                '<button role="button" class="btn-circle btn-danger rounded-circle border-0 delete_data"><i class="fas fa-trash"></i></button>' + 
                                '</span>';

                    return btn;
                }
            }
        ]
    });

    // show one
    $('#table-main tbody').on('click', 'button.show_data', e => {
        var row = table.row(e.target.parentNode.closest('tr')).data();
        var sets = document.querySelectorAll('[data-item]');

        for(var set of sets)
        {
            if(set.dataset.item === 'cover_img')
            {
                if(row[set.dataset.item])
                    set.src = BASE_URL + 'assets/img/books/' + row[set.dataset.item];
                else
                    set.src = BASE_URL + 'assets/img/Placeholder_book.svg'
            }

            set.innerText = row[set.dataset.item];
        }

        $('#modal-show').modal('show');
    });

   // await setGridDisplay(await getBooks());
})(jQuery);

// const setGridDisplay = async data => {
//     display.innerHTML = null;

//     Array.from(data, item => {
//         const col = document.createElement('div');
//         col.classList.add('col-12', 'col-md-4', 'col-lg-2');

//         const card = document.createElement('div');
//         card.classList.add('card');
//         card.style.height = "300px";
//         col.appendChild(card);

//         const body = document.createElement('div');
//         body.classList.add('card-body', 'px-2', 'pt-2', 'justify-content-center');
//         card.appendChild(body);

//         let cover = BASE_URL + 'assets/img/Placeholder_book.svg';

//         if(item.cover_img)
//             cover = BASE_URL + 'assets/img/books/'+item.cover_img;

//         const img = document.createElement('img');
//         img.classList.add('w-100', 'mx-auto');
//         img.src = cover;
//         img.loading = "lazy";
//         img.setAttribute('style', 'height: 165px !important');
//         body.appendChild(img);

//         const p = document.createElement('p');
//         p.innerHTML = item.title;
//         p.style.fontSize = '14px';
//         p.classList.add('text-center');
//         body.appendChild(p);

//         const btnContainer = document.createElement('div');
//         btnContainer.classList.add('card-footer', 'bg-white', 'd-flex', 'justify-content-center');
//         btnContainer.style.bottom = 0;
//         btnContainer.style.left = 0;
//         card.appendChild(btnContainer);

//         const btnDetails = document.createElement('a');
//         btnDetails.classList.add('btn', 'btn-sm', 'btn-info', 'mx-auto');
//         btnDetails.innerHTML = 'Details';
//         btnDetails.href = BASE_URL + 'book/show/' + item.id;
//         btnContainer.appendChild(btnDetails);

//         display.appendChild(col);
//     });

// }