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
					
					<div class="col-xl-2 col-lg-4 col-md-4 mb-2">
						<form name="form-search">
							<div class="row">
								<div class="col-12">
									<input class="rounded-lg w-100"  style="border-color: rgba(0, 0, 255, 0.3); height: calc(1.5em + 0.5rem + 2px); font-size: 12px;
    color: currentcolor; padding-left: inherit;" type="text" name="daterange" 
										value="<?php 
										if(isset($start)){ 
											echo date('m/d/Y', strtotime($start));
										} else { 
											echo date('m', time()).'//1//'.date('Y', time()); 
										}?> - <?php 
										if(isset($end)){ 
											echo date('m/d/Y', strtotime($end)); 
										}else{ 
											echo date('m/d/Y', time()); 
										}?>" />
								</div>
							</div>
						</form>
					</div>

					<div class="col-xl-10 col-lg-8 col-md-8">
						<form name="form-search-name">
							<div class="row">
								<div class="col-4">
									<select class="form-control form-control-sm" name="status" id="status">
										<option value="">Status - Semua</option>
										<option value="sudah">Sudah Mengembalikan</option>
										<option value="belum">Belum Mengembalikan</option>
									</select>
								</div>
								
								<div class="col-6">
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
                <div class="table-reponsive" style="overflow: auto;">
					<table id="table-main" class="table table-sm table-striped w-100">
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

<script src="<?=$this->e(base_url('assets/js/pages/orderReport.js'))?>"></script>
<!-- <script src="<?//=base_url('assets/js/jquery.redirect.js')?>"></script> -->



<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<script>
// $(function() {
// 	$('input[name="daterange"]').daterangepicker({
// 		opens: 'left'
// 	}, function(start, end, label) {
// 		$.redirect('<? // =base_url('report')?>', {
// 			'daterange': start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'),
// 		}, 'POST');
// 	});
// });
</script>

<?php $this->stop() ?>
