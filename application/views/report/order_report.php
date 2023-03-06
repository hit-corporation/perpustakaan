<?php $this->layout('layouts::main_template', ['title' => 'Kategori'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>

<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<style>

</style>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Laporan Peminjaman Buku</h1>
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
                                <th>Book ID</th>
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



<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>

<script src="<?=$this->e(base_url('assets/js/pages/order_report.js'))?>"></script>

<?php $this->stop() ?>
