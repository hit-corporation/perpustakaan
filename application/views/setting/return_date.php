<?php $this->layout('setting::index', ['title' => 'Pengaturan']) ?>


<?php $this->start('setting_pages') ?>
<div class="row justify-content-center mt-4">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-white font-weight-bold text-shadow">Jatuh Tempo Pengembalian</h4>
            </div>
            <form class="card-body">
                <div class="form-row">
                    <label class="form-label col-6">Tanggal Jatuh Tempo</label>
                    <div class="col-6">
                        <input type="date" class="form-control form-control-sm" />
                    </div>
                </div>    
            </form>
        </div>

    </div>
</div>
<?php $this->stop() ?>