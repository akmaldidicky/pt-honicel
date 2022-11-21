<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->

<div class="float-right mr-5">
    <a class="btn btn-primary font-weight-bold" href="<?= base_url('admin/pok');?>">
        + PO Paper
    </a>
    <a class="btn btn-primary font-weight-bold" href="<?= base_url('admin/pol');?>">
        + PO Glue
    </a>
</div>
<div class="container-fluid mt-5">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Purchase Order</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">List Purchase Order</h6>
            </div>
            <div class="float-right">
                <h6 class="m-0  text-dark">Jumlah Item yang belum masuk warehouse: <?= $active_row; ?></h6>
            </div>
        </div>
        <div class="card-body">
            <div class="float-right d-sm-flex align-items-center">
                <form method="post" action="<?= base_url('admin/po'); ?>">
                    <div class="form-group row my-auto">
                        <div class="col-sm-3">
                            <label for="date1">Tanggal </label>
                            <select class="form-control mr-2" name="tanggal">
                                <option value="">-</option>
                                <?php $x = 31;
                                for ($i = 1; $i <= $x; $i++) { ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="date1">Bulan </label>
                            <select class="form-control mr-2" name="bulan">
                                <option value="">-</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-3 ">
                            <label for="date1">Tahun </label>
                            <select name="tahun" class="form-control mr-2">
                                <option value="">-</option>

                                <?php
                                $mulai = date('Y') - 1;
                                for ($i = $mulai; $i < $mulai + 100; $i++) {
                                    // $sel = $i == date('Y') ? ' selected="selected"' : '';
                                    echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group-append align-items-center">
                            <button class="btn btn-secondary" type="submit">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Item</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>No PO</th>
                            <th>QRCode</th>
                            <th>Tanggal</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        ?>
                        <?php foreach ($active as $a) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $a['code_item']; ?></td>
                                <td><?= $a['jenis_barang']; ?></td>
                                <td><?= $a['tipe']; ?></td>
                                <td><a href="<?= base_url('admin/detailpo/') . $a['code_po']; ?>"><?= $a['code_po']; ?></a></td>
                                <td><a href="<?= base_url('admin/itempdf/') . $a['code_item']; ?>" target="_blank"><img height="50" width="50" src="<?= base_url('assets/img/qrcode/') . $a['qrcode']; ?>"></a></td>
                                <td><?= date("d M Y", strtotime($a['tanggal_po'])); ?></td>

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
</div>
<!-- /.container-fluid -->