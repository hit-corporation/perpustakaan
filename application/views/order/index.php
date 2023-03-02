<?php $this->layout('layouts::main_template', ['title' => 'Book Order'])?>

<!-- CSS SECTION -->
<?php $this->start('css') ?>
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/css/selectize.bootstrap4.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<style>

    .table td {
        border: none;
    }

    .table tr {
        border-top: 1px solid #e3e6f0;
        margin-top: .4rem;
    }

    .w-max-content {
       width: max-content; 
    }

    @media (min-width: 992px) {
        .d-lg-table-head {
            display: table-header-group !important;
        }

        .table td {
            border-top: 1px solid #e3e6f0;
        }

        .table tr {
            border: none;
            margin: 0px;
        }
    }

</style>

<?php $this->stop() ?>

<!-- CONTENT SECTION -->
<?php $this->start('contents') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
			
            <div class="d-sm-flex align-items-center justify-content-between mb-4 px-2">
                <h1 class="h3 mb-0 text-gray-800"><?=$this->e('Formulir Peminjaman Buku')?></h1>
            </div>

            <div class="card">

                <form name="form-input" class="card-body" method="POST" action="<?=$this->e(base_url('order/store'))?>">
                    <fieldset class="row justify-content-end w-100">
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-sync"></i> Ulangi</button>
                        <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-save"></i> Simpan</button>
                   </fieldset>
                    <fieldset class="form-row">
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <label for="" class="form-label">Anggota <span class="text-danger">*</span></label>
                            <select class="form-control <?php if(!empty($_SESSION['error']['errors']['member'])): ?> is-invalid <?php endif ?>" name="member" value="<?=$_SESSION['error']['old']['member'] ?? NULL ?>"></select>
                            <?php if(!empty($_SESSION['error']['errors']['member'])): ?>
                                <small class="text-danger"><?=$_SESSION['error']['errors']['member']?></small>
                            <?php endif ?>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <label for="" class="form-label">Tanggal Peminjaman <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start-date" value="<?=$_SESSION['error']['old']['start-date'] ?? NULL ?>">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <label for="" class="form-label">Tanggal Pengembalian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end-date" value="<?=$_SESSION['error']['old']['end-date'] ?? NULL ?>">
                        </div>
                    </fieldset>
                   <fieldset class="w-100 mt-4 ">
                        <div class="d-flex flex-nowrap w-100">
                            <h4>Buku</h4>
                            <button type="button" id="btn-add-book" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-auto">
                                <i class="fas fa-plus fa-sm text-white-50"></i> 
                                Tambah Buku
                            </button>
                        </div>
                        <table id="book-form" class="table table-sm w-100">
                            <thead class="bg-primary text-white d-none d-lg-table-head">
                                <tr>
                                    <th class="pl-2" style="width: 40%">Judul <span class="text-danger">*</span></th>
                                    <th class="pl-2">Jumlah <span class="text-danger">*</span></th>
                                    <th class="pl-2">Tgl Kembali <span class="text-danger">*</span></th>
                                    <th class="pl-2">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="d-flex flex-column d-lg-table-row">
                                    <td class="d-inline-block d-lg-table-cell">
                                        <label class="d-lg-none mb-0">Judul</label>
                                        <select class="form-control <?php if(!empty($_SESSION['error']['errors']['book[0][title]'])):?> is-invalid <?php endif ?>" name="book[0][title]" value="<?=$_SESSION['error']['old']['book'][0]['title'] ?? NULL ?>"></select>
										<?php if(!empty($_SESSION['error']['errors']['book[0][title]'])): ?>
											<small class="text-danger"><?=$_SESSION['error']['errors']['book[0][title]']?></small>
										<?php endif ?>
                                    </td>
                                    <td class="d-inline-block d-lg-table-cell">
                                        <label class="d-lg-none mb-0">Jumlah</label>
                                        <input type="number" min="0" class="form-control <?php if(!empty($_SESSION['error']['errors']['book[0][qty]'])):?> is-invalid <?php endif ?>" name="book[0][qty]" value="<?=$_SESSION['error']['old']['book'][0]['qty'] ?? NULL ?>">
										<?php if(!empty($_SESSION['error']['errors']['book[0][qty]'])): ?>
											<small class="text-danger"><?=$_SESSION['error']['errors']['book[0][qty]']?></small>
										<?php endif ?>
                                    </td>
                                    <td class="d-inline-block d-lg-table-cell">
                                        <label class="d-lg-none mb-0">Tgl Pengembalian</label>
                                        <input type="date" class="form-control <?php if(!empty($_SESSION['error']['errors']['book[0][return_date]'])): ?> is-invalid <?php endif ?>" name="book[0][return_date]" value="<?=$_SESSION['error']['old']['book'][0]['return_date'] ?? NULL ?>">
										<?php if(!empty($_SESSION['error']['errors']['book[0][return_date]'])): ?>
											<small class="text-danger"><?=$_SESSION['error']['errors']['book[0][return_date]']?></small>
										<?php endif ?>
                                    </td>
                                    <td class="d-inline-block d-lg-table-cell">
                                    </td>
                                </tr>
								<!-- more errors -->
								<?php 
									if(isset($_SESSION['error']['old']['book']) && count($_SESSION['error']['old']['book']) > 1): 
										foreach($_SESSION['error']['old']['book'] as $key => $value):
											if($key === 0) continue;
								?>
								<tr class="d-flex flex-column d-lg-table-row">
                                    <td class="d-inline-block d-lg-table-cell">
                                        <label class="d-lg-none mb-0">Judul</label>
                                        <select class="form-control book-title <?php if(!empty($_SESSION['error']['errors']['book['.$key.'][title]'])):?> is-invalid <?php endif ?>" name="book[<?=$key?>][title]" value="<?=$_SESSION['error']['old']['book'][$key]['title'] ?? NULL ?>"></select>
										<?php if(!empty($_SESSION['error']['errors']['book['.$key.'][title]'])): ?>
											<small class="text-danger"><?=$_SESSION['error']['errors']['book['.$key.'][title]']?></small>
										<?php endif ?>
                                    </td>
                                    <td class="d-inline-block d-lg-table-cell">
                                        <label class="d-lg-none mb-0">Jumlah</label>
                                        <input type="number" min="0" class="form-control <?php if(!empty($_SESSION['error']['errors']['book['.$key.'][qty]'])):?> is-invalid <?php endif ?>" name="book[<?=$key?>][qty]" value="<?=$_SESSION['error']['old']['book'][$key]['qty'] ?? NULL ?>">
										<?php if(!empty($_SESSION['error']['errors']['book['.$key.'][qty]'])): ?>
											<small class="text-danger"><?=$_SESSION['error']['errors']['book['.$key.'][qty]']?></small>
										<?php endif ?>
                                    </td>
                                    <td class="d-inline-block d-lg-table-cell">
                                        <label class="d-lg-none mb-0">Tgl Pengembalian</label>
                                        <input type="date" class="form-control <?php if(!empty($_SESSION['error']['errors']['book['.$key.'][return_date]'])): ?> is-invalid <?php endif ?>" name="book[<?=$key?>][return_date]" value="<?=$_SESSION['error']['old']['book'][$key]['return_date'] ?? NULL ?>">
										<?php if(!empty($_SESSION['error']['errors']['book['.$key.'][return_date]'])): ?>
											<small class="text-danger"><?=$_SESSION['error']['errors']['book['.$key.'][return_date]']?></small>
										<?php endif ?>
                                    </td>
                                    <td class="d-inline-block d-lg-table-cell">
										<button class="btn-circle btn-danger rounded-circle border-0 delete_data" type="button" onclick="deleteRow(event)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
								<?php 
										endforeach;
									endif; 
								?>
								<!-- end more errors -->
                            </tbody>
                        </table>
                   </fieldset>
                  
                </form>
            </div>

        </div>
    </div>
</div>



<?php $this->stop() ?>

<!-- JS SECTION -->
<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/js/selectize.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>

<script src="<?=$this->e(base_url('assets/js/pages/bookOrder.js'))?>"></script>

<?php $this->stop() ?>
