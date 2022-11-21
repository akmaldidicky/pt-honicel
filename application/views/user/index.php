<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Shortcut -->
    <div class="row">

        <div class="col-lg-3">
            <a href="<?= base_url('user/warehouse'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-warehouse"></i><br>
                <span class="text">
                    Warehouse
                </span>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="<?= base_url('user/mesin_siku'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-screwdriver-wrench"></i><br>
                <span class="text">
                    Mesin Siku
                </span>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="<?= base_url('user/mesin_lam'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-screwdriver-wrench"></i><br>
                <span class="text">
                    Laminating
                </span>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="<?= base_url('user/mesin_eck'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-screwdriver-wrench"></i><br>
                <span class="text">
                    Mesin ECK
                </span>
            </a>
        </div>

    </div>

</div>
</div>
<!-- /.container-fluid -->