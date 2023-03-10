<script>
    const formStock = document.forms['save-stock'];

    (async $ => {
        const books = [...await getBooks()];

        // select
        var $select = $('#save-stock select[name="book"]').selectize({
            create: false,
            valueField: 'id',
            labelField: 'title',
            options: books
        });

        // modal stock event
        $('#modal_stock').on('show.bs.modal', e => {
            if(formStock.getAttribute('value'))
            {

            }
        });
    })(jQuery);
</script>