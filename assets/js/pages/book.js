'use strict';
//import PaginationSystem from '../../node_modules/pagination-system/dist/pagination-system.esm.min.js';

const formSearch = document.forms['form-search'];
const form = document.forms['form-input'],
display = document.querySelector('#ul-display'),
imgCover = document.getElementById('img-cover');

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

(async ($, window) => {

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
    

    // Paging Grid
    const pageOptions = {
        container: document.querySelector('#data-grid'),
        dataContainer: document.querySelector('#data-grid'),
        dataRenderFn: (datapage) => {
            console.log(datapage);
            return `${datapage.map(item => 
                `<div class="col-12 col-lg-6">
                    <figure class="d-flex bg-white rounded shadow">
                        <img class="img-fluid img-grid-height" loading="lazy" src="${item.cover_img.length > 0 ? BASE_URL + `assets/img/books/${item.cover_img}` : BASE_URL + 'assets/img/Placeholder_book.svg' }">
                        <figcaption class="w-100 p-0 m-0">
                            <div class="position-relative p-2 top-0 left-0 h-100 w-100">
                                <h6 class="text-primary">${item.created_at}</h6>
                                <h4>${item.title}</h4>
                                <dl class="mb-5">
                                    <dt>Penerbit<dt>
                                    <dd>${item.publisher_name}</dd>
                                    <dt>Penulis<dt>
                                    <dd>${item.author}</dd>
                                    <dt>ISBN<dt>
                                    <dd>${item.isbn ? item.isbn : '-' }</dd>
                                </dl>
                                <div class="py-2"></div>
                                <div class="position-absolute p-2 w-100" style="bottom: 0; left: 0">
                                    <hr class="mb-2">
                                    <span class="d-flex flex-nowrap w-100 justify-content-end">
                                        <button role="button" class="btn-circle btn-info rounded-circle border-0 show_data"><i class="fas fa-eye"></i></button>
                                        <button role="button" class="btn-circle btn-success rounded-circle border-0 edit_data"><i class="fas fa-edit"></i></button> 
                                        <a role="button" href="${BASE_URL}book/erase/${item.id}" class="btn-circle btn-danger rounded-circle border-0 delete_data"><i class="fas fa-trash"></i></a>
                                    </span>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>`
            ).join('')}`;
        },
        url: BASE_URL + 'book/get_all_paginated',
        urlParams: {
            limit: 'length',
            pageNumber: 'page'
        },
        perPage: 8,
        pagingContainer: document.querySelector('#paging-container')
    };

    const dataPage =  await (new PaginationSystem(pageOptions)).getDataKeys().then(t => {
        console.log(t);
    });
    console.log(dataPage);

    // // show one
    // $('#table-main tbody').on('click', 'button.show_data', e => {
    //     var row = table.row(e.target.parentNode.closest('tr')).data();
    //     var sets = document.querySelectorAll('[data-item]');

    //     for(var set of sets)
    //     {
    //         if(set.dataset.item === 'cover_img')
    //         {
    //             if(row[set.dataset.item])
    //                 set.src = BASE_URL + 'assets/img/books/' + row[set.dataset.item];
    //             else
    //                 set.src = BASE_URL + 'assets/img/Placeholder_book.svg'
    //         }

    //         set.innerText = row[set.dataset.item];
    //     }

    //     $('#modal-show').modal('show');
    // });

    // // reset
    // form.addEventListener('reset', e => {
    //     e.preventDefault();
    //     resetForm();
    // });

    // // add data
    // document.getElementById('btn-add').addEventListener('click', e => {
    //      // reset form
    //      form.action = BASE_URL + 'book/store';
    //      resetForm();
    // });

    // // edit data
    // $('#table-main tbody').on('click', 'button.edit_data', e => {
    //     var row = table.row(e.target.parentNode.closest('tr')).data();

    //     // reset form
    //     form.action = BASE_URL + 'book/edit';
    //     resetForm();

    //     form['book-id'].value = row.id;
    //     form['book-title'].value = row.title;
    //     form['book-category'].value = row.category_id;
    //     form['book-category_text'].value = row.category_name;
    //     form['book-publisher'].value = row.publisher_id;
    //     form['book-author'].value = row.author;
    //     form['book-isbn'].value = row.isbn;
    //     form['book-year'].value = row.publish_year;
    //     form['book-qty'].value = row.qty;
    //     form['book-description'].value = row.description;
    //     form['book-img_name'].value = row.cover_img;

    //     // imagge
    //     if(row.cover_img)
    //       imgCover.src =  BASE_URL + 'assets/img/books/' + row.cover_img;

    //     // tree
    //     $('#category-tree').jstree(true).select_node(form["book-category"].value);

    //     // select
    //     selectize.setValue(row.publisher_id);

    //     $('#modal-input').modal('show');
    // });

    //  // reset form action
    // function resetForm()
    // {
    //     const formData = new FormData(form);
    //     const fields = Object.fromEntries(formData.entries());
        
    //     for(const field in fields) 
    //     {
    //         form[field].value = null;
    //         form[field].classList.remove('is-invalid');
    //         if(document.querySelector('small[data-error="'+field+'"]'))
    //             document.querySelector('small[data-error="'+field+'"]').innerHTML = null;
    //     }

    //     $('#category-tree').jstree(true).refresh();
    //     imgCover.src = BASE_URL + 'assets/img/Placeholder_book.svg';
    //     selectize.clear();
    //     form['book-year'].value = thisYear;
        
       
    // }

	// // Search submit
    // formSearch.addEventListener('submit', e => {
    //     e.preventDefault();
		
    //     // if(formSearch['s_member_name'].value)
	// 	table.columns(1).search(formSearch['s_book_name'].value).draw();
        
    // });
})(jQuery, window);

const gridDisplay = () => {

}

