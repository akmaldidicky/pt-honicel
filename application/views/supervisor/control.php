<div class="container-fluid">
    <!-- Content Row -->

    <!-- Content Row -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Machine Monitoring</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-head font-weight-bold text-info text-uppercase mb-1" align="center">ECK
                                    <table class="table " width="100%" cellspacing="0" border="0">
                                        <thead>
                                            <tr>
                                                <form action="<?= base_url('supervisor/mqtt'); ?>" method="post">
                                                    <input hidden type="text" name="chip_id" value="6425973">
                                                    <input hidden type="text" name="pesan" value="1">
                                                    <th align="center"><button type="submit" class="btn btn-success mx-3"><i class="fa-solid fa-bell"></i>
                                                            <p>Nyalakan Alarm</p>
                                                        </button></th>
                                                </form>
                                                <form action="<?= base_url('supervisor/mqtt'); ?>" method="post">
                                                    <input hidden type="text" name="chip_id" value="6425973">
                                                    <input hidden type="text" name="pesan" value="0">
                                                    <th align="center"><button type="submit" class="btn btn-danger mx-3"><i class="fa-solid fa-bell"></i>
                                                            <p>Matikan Alarm</p>
                                                        </button></th>
                                                </form>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="table">
                                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="center">Mesin</th>
                                                                    <th align="center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Buzzer</td>
                                                                    <?php foreach ($buzzer as $get => $v) :
                                                                        if ($v['chip_id'] == '6425973') {
                                                                            if ($v['nilai'] == 1) { ?>
                                                                                <td>Hidup</td>
                                                                            <?php } else { ?>
                                                                                <td>Mati</td>
                                                                    <?php }
                                                                        }
                                                                    endforeach; ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-head font-weight-bold text-info text-uppercase mb-1" align="center">Laminating
                                    <table class="table " width="100%" cellspacing="0" border="0">
                                        <thead>
                                            <tr>
                                                <form action="<?= base_url('supervisor/mqtt'); ?>" method="post">
                                                    <input hidden type="text" name="chip_id" value="2462610">
                                                    <input hidden type="text" name="pesan" value="1">
                                                    <th align="center"><button type="submit" class="btn btn-success mx-3"><i class="fa-solid fa-bell"></i>
                                                            <p>Nyalakan Alarm</p>
                                                        </button></th>
                                                </form>
                                                <form action="<?= base_url('supervisor/mqtt'); ?>" method="post">
                                                    <input hidden type="text" name="chip_id" value="2462610">
                                                    <input hidden type="text" name="pesan" value="0">
                                                    <th align="center"><button type="submit" class="btn btn-danger mx-3"><i class="fa-solid fa-bell"></i>
                                                            <p>Matikan Alarm</p>
                                                        </button></th>
                                                </form>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="table">
                                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="center">Mesin</th>
                                                                    <th align="center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Buzzer</td>
                                                                    <?php foreach ($buzzer as $get => $v) :
                                                                        if ($v['chip_id'] == '2462610') {
                                                                            if ($v['nilai'] == 1) { ?>
                                                                                <td>Hidup</td>
                                                                            <?php } else { ?>
                                                                                <td>Mati</td>
                                                                    <?php }
                                                                        }
                                                                    endforeach; ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-head font-weight-bold text-info text-uppercase mb-1" align="center">Siku
                                    <table class="table " width="100%" cellspacing="0" border="0">
                                        <thead>
                                            <tr>
                                                <form action="<?= base_url('supervisor/mqtt'); ?>" method="post">
                                                    <input hidden type="text" name="chip_id" value="5783528">
                                                    <input hidden type="text" name="pesan" value="1">
                                                    <th align="center"><button type="submit" class="btn btn-success mx-3"><i class="fa-solid fa-bell"></i>
                                                            <p>Nyalakan Alarm</p>
                                                        </button></th>
                                                </form>
                                                <form action="<?= base_url('supervisor/mqtt'); ?>" method="post">
                                                    <input hidden type="text" name="chip_id" value="5783528">
                                                    <input hidden type="text" name="pesan" value="0">
                                                    <th align="center"><button type="submit" class="btn btn-danger mx-3"><i class="fa-solid fa-bell"></i>
                                                            <p>Matikan Alarm</p>
                                                        </button></th>
                                                </form>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="table">
                                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="center">Mesin</th>
                                                                    <th align="center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Buzzer</td>
                                                                    <?php foreach ($buzzer as $get => $v) :
                                                                        if ($v['chip_id'] == '5783528') {
                                                                            if ($v['nilai'] == 1) { ?>
                                                                                <td>Hidup</td>
                                                                            <?php } else { ?>
                                                                                <td>Mati</td>
                                                                    <?php }
                                                                        }
                                                                    endforeach; ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
</div>