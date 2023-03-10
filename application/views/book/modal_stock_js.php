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

        var sel = $select[0].selectize;

        // modal stock event
        $('#modal_stock').on('show.bs.modal', e => {
            if(formStock['book'].getAttribute('value'))
                sel.setValue(formStock['book'].getAttribute('value'));
            <?php if($is_readonly): ?>
                sel.lock();
            <?php endif ?>
        });
    })(jQuery);
</script>