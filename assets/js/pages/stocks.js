'use strict';

(async $ => {

    const table = $('#table-main').DataTable({
        columnDefs: [
            {
                targets: 0,
                visible: false
            }
        ]
    });

})(jQuery);