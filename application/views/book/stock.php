<?php $this->layout('layouts::main_template', ['title' => 'Stok Buku'])?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/css/selectize.bootstrap4.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<?php $this->stop() ?>

<?php $this->start('contents') ?>
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between pb-2 mb-3 px-2 border-bottom">
		<h1 class="h3 mb-0 text-gray-800"><?=$this->e('Stok Buku')?></h1>
		<button id="btn-add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-target="#modal_stock" data-toggle="modal">
			<i class="fas fa-plus fa-sm text-white-50"></i> 
			Tambah Data
		</button>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-main" class="table table-sm">
					<thead class="bg-purple">
						<tr>
							<th>ID</th>
							<th>Kode Stok</th>
							<th>Book Id</th>
							<th>Judul</th>
							<th>Rak No</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>

<?php $this->insert('book/modal_stock', ['book_id' => ($_SESSION['error']['old']['book'] ?? NULL ), 'is_readonly' => FALSE]) ?>

<?php $this->stop() ?>

<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/js/selectize.min.js'))?>"></script>

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

<?php if(isset($_SESSION['error'])): ?>
<script>
   <?php if(!empty($_SESSION['error']['message'])): ?>
    Swal.fire({
        icon: 'error',
        title: '<h4 class="text-danger">GAGAL</h4>',
        html: '<h5 class="text-danger"><?=$_SESSION['error']['message']?></h5>',
        timer: 1500
    });
	<?php endif ?>

	$('#modal_stock').modal('show');
</script>
<?php endif; ?>

<script src="<?=$this->e(base_url('assets/js/pages/stocks.js'))?>"></script>

<?php $this->insert('book/modal_stock_js', ['is_readonly' => false]) ?>

<?php $this->stop() ?>
