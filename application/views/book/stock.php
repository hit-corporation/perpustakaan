<?php $this->layout('layouts::main_template', ['title' => 'Stok Buku'])?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<?php $this->stop() ?>

<?php $this->start('contents') ?>
<div class="container-fluid">

	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-main" class="table table-sm">
					<thead class="bg-purple">
						<tr>
							<th>ID</th>
							<th>Kode Stok</th>
							<th>Judul</th>
							<th>Rak No</th>
							<th>Status</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>
<?php $this->stop() ?>

<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/pages/js/stock.js'))?>"></script>
<?php $this->stop() ?>
