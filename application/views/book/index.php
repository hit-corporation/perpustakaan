<?php $this->layout('layouts::main_template', ['title' => 'Books'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/css/selectize.bootstrap4.css'))?>">
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

        <div class="row">
            <div class="col-4"></div>
            <div class="col-8">
                <div class="row" id="ul-display">
                    
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
            <form name="form-input" action="<?=$this->e(base_url('book/store'))?>" class="modal-body" method="POST" enctype="multipart/form-data">
                <fieldset class="row">
                    <div class="col-12 col-lg-8">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Judul Buku <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" class="form-control <?=empty($_SESSION['error']['errors']['book-title']) ?: 'is-invalid' ?>" name="book-title" value="<?=$_SESSION['error']['old']['book-title'] ?? NULL ?>">
                                <?php if(!empty($_SESSION['error']['errors']['book-title'])): ?>
                                    <small class="text-danger"><?=$_SESSION['error']['errors']['book-title']?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kategori Buku <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" class="d-none" name="book-category" value="<?=$_SESSION['error']['old']['book-category'] ?? NULL ?>">
                                <input type="text" class="form-control dropdown-toggle cursor-pointer <?=empty($_SESSION['error']['errors']['book-category']) ?: 'is-invalid' ?>" 
                                    name="book-category_text" 
                                    id="book-category_text" 
                                    data-toggle="dropdown" 
                                    readonly>

                                <div id="category-tree" class="dropdown-menu">
                                    <div class="overflow-auto">

                                    </div>
                                </div>
                                <?php if(!empty($_SESSION['error']['errors']['book-category'])): ?>
                                    <small class="text-danger"><?=$_SESSION['error']['errors']['book-category']?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Penulis <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" class="form-control <?=empty($_SESSION['error']['errors']['book-author']) ?: 'is-invalid' ?>" 
                                       name="book-author" value="<?=$_SESSION['error']['old']['book-author'] ?? NULL ?>">
                                <?php if(!empty($_SESSION['error']['errors']['book-author'])): ?>
                                    <small class="text-danger"><?=$_SESSION['error']['errors']['book-author']?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Penerbit <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <select class="form-control <?=empty($_SESSION['error']['errors']['book-publisher']) ?: 'is-invalid' ?>" 
                                        name="book-publisher" value="<?=$_SESSION['error']['old']['book-publisher'] ?? NULL ?>">
                                    <option></option>
                                </select>
                                <?php if(!empty($_SESSION['error']['errors']['book-publisher'])): ?>
                                    <small class="text-danger"><?=$_SESSION['error']['errors']['book-publisher']?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ISBN</label>
                            <div class="col-8">
                            <input type="text" class="form-control" name="book-isbn" value="<?=$_SESSION['error']['old']['book-isbn'] ?? NULL ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Deskripsi/Sinopsis</label>
                            <div class="col-8">
                                <textarea class="form-control" name="book-description" rows="5">
                                    <?=$_SESSION['error']['old']['book-description'] ?? NULL ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label>Cover</label>
                        <div class="shadow p-1">
                            <label for="book-image" aria-describedby="book-image" class="m-0 p-0">
                                <img id="img-cover" class="img-fluid d-block mx-auto" src="<?=$this->e(base_url('assets/img/Placeholder_book.svg'))?>" height="265" width="228">
                            </label>
                            <input type="file" class="d-none" name="book-image" id="book-image">
                        </div>
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
<script src="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/js/selectize.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/vendor/jstree/dist/jstree.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>

<?php if(!empty($_SESSION['success'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: '<h4 class="text-success"></h4>',
        html: '<h5 class="text-success"><?=$_SESSION['success']['message']?></h5>',
        timer: 1400
    });
</script>
<?php endif ?>

<?php if(!empty($_SESSION['error'])):?>
<script>
    <?php if(!empty($_SESSION['error']['message'])): ?>
        Swal.fire({
            icon: 'error',
            title: '<h4 class="text-error"></h4>',
            html: '<h5 class="text-error"><?=$_SESSION['error']['message']?></h5>',
            timer: 1400
        });
    <?php endif ?>
    $('#modal-input').modal('show');
</script>
<?php endif ?>

<script src="<?=$this->e(base_url('assets/js/pages/book.js'))?>"></script>

<?php $this->stop() ?>