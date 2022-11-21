<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Shortcut -->
    <div class="row my-4">

        <div class="col-lg-3">
            <a href="<?= base_url('admin/pok'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-file"></i><br>
                <span class="text">
                    + PO Paper
                </span>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="<?= base_url('admin/pol'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-screwdriver-wrench"></i><br>
                <span class="text">
                    + PO Glue
                </span>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="<?= base_url('admin/wo'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-angles-right"></i><br>
                <span class="text">
                    Work Order
                </span>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="<?= base_url('admin/suratjalan'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-truck-fast"></i><br>
                <span class="text">
                    Delivery Order
                </span>
            </a>
        </div>

    </div>
    <div class="row mt-4 mb-4">
        <p></p>
    </div>
    <div class="row my-4">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-3">
            <a href="<?= base_url('admin/customer'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-person-circle-plus"></i><br>
                <span class="text">
                    + Customer
                </span>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="<?= base_url('admin/warehouse'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-4x fa-warehouse"></i><br>
                <span class="text">
                    Warehouse
                </span>
            </a>
        </div>
    </div>

</div>
</div>
<!-- /.container-fluid -->