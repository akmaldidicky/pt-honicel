<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mesin Siku</h1>

    <form action="">
        <div class="form-group row mx-2">
            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. WO</label>
            <div class="col-4">
                <input type="text" class="form-control form-control-user" placeholder="Scan QR Code WO">
            </div>
            <div class="col-4">
                <button class=" btn btn-success" type="submit">Pilih</button>
            </div>
        </div>
    </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <form>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. WO</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">Oprator</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormDateInput" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Bahan 1</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Bahan 2</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Bahan 3</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="box-footer row">
                            <div class="form-group text-left col-lg-6">
                                <a href="<?= base_url('user/mesin_siku');?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
                            </div>
                            <div class="form-group text-right col-lg-6">
                                <a class="submit" href="#" data-toggle="modal" data-target="#konfirmasiModal">
                                    <p class="btn btn-success">Konfirmasi</p>
                                </a>
                            </div>
                        </div>
                    </form>
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