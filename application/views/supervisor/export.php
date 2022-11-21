<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Print Daily Production</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body row justify-content-center">
            <!-- Nested Row within Card Body -->
            <div class="row mx-2 my-4">
                <div class="col-lg-4">
                    <a href="<?= base_url('supervisor/oee_eck'); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-4x fa-print"></i><br>
                        <span class="text">
                            Export Data Honeycomb
                        </span>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="<?= base_url('supervisor/oee_lam'); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-4x fa-print"></i><br>
                        <span class="text">
                            Export Data Laminating
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- /.container-fluid -->