<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid mt-5">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">Detail Purchase Order</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No PO</th>
                            <th>Code Item</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>Supplier</th>
                            <th>Panjang</th>
                            <th>Berat</th>
                            <th>Status</th>
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
                                <td><?= $a['code_po']; ?></td>
                                <td><?= $a['code_item']; ?></td>
                                <td><?= $a['jenis_barang']; ?></td>
                                <td><?= $a['tipe']; ?></td>
                                <td><?= $a['supplier']; ?></td>
                                <td><?= $a['panjang']; ?></td>
                                <td><?= $a['berat']; ?></td>
                                <?php if ($a['aktivasi'] == 1) { ?>
                                    <td>Sudah Masuk Warehouse</td>
                                <?php } ?>
                                <?php if ($a['aktivasi'] == 0) { ?>
                                    <td>Belum Masuk Warehouse</td>
                                <?php } ?>
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