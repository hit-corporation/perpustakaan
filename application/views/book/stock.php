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

<div id="modal-input" class="modal fade show">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title">DETAIL BUKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<form class="modal-body">
				<div class="form-group">
					<label class="form-label mb-0">Buku <span class="text-danger">*</span></label>
					<select class="form-control" name="book">

					</select>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->stop() ?>

<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/js/pages/stocks.js'))?>"></script>
<?php $this->stop() ?>
