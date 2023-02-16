<?php $this->layout('layouts::main_template', ['title' => 'Kategori'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<link href="<?=$this->e(base_url('assets/vendor/jstree/dist/themes/default/style.min.css'))?>" rel="stylesheet">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">
<style>
#tree-container {
    height: 240px;
    overflow: auto;
}
</style>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
    <div class="col-12">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 px-2">
            <h1 class="h3 mb-0 text-gray-800"><?=$this->e('Kategori')?></h1>
            <button id="btn-add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-target="#modal-input" data-toggle="modal">
                <i class="fas fa-plus fa-sm text-white-50"></i> 
                Tambah Data
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row mb-3">
                    <div class="col-12 col-lg-5">
                       <input type="text" class="form-control form-control-sm" name="s_category_name" placeholder="Nama Kategori">
                    </div>
                    <div class="col-12 col-lg-5">
                        <input type="text" class="form-control form-control-sm" name="s_category_parent" placeholder="Induk Kategori">
                    </div>
                    <div class="col-12 col-lg-2">
                       <div class="btn-group btn-group-sm">

                       </div>
                    </div>
                </form>
                <div class="table-reponsive">
                    <table id="table-main" class="table table-sm table-striped">
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
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-input" name="form-input" method="POST" action="<?=base_url('kategori/store')?>">
                    <input type="text" class="d-none" name="category_id">
                    <div class="form-group">
                        <label>Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['category_name'])):?> is-invalid <?php endif ?>" 
                              name="category_name" value="<?=$_SESSION['error']['old']['category_name'] ?? ''?>" required>
                        
                        <?php if(!empty($_SESSION['error']['errors']['category_name'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['category_name']?></small>
                        <?php endif ?>
                    </div>

                    <div class="form-group mt-2">
                        <label>Induk Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="category_parent" class="d-none" value="<?=$_SESSION['error']['old']['category_parent'] ?? ''?>">
                        <div class="border rounded <?php if(!empty($_SESSION['error']['errors']['category_parent'])):?> border-danger <?php endif ?>" id="tree-container">

                        </div>
                        <?php if(!empty($_SESSION['error']['errors']['category_parent'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['category_parent']?></small>
                        <?php endif ?>
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
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>

<?php if(isset($_SESSION['error'])): ?>
<script>
   $('#modal-input').modal('show');
</script>
<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>
<script>
   
    Swal.fire({
        icon: 'success',
        title: '<h4 class="text-success">SUKSES</h4>',
        html: '<h5 class="text-success"><?=$_SESSION['success']['message']?></h5>',
        timer: 1500
    });

</script>
<?php endif; ?>

<script src="<?=$this->e(base_url('assets/js/pages/categories.js'))?>"></script>


<?php $this->stop() ?>