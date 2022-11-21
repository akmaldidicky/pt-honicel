<!-- Basic Card Example -->
<th scope="col"></th>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit MRD Laminating</h6>
    </div>
    <div class="card-body">
        <div class="col "><?php foreach ($mrd_l as $l) : ?>
                <form class="user mx-2" method="post" action="<?= base_url('engineer/edit_mrd_l/') . $l['id']; ?>">


                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">item_code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="item_code" class="form-control form-control-user" name="item_code" value="<?= $l['item_code']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">tebal &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="tebal" class="form-control form-control-user" name="tebal" value="<?= $l['tebal']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">cell_size &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="cell_size" class="form-control form-control-user" name="cell_size" value="<?= $l['cell_size']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">panjang &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="panjang" class="form-control form-control-user" name="panjang" value="<?= $l['panjang']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">lebar &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="lebar" class="form-control form-control-user" name="lebar" value="<?= $l['lebar']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">board/pallet &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="board/pallet" class="form-control form-control-user" name="board/pallet" value="<?= $l['board/pallet']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">waktu &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="waktu" class="form-control form-control-user" name="waktu" value="<?= $l['waktu']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">menit &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="menit" class="form-control form-control-user" name="menit" value="<?= $l['menit']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">min/board &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="min/board" class="form-control form-control-user" name="min/board" value="<?= $l['min/board']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">speed &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="speed" class="form-control form-control-user" name="speed" value="<?= $l['speed']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">weight/pallet &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="weight/pallet" class="form-control form-control-user" name="weight/pallet" value="<?= $l['weight/pallet']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">kg/board &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="kg/board" class="form-control form-control-user" name="kg/board" value="<?= $l['kg/board']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">pulling_std &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="pulling_std" class="form-control form-control-user" name="pulling_std" value="<?= $l['pulling_std']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan device.</div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" href="<?= base_url('engineer/mrd_l') ?>">Back</a>
                        <button class=" btn btn-success" type="submit">Update</button>
                    </div>
                <?php endforeach; ?>
                </form>
        </div>
    </div>
</div>

</div>
<!-- End Basic Card Example -->