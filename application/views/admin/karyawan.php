<!-- Begin Page Content -->
<h1 class="h3 mb-2 text-gray-800 mx-3">Karyawan</h1>
<?= $this->session->flashdata('message'); ?>
<div class="container-fluid row col-12">

    <!-- Page Heading -->
    <!-- DataTales Example -->

    <!-- Nested Row within Card Body -->
    <a href="<?= base_url('admin/listkrywn'); ?>">
        <div class="col-3 mt-4 mb-2 ">
            <button type="submit" class="btn btn-success btn-lg" style="box-shadow:5px 5px slategray;">
                <i class="fas fa-4x fa-warehouse"></i><br>
                <span class="text">
                    Daftar Karyawan
                </span>
            </button>

        </div>
    </a>
</div>
<div class="col-3 mt-4 mb-2 mx-5">
    <a href="<?= base_url('admin/rekapdata'); ?>">
        <button type="submit" class="btn btn-danger btn-lg" style="box-shadow:5px 5px slategray;">
            <i class="fas fa-4x fa-warehouse"></i><br>
            <span class="text-break">
                Rekap Data
            </span>
        </button>
    </a>
</div>
</div>
</div>


<!-- /.container-fluid -->