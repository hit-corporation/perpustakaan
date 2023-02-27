'use strict';
const tableForm = document.getElementById('book-form');
const tbody = tableForm.tBodies[0];
let idx = 0;

(async $ => {

    document.getElementById('btn-add-book').addEventListener('click', e => {
        addData(idx);

        idx++;
    });

})(jQuery);

const addData = idx => {
    const tr = tbody.insertRow();
    tr.classList.add('d-flex', 'flex-column','d-lg-table-row');

    const cell_0 = tr.insertCell(0);
    const cell_1 = tr.insertCell(1);
    const cell_2 = tr.insertCell(2);
    const cell_3 = tr.insertCell(3);

    // cell 0
    cell_0.innerHTML = '<label class="d-lg-none mb-0">Judul</label>' +
                       `<input type="text" class="form-control" name="book[${idx}][title]">`; 
    cell_0.classList.add('d-inline-block', 'd-lg-table-cell');
    // cell 1
    cell_1.innerHTML = '<label class="d-lg-none mb-0">Jumlah</label>' +
                        `<input type="number" class="form-control" min="0" name="book[${idx}][qty]">`;
    cell_1.classList.add('d-inline-block', 'd-lg-table-cell');
    // cell 2
    cell_2.innerHTML =  '<label class="d-lg-none mb-0">Tgl Pengembalian</label>' + 
                        `<input type="date" class="form-control" name="book[${idx}][return_date]">`;
    cell_2.classList.add('d-inline-block', 'd-lg-table-cell');
    // cell 3
    const btnDelete = document.createElement('button');
    btnDelete.innerHTML = '<i class="fas fa-trash"></i>';
    btnDelete.classList.add('btn-circle', 'btn-danger', 'rounded-circle', 'border-0', 'delete_data');
    btnDelete.type = 'button';
    btnDelete.onclick = async e => deleteRow(e);

    //cell_3.innerHTML =  '<button href="javascript:void(0)" class="btn-circle btn-danger rounded-circle border-0 delete_data"><i class="fas fa-trash"></i></button>';
    cell_3.appendChild(btnDelete);
    cell_3.classList.add('d-inline-block', 'd-lg-table-cell');
    
    // delete button;

}

const deleteRow = async e => {
    e.target.parentNode.closest('tr').remove();
}