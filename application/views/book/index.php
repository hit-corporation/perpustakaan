<?php $this->layout('layouts::main_template', ['title' => 'Books'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/select2/dist/css/select2.min.css'))?>">
<link href="<?=$this->e(base_url('assets/vendor/jstree/dist/themes/default/style.min.css'))?>" rel="stylesheet">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<style>
.custom-file-input:lang(en)~.custom-file-label::after {
    content: "Cari";
}
#category-tree.show {
    width: 24em;
    height: 18em;
}
</style>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
    <div class="col-12">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 px-2">
            <h1 class="h3 mb-0 text-gray-800"><?=$this->e('Buku')?></h1>
            <button id="btn-add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-target="#modal-input" data-toggle="modal">
                <i class="fas fa-plus fa-sm text-white-50"></i> 
                Tambah Data
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-reponsive">
                    <table class="table table-sm">
                        <thead class="bg-primary text-white">

                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modal-input" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Input Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-input" class="modal-body">
                <fieldset class="row">
                    <div class="col-12 col-lg-8">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Judul Buku <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" class="form-control form-control-sm" name="book-title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kategori Buku <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" class="d-none" name="book-category">
                                <input type="text" class="form-control  form-control-sm dropdown-toggle cursor-pointer" name="book-category_text" id="book-category_text" data-toggle="dropdown" readonly>
                                <div id="category-tree" class="dropdown-menu">
                                    <div class="overflow-auto">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Penulis <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" class="form-control form-control-sm" name="book-author">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Penerbit <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <select class="form-control " name="book-publisher">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ISBN <span class="text-danger">*</span></label>
                            <div class="col-8">
                            <input type="text" class="form-control form-control-sm" name="book-isbn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Deskripsi/Sinopsis</label>
                            <div class="col-8">
                                <textarea class="form-control  form-control-sm" name="book-description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label>Cover</label>
                        <figure>
                            <img id="img-cover" class="d-block mx-auto" src="<?=$this->e(base_url('assets/img/book_placeholder.png'))?>" height="165" width="128">
                            <figcaption>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="book-image" id="book-image">
                                    <label class="custom-file-label" for="book-image" aria-describedby="book-image">Pilih Berkas</label>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </fieldset>
                <fieldset class="row justify-content-end mt-4 border-top pt-3 px-2">
                    <button type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-sync"></i> Ulangi</button>
                    <button type="submit" class="btn btn-sm btn-primary ml-2"><i class="fas fa-save"></i> Simpan</button>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/node_modules/select2/dist/js/select2.full.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/vendor/jstree/dist/jstree.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/js/pages/book.js'))?>"></script>

<?php $this->stop() ?>