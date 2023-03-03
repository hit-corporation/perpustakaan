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
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Laporan Peminjaman Buku</h1>
			<button id="btn-add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modal-input" >
				<i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Peminjaman
			</button>
			
		</div>

        <div class="card">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6">
						<h6 class="m-0 font-weight-bold text-primary">List Data Peminjaman Buku</h6>

					</div>
					<div class="col-xl-6 col-lg-6 col-md-6">
						<form name="form-search">
							<div class="row">
								<div class="col-10">
									<input type="text" class="form-control form-control-sm" name="s_member_name" placeholder="Nama Member">
								</div>
								<div class="col-2">
									<div class="btn-group btn-group-sm">
										<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
										<button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

            <div class="card-body">
                <div class="table-reponsive">
					<table id="table-main" class="table table-sm table-striped w-100" style="overflow-x: auto;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nama Peminjam</th>
                                <th>Nama Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jumlah Hari</th>
                                <th>Batas Waktu Pengembalian</th>
                                <th>Terlambat</th>
                                <th>Denda</th>
                                <th>Terbayar</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Catatan</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="modal-update" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Pengembalian Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-input" name="form-input" method="POST" action="<?=base_url('order/report_order')?>">
                    <input type="text" class="d-none" name="transaction_book_id">
                    <div class="form-group">
                        <label>Nama Anggota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['member_name'])):?> is-invalid <?php endif ?>" 
                              name="member_name" value="<?=$_SESSION['error']['old']['member_name'] ?? ''?>" readonly>
                        
                        <?php if(!empty($_SESSION['error']['errors']['member_name'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['member_name']?></small>
                        <?php endif ?>
                    </div>
                    
					<div class="form-group">
                        <label>Nama Buku <span class="text-danger">*</span></label>
                        <input readonly type="text" class="form-control <?php if(!empty($_SESSION['error']['errors']['book_title'])):?> is-invalid <?php endif ?>" 
                              name="book_title" value="<?=$_SESSION['error']['old']['book_title'] ?? ''?>">
                        
                        <?php if(!empty($_SESSION['error']['errors']['book_title'])): ?>
                            <small class="text-danger"><?=$_SESSION['error']['errors']['book_title']?></small>
                        <?php endif ?>
                    </div>

					<div class="form-group">
                        <label>Hari Terlambat </label>
                        <input type="text" class="form-control" name="jumlah_hari_terlambat" value="" readonly>
                    </div>
					
					<div class="form-group">
                        <label>Denda </label>
                        <input type="text" class="form-control" name="denda" value="" readonly>
                    </div>

					<div class="form-group">
                        <label>Bayar </label>
                        <input type="number" class="form-control" name="bayar" value="0">
                    </div>

					<div class="form-group">
                        <label>Catatan </label>
                        <textarea type="text" class="form-control" name="notes" value="" rows="3"></textarea>
                    </div>

                    <div class="row justify-content-end mt-4 border-top pt-3 px-2">
                        <!-- <button type="reset" class="btn btn-secondary"><i class="fas fa-sync"></i> Ulangi</button> -->
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
<!-- <script src="<? // =$this->e(base_url('assets/vendor/jstree/dist/jstree.min.js'))?>"></script> -->
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

<script src="<?=$this->e(base_url('assets/js/pages/reportOrder.js'))?>"></script>







<?php $this->stop() ?>
