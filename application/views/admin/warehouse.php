<?= $this->session->flashdata('message'); ?>
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
                            <th scope="col">Type</th>
                            <th scope="col">Code PO</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Wide</th>
                            <th scope="col">length</th>
                            <th scope="col">weigth</th>
                            <th scope="col">QRCode</th>
                            <th scope="col ">Edit/Delete</th>
                            <th scope="col ">Date</th>
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
                                <td><?= $a['lebar']; ?></td>
                                <td><?= $a['panjang']; ?></td>
                                <td><?= $a['berat']; ?></td>
                                <td><a href="<?= base_url('user/itempdf/') . $a['code_item']; ?>" target="_blank"><img height="50" width="50" src="<?= base_url('assets/img/qrcode/') . $a['qrcode']; ?>"></a></td>
                                <td><a class="" href="<?= base_url('admin/edit_warehouse/') . $a['code_item']; ?>"><i class="fas fa-fw fa-edit text-primary dropdown-item"></i></a> <a class="" href="<?= base_url('admin/hapus/warehouse/') . $a['code_item']; ?>" onclick="return confirm('yakin?');"><i class="fas fa-fw fa-trash text-danger dropdown-item"></i></a></td>
                                <td><?= date("d M Y", strtotime($a['tanggal_aktivasi'])); ?></td>

                            </tr>
                            <?php $i++
                            ?>
                        <?php endforeach;
                        ?>
                </table>
            </div>
        </div>
        <div class="box-footer row">
            <div class="form-group text-left col-lg-6">
                <a href="/admin" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
            </div>
        </div>
    </div>

</div>
</div>