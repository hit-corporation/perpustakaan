<?php $this->layout('layouts::main_template', ['title' => 'Books'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>

<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="table-reponsive">
                    <table class="table table-sm">
                        <thead class="bg-primary text-white">

                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modal-input" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
               
            </div>
            <form class="modal-body">
                <fieldset class="row">
                    <div class="col-12 col-lg-8">
                        <div class="form-group">
                            <label>Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="book-title">
                        </div>
                        <div class="form-group">
                            <label>Kategori Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="book-title">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4"></div>
                </fieldset>
                <fieldset class="row">
                    <div class="col-12">

                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>

<?php $this->stop() ?>