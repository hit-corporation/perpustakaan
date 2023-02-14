<?php $this->layout('layouts::main_template', ['title' => 'Kategori'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<link href="<?=$this->e(base_url('vendor/jstree/dist/themes/default/style.min.css'))?>" rel="stylesheet">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">
<style>
    #tree-container {
        height: 128px;
        overflow: auto;
    }
</style>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="btn-group">
                            <button id="btn-add" class="btn btn-primary" data-target="#modal-input" data-toggle="modal">
                                <i class="fas fa-plus-circle"></i>
                                <span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-reponsive">
                    <table id="table-main" class="table table-sm">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th>Parent Kategori ID</th>
                                <th>Induk Kategori</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modal-input" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-input" name="form-input">
                    <input type="text" class="d-none" name="category_id">
                    <div class="form-group">
                        <label>Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="category_name">
                    </div>
                    <div class="form-group mt-2">
                        <label>Induk Kategori <span class="text-danger">*</span></label>
                        <div class="border rounded" id="tree-container">

                        </div>
                    </div>
                    <div class="row justify-content-end mt-4 border-top pt-3 px-2">
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-sync"></i> Ulangi</button> 
                        <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-save"></i> Simpan</button> 
                    </div>
                  
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/vendor/jstree/dist/jstree.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/js/pages/categories.min.js'))?>"></script>

<?php $this->stop() ?>