<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mesin ECK</h1>

    <div class="col-lg">
        <form action="<?= base_url('user/lapeck_awal'); ?>" method="post">
            <div class="form-group row">
                <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. WO</label>
                <div class="col-4">
                    <input type="text" name="nowo" class="form-control form-control-user" placeholder="Scan QR Code WO">
                </div>
                <div class="col-4">
                    <button class=" btn btn-success" type="submit">Pilih</button>
                </div>
            </div>
        </form>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <form action="<?= base_url('user/lapeck_awal'); ?>" method="post">
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. WO</label>
                            <?php foreach ($isi as $i) : ?>
                                <div class="col-sm-10">
                                    <input type="text" name="no_wo" class="form-control form-control-user" value="<?= $i['code_wo']; ?>" readonly>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">Oprator</label>
                            <div class="col-sm-10">
                                <input type="text" name="operator" class="form-control form-control-user" placeholder="Ketik nama operator">
                                <?= form_error('operator', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="tanggal" class="form-control form-control-user" placeholder="Ketik nama operator">
                                <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 1</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 2</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 3</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 4</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 5</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 6</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 7</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Kertas 8</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan[]" class="form-control form-control-user" placeholder="SCAN QR Code Bahan">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">LEM</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="lem" class="form-control form-control-user" placeholder="SCAN QR Code LEM">
                                    </div>
                                    <?= form_error('bahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">gsm</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="gsm" class="form-control form-control-user" placeholder="Masukan gsm kertas">
                                    </div>
                                    <?= form_error('gsm', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-8">
                                        <input type="hidden" name="code" class="form-control form-control-user" value="1">
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="box-footer row">
                            <div class="form-group text-left col-lg-6">
                                <a href="/user/mesin_eck" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
                            </div>
                            <div class="form-group text-right col-lg-6">
                                <button class=" btn btn-success float-right" type="submit">Konfirmasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- /.container-fluid -->

<!-- Konfirmasi Modal-->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body mx-auto mt-4 mb-4">Work Oreder telah dikonfirmasi</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>