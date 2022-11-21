<!-- Basic Card Example -->
<th scope="col"></th>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit MRD Laminating</h6>
    </div>
    <div class="card-body">
        <div class="col "><?php foreach ($mrd_eck as $e) : ?>
                <form class="user mx-2" method="post" action="<?= base_url('engineer/edit_mrd_eck/') . $e['id']; ?>">

                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">item_code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="item_code" class="form-control form-control-user" name="item_code" value="<?= $e['item_code']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">cell_size &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="cell_size" class="form-control form-control-user" name="cell_size" value="<?= $e['cell_size']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">width &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="width" class="form-control form-control-user" name="width" value="<?= $e['width']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">tebal &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="tebal" class="form-control form-control-user" name="tebal" value="<?= $e['tebal']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">layer/pallet &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="layer/pallet" class="form-control form-control-user" name="layer/pallet" value="<?= $e['layer/pallet']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">durasi &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="durasi" class="form-control form-control-user" name="durasi" value="<?= $e['durasi']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">menit &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="menit" class="form-control form-control-user" name="menit" value="<?= $e['menit']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">min/layer &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="min/layer" class="form-control form-control-user" name="min/layer" value="<?= $e['min/layer']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">speed &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="speed" class="form-control form-control-user" name="speed" value="<?= $e['speed']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">total_weight &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="total_weight" class="form-control form-control-user" name="total_weight" value="<?= $e['total_weight']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">kg/later &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="kg/layer" class="form-control form-control-user" name="kg/layer" value="<?= $e['kg/layer']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan device.</div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" href="<?= base_url('engineer/mrd_eck') ?>">Back</a>
                        <button class=" btn btn-success" type="submit">Update</button>
                    </div>
                <?php endforeach; ?>
                </form>
        </div>
    </div>
</div>

</div>
<!-- End Basic Card Example -->