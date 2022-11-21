<?= $this->session->flashdata('message'); ?>

<div class="row">
    <div class="card mx-4" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item" style="background-color: lightgrey;">Total Item : <?= $item; ?></li>
            <li class="list-group-item">Item Kertas : <?= $kertas; ?></li>
            <li class="list-group-item" style="background-color: lightgrey;">Item LEM : <?= $lem; ?></li>
        </ul>
    </div>

    <div class="col-3 mt-4 mx-3 mb-2 ">
        <button type="submit" data-toggle="modal" data-target="#tambahModal" class="btn btn-warning btn-lg" style="box-shadow:5px 5px slategray;">
            <i class="fa-solid fa-4x fa-bars-progress"></i><br><br>
            <span class="text">
                Aktivasi Item +
            </span>
        </button>
    </div>
    <div class="col-3 mt-4 mb-2 ">
        <form action="<?= base_url('user/tambahproduk') ?>" method="post">
            <button type="submit" class="btn btn-primary btn-lg" style="box-shadow:5px 5px slategray;">
                <i class="fa-solid fa-4x fa-qrcode"></i><br>
                <input type="text" class="form-control form-control-user mt-2" name="code_item" id="" autofocus>
                <span class="text">
                    Scan Produk jadi
                </span>
            </button>
        </form>
    </div>
</div>
<div class="container-fluid mt-5">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">List Warehouse</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="float-right d-sm-flex align-items-center ">
                <form method="post" action="<?= base_url('user/warehouse'); ?>">
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
                            <th scope="col">#</th>
                            <th scope="col">Code Item</th>
                            <th scope="col">Item</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Code PO</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">length</th>
                            <th scope="col">weigth</th>
                            <th scope="col">QRCode</th>
                            <th scope="col">Date</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        ?>
                        <?php foreach ($active as $a) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><a href="<?= base_url('tracking/item/') . $a['code_item']; ?>"><?= $a['code_item']; ?></a></td>
                                <td><?= $a['jenis_barang']; ?></td>
                                <td><?= $a['tipe']; ?></td>
                                <td><?= $a['code_po']; ?></td>
                                <td><?= $a['supplier']; ?></td>
                                <td><?= $a['panjang']; ?></td>
                                <td><?= $a['berat']; ?></td>
                                <td><a href="<?= base_url('tracking/item/') . $a['code_item']; ?>" target="_blank"><img class="img-responsive" height="50" width="50" src="<?= base_url('assets/img/qrcode/') . $a['qrcode']; ?>"></a></td>
                                <td><?= date("d M Y", strtotime($a['tanggal_aktivasi'])); ?></td>
                            </tr>
                            <?php $i++
                            ?>
                        <?php endforeach;
                        ?>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- FORM TAMBAH -->
            <form class="user mx-2" method="post" action="<?= base_url('user/tambah_item'); ?>">
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-5">
                        <label class="col-form-label">SCAN Code Item</label>
                        <label class="col-form-label float-right">:</label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" class="form-control form-control-user" id="code_item" name="code_item" placeholder="Masukan Code Item" autofocus>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-5">
                        <label class="col-form-label">Berat Kertas</label>
                        <label class="col-form-label float-right">:</label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="number" class="form-control form-control-user" min="0" id="berat" name="berat" placeholder="Masukan Berat Kertas">
                    </div>
                </div>
                <div class="modal-body">Pilih "Tambah" untuk menambahkan Item ke Warehouse.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- END OF TAMBAH Modal-->
</div>