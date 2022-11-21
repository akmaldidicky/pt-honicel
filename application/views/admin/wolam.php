<?= $this->session->flashdata('message2'); ?>
<div class="col-12 mx-5 ">


    <form action="<?= base_url('admin/wolam'); ?>" method="post">
        <div class="row">
            <div class="col-sm-3">

                <label for="">Mesin</label>

            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" name="mesin">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">

                <label for="">Nomor PO</label>

            </div>
            <div class="col-sm-3" class="form-control form-control-user">
                <input type="text" class="form-control form-control-user" name="po">
                <?= form_error('po', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="date1">Tanggal </label>
            </div>
            <div class="col-sm-3">
                <select class="form-control mr-2" name="tanggal">
                    <option value="">-</option>
                    <?php $x = 31;
                    for ($i = 1; $i <= $x; $i++) { ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="date1">Bulan </label>
            </div>
            <div class="col-sm-3">
                <select class="form-control mr-2" name="bulan">
                    <option value="">-</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 ">
                <label for="date1">Tahun </label>
            </div>
            <div class="col-sm-3 ">
                <select name="tahun" class="form-control mr-2">
                    <?php
                    $cek = 2000;
                    $mulai = date('Y') - 1;
                    for ($i = $mulai; $i < $mulai + 100; $i++) {
                        // $sel = $i == date('Y') ? ' selected="selected"' : '';
                        $cek = $i - 2000;
                        echo '<option value="' . $cek  . '"' . $sel . '>' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">customer</label>

            </div>
            <div class="col-sm-3">
                <select class="form-control form-control-user" name="customer" id="">
                    <option value=""></option>
                    <?php foreach ($customer as $c) : ?>
                        <option value="<?= $c['nama_customer'] ?>"><?= $c['nama_customer'] ?></option>
                        <?= form_error('customer', '<small class="text-danger pl-3">', '</small>'); ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">TOP Layer </label>
            </div>
            <div class="col-sm-3">
                <!-- <input class="form-control form-control-user" type="text" name="spec"> -->
                <select class="form-control form-control-user" name="top_layer" id="">
                    <option value=""></option>
                    <?php foreach ($bahan as $art) : ?>
                        <option value="<?= $art['code'] ?>"><?= $art['tipe_item'] ?></option>
                        <?= form_error('top_layer', '<small class="text-danger pl-3">', '</small>'); ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">Cell Size (mm) </label>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" name="cell_size">
                <?= form_error('cell_size', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">Paper Width (mm) </label>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" name="lebar_kertas">
                <?= form_error('lebar_kertas', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">Thickness (mm) </label>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" name="tebal_kertas">
                <?= form_error('tebal_kertas', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">Board Size (cm) </label>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" name="panjang" placeholder="Panjang">
                <?= form_error('panjang', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" name="lebar" placeholder="lebar">
                <?= form_error('lebar', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for="">Quantity</label>
            </div>
            <div class="col-sm-3">
                <input type="number" class="form-control form-control-user" name="qty">
                <?= form_error('qty', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary float-right" type="submit"> Enter </button>

            </div>
        </div>
    </form>
</div>
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
        <div class="float-left">
            <h6 class="m-0 font-weight-bold text-primary">List Purchase Order</h6>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code WO</th>
                        <th>Customer</th>
                        <th>Article#</th>
                        <th>QRCode</th>
                        <th>Action</th>
                        <th>Tanggal</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($wo as $w) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $w['code_wo']; ?></td>
                            <td><?= $w['customer']; ?></td>
                            <td><?= $w['article']; ?></td>
                            <td><a href="<?= base_url('admin/wopdfl/') . $w['code_wo']; ?>" target="_blank"><img height="50" width="50" src="<?= base_url('assets/img/qrcode/wo_lam/') . $w['qrcode']; ?>"></a></td>
                            <td>
                                <a href="<?= base_url('admin/wopdfl/') . $w['code_wo']; ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/img/sign/print.png'); ?>"></a>
                            </td>
                            <td> <?= date("d M Y", strtotime($w['created_at'])); ?></td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>