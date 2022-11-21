<div class="mx-3">
    <?= $this->session->flashdata('message'); ?>
</div>
<div class="container-fluid row col-14">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <!-- <div class="card shadow mb-4 col-6" style="background-color: greenyellow;">
        <h3>Silahkan Absen dengan melakukan Scan QRCode!</h3>
    </div> -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-dark">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="text-align: center;">
                        <i class="fa fa-filter fa-2x text-black-300 float-right"></i>
                        <h3>
                            Absen <?= $form; ?>
                        </h3>
                    </div>
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form method="post" action="<?= base_url('admin/absen_masuk'); ?>">
                        <div class="row align-items-center mb-2">
                            <div class="col-6 align-middle">
                                <input type="text" placeholder="SCAN QRCode" class="form-control form-control-user" name="id_karyawan" id="id_karyawan" autofocus>
                                <?= form_error('id_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <input type="hidden" value="1" class="form-control form-control-user" name="kode" id="kode">
                            <div class="col-6 align-middle">
                                <h2 class="text-break">Silahkan Absen dengan melakukan Scan QRCode Anda!</h2>
                                <i class="fas fa-5x fa-user-check"></i><br>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg"> ENTER </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>



<!-- /.container-fluid -->