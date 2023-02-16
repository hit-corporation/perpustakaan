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
                    <table id="table-main" class="table table-sm table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nama Member</th>
                                <th>Nomor Induk</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Phone</th>
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
                <form id="form-input" name="form-input" method="POST" action="<?=base_url('member/store')?>">
                    <input type="text" class="d-none" name="member_id">
                    <div class="form-group">
                        <label>Nama Member <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['member_name'])):?> is-invalid <?php endif ?>" 
                              name="member_name" value="<?=$_SESSION['error']['old']['member_name'] ?? ''?>" required>
                        
                        <?php if(!empty($_SESSION['error']['errors']['member_name'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['member_name']?></small>
                        <?php endif ?>
                    </div>
                    
					<div class="form-group">
                        <label>No Induk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['no_induk'])):?> is-invalid <?php endif ?>" 
                              name="no_induk" value="<?=$_SESSION['error']['old']['no_induk'] ?? ''?>" required>
                        
                        <?php if(!empty($_SESSION['error']['errors']['no_induk'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['no_induk']?></small>
                        <?php endif ?>
                    </div>

					<div class="form-group">
                        <label>Email </label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['email'])):?> is-invalid <?php endif ?>" 
                              name="email" value="<?=$_SESSION['error']['old']['email'] ?? ''?>" required>
                        
                        <?php if(!empty($_SESSION['error']['errors']['email'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['email']?></small>
                        <?php endif ?>
                    </div>
					
					<div class="form-group">
                        <label>Alamat </label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['address'])):?> is-invalid <?php endif ?>" 
                              name="address" value="<?=$_SESSION['error']['old']['address'] ?? ''?>" required>
                        
                        <?php if(!empty($_SESSION['error']['errors']['address'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['address']?></small>
                        <?php endif ?>
                    </div>

					<div class="form-group">
                        <label>Telp </label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['phone'])):?> is-invalid <?php endif ?>" 
                              name="phone" value="<?=$_SESSION['error']['old']['phone'] ?? ''?>" required>
                        
                        <?php if(!empty($_SESSION['error']['errors']['phone'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['phone']?></small>
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

<script src="<?=$this->e(base_url('assets/js/pages/members.js'))?>"></script>







<?php $this->stop() ?>
