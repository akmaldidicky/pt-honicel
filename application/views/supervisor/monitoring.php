<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-header font-weight-bold text-primary text-uppercase mb-1" align="center">ECK
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-1" align="center">Overal
                            </div>
                            <div class="no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="table">
                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                            <thead>
                                                <?php foreach ($all as $a) : ?>
                                                    <tr>
                                                        <th>Ava (<?= ceil($a['ava'] * 100); ?>%)</th>
                                                        <th>PE (<?= ceil($a['pe'] * 100); ?>%)</th>
                                                        <th>Yield (<?= ceil($a['yield'] * 100); ?>%)</th>
                                                        <th>OEE (<?= ceil($a['oee'] * 100); ?>%)</th>
                                                    </tr>
                                                <?php $ava = ceil($a['ava'] * 100);
                                                    $pe = ceil($a['pe'] * 100);
                                                    $y = ceil($a['yield'] * 100);
                                                    $oee = ceil($a['oee'] * 100);
                                                endforeach; ?>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php if ($ava > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($pe > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($y > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($oee > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-1" align="center">Yesterday
                            </div>
                            <div class="no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="table">
                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                            <thead>
                                                <?php foreach ($old as $o) : ?>
                                                    <tr>
                                                        <th>Ava (<?= ceil($o['ava'] * 100); ?>%)</th>
                                                        <th>PE (<?= ceil($o['pe'] * 100); ?>%)</th>
                                                        <th>Yield (<?= ceil($o['yield'] * 100); ?>%)</th>
                                                        <th>OEE (<?= ceil($o['oee'] * 100); ?>%)</th>
                                                    </tr>
                                                <?php
                                                    $ava = ceil($o['ava'] * 100);
                                                    $pe = ceil($o['pe'] * 100);
                                                    $y = ceil($o['yield'] * 100);
                                                    $oee = ceil($o['oee'] * 100);
                                                endforeach; ?>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php if ($ava > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($pe > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($y > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($oee > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
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

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-header font-weight-bold text-primary text-uppercase mb-1" align="center">Laminating
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-1" align="center">Overal
                            </div>
                            <div class="no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="table">
                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                            <thead>
                                                <?php foreach ($alll as $a) : ?>
                                                    <tr>
                                                        <th>Ava (<?= ceil($a['ava'] * 100); ?>%)</th>
                                                        <th>PE (<?= ceil($a['pe'] * 100); ?>%)</th>
                                                        <th>Yield (<?= ceil($a['yield'] * 100); ?>%)</th>
                                                        <th>OEE (<?= ceil($a['oee'] * 100); ?>%)</th>
                                                    </tr>
                                                <?php $ava = ceil($a['ava'] * 100);
                                                    $pe = ceil($a['pe'] * 100);
                                                    $y = ceil($a['yield'] * 100);
                                                    $oee = ceil($a['oee'] * 100);
                                                endforeach; ?>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php if ($ava > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($pe > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($y > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                    <?php if ($oee > 90) { ?>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <?php } else { ?>
                                                        <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-sm font-weight-bold text-info text-uppercase mb-1" align="center">Yesterday
                                </div>
                                <div class="no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="table">
                                            <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                                <thead>
                                                    <?php foreach ($oldl as $o) : ?>
                                                        <tr>
                                                            <th>Ava (<?= ceil($o['ava'] * 100); ?>%)</th>
                                                            <th>PE (<?= ceil($o['pe'] * 100); ?>%)</th>
                                                            <th>Yield (<?= ceil($o['yield'] * 100); ?>%)</th>
                                                            <th>OEE (<?= ceil($o['oee'] * 100); ?>%)</th>
                                                        </tr>
                                                    <?php
                                                        $ava = ceil($o['ava'] * 100);
                                                        $pe = ceil($o['pe'] * 100);
                                                        $y = ceil($o['yield'] * 100);
                                                        $oee = ceil($o['oee'] * 100);
                                                    endforeach; ?>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php if ($ava > 90) { ?>
                                                            <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <?php } else { ?>
                                                            <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                        <?php } ?>
                                                        <?php if ($pe > 90) { ?>
                                                            <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <?php } else { ?>
                                                            <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                        <?php } ?>
                                                        <?php if ($y > 90) { ?>
                                                            <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <?php } else { ?>
                                                            <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                        <?php } ?>
                                                        <?php if ($oee > 90) { ?>
                                                            <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <?php } else { ?>
                                                            <td><img src="assets/img/sign/no.gif" width="50px" alt=""></td>
                                                        <?php } ?>
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

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-header font-weight-bold text-primary text-uppercase mb-1" align="center">Siku
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-1" align="center">Overal
                            </div>
                            <div class="no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="table">
                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Ava (90%)</th>
                                                    <th>PE (95%)</th>
                                                    <th>Yield (99%)</th>
                                                    <th>OEE (85%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                    <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-sm font-weight-bold text-info text-uppercase mb-1" align="center">Yesterday
                                </div>
                                <div class="no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="table">
                                            <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Ava (90%)</th>
                                                        <th>PE (95%)</th>
                                                        <th>Yield (99%)</th>
                                                        <th>OEE (85%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
                                                        <td><img src="assets/img/sign/yes.gif" width="50px" alt=""></td>
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

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
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
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="table">
                                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="center">Sensor</th>
                                                                    <th align="center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($eck as $v) : ?>
                                                                    <tr>
                                                                        <td><?= $v['mesin']; ?></td>
                                                                        <td><?= $v['status']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
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
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="table">
                                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="center">Sensor</th>
                                                                    <th align="center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($laminating as $v) : ?>
                                                                    <tr>
                                                                        <td><?= $v['mesin']; ?></td>
                                                                        <td><?= $v['status']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
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
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="table">
                                                        <table class="table table-bordered" width="100%" style="text-align: center;" style="vertical-align: middle;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="center">Sensor</th>
                                                                    <th align="center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($siku as $v) : ?>
                                                                    <tr>
                                                                        <td><?= $v['mesin']; ?></td>
                                                                        <td><?= $v['status']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
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

        <div class="col-xl-4 col-lg-5 row">
            <div class="card col-md-12 shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Date Time</h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="table">
                                        <table class="table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>JAM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h4><?= date('d M Y'); ?></h4>
                                                    </td>
                                                    <td>
                                                        <h4><?= date('H:i:s'); ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> <img src=<?= base_url('assets/img/Logo1.png'); ?> alt="PT Honicel Indonesia" class="card-img-top; justify" style="width: 150px">
                                                    </td>
                                                    <td>
                                                        <img src=<?= base_url('assets/img/logo3.png'); ?> alt="PT Honicel Indonesia" class="card-img-top" style="width: 80px">
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col">
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