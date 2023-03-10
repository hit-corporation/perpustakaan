<div id="modal_stock" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0">DETAIL BUKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="save-stock" id="save-stock" class="modal-body">
                <div class="form-group">
                    <label class="form-label mb-0">Buku <span class="text-danger">*</span></label>
                    <select class="form-control" name="book" value="<?=$this->e($book_id)?>"></select>
                </div>
                <div class="table-reponsive">
                    <table class="table table-sm">
                        <thead class="bg-orange text-white">
                            <tr>
                                <th>No</th>
                                <th>Kode Stok</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
       </div>
    </div>
</div>