<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="group-row card-header py-3">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">List Karyawan</h6>
            </div>
            <div class="float-right">
                <button class="btn btn-primary font-weight-bold dropdown-button" type="button" href="#" data-toggle="modal" data-target="#logoutModal2">
                    + Karyawan
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>QRCode</th>
                            <!-- <th>Edit</th> -->
                            <th>Delete </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        ?>
                        <?php foreach ($krywn as $u) :
                        ?>

                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $u['nama_karyawan']; ?></td>
                                <td><?= $u['jabatan']; ?></td>
                                <td class="qrcode"><a target="_blank" href="<?= base_url('admin/pdfkrywn/') . $u['id_karyawan']; ?>"><img src="<?= base_url('assets/img/qrcode/krywn/') . $u['qrcode']; ?>" height="50" width="50"></a></td>
                                <!-- <td><a class="fas fa-fw fa-edit text-primary dropdown-item" href="<?= base_url('admin/edit_user/') . $u['id']; ?>"></a></td> -->
                                <td><a class="" href="<?= base_url('admin/hapus/krywn/') . $u['id']; ?>" onclick="return confirm('yakin?');"><i class="fas fa-fw fa-trash text-danger"></i></a></td>
                            </tr>
                            <?php $i++
                            ?>
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Creat Modal-->
<div class="modal fade" id="logoutModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="post" action="<?= base_url('admin/tambah_karyawan'); ?>">
                <div class="form-group mx-3 mt-3">
                    <input type="nama" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row mx-3 mt-3">
                    <input type="text" class="form-control form-control-user" id="jabatan" name="jabatan" placeholder="Jabatan">
                    <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mx-3 ">
                    <button class="btn btn-primary mb-3 mx-1 " type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>