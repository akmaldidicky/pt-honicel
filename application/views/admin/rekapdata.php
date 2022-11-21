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
                            <th>Absensi</th>
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
                                <td><a class="" href="<?= base_url('admin/printabsen/') . $u['id']; ?>"><img height="40" width="40" src="<?= base_url('assets/img/sign/print.png'); ?>"></a></td>
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


</div>