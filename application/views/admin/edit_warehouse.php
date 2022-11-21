<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Your Item</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6"><?php foreach ($isi as $u) : ?>
                <form class="user mx-2" method="post" action="<?= base_url('admin/edit_warehouse/') . $u['code_item']; ?>">


                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Code Item</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="code_item" class="form-control form-control-user" name="code_item" value="<?= $u['code_item']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Jenis Barang </label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="jb" class="form-control form-control-user" name="jb" value="<?= $u['jenis_barang']; ?>">
                            <?= form_error('jb', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Tipe</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="tipe" class="form-control form-control-user" name="tipe" value="<?= $u['tipe']; ?>">
                            <?= form_error('tipe', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Nomor PO</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="nopo" class="form-control form-control-user" name="nopo" value="<?= $u['code_po']; ?>">
                            <?= form_error('nopo', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Supplier</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="supplier" class="form-control form-control-user" name="supplier" value="<?= $u['supplier']; ?>">
                            <?= form_error('supplier', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Lebar</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="lebar" class="form-control form-control-user" name="lebar" value="<?= $u['lebar']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Panjang</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="panjang" class="form-control form-control-user" name="panjang" value="<?= $u['panjang']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Berat</label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="berat" class="form-control form-control-user" name="berat" value="<?= $u['berat']; ?>">
                        </div>
                    </div>
                    <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan item.</div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" href="<?= base_url('admin/warehouse') ?>">Back</a>
                        <button class=" btn btn-success" type="submit">Update</button>
                    </div>
                <?php endforeach; ?>
                </form>
        </div>
    </div>

</div>
</div>
<!-- End Basic Card Example -->