<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
    </div>
    <div class="card-body">
        <div class="col "><?php foreach ($menu as $m) : ?>
                <form class="user mx-2" method="post" action="<?= base_url('engineer/edit_menu/') . $m['id']; ?>">


                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Menu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <select name="nama_menu" id="nama_menu" class="form-control mx-2">
                                    <?php foreach ($menu2 as $m2) : ?>
                                        <option value="<?= $m2['id']; ?>"><?= $m2['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="title" class="form-control form-control-user" name="title" value="<?= $m['title']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Url &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="url" class="form-control form-control-user" name="url" value="<?= $m['url']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Icon &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="icon" class="form-control form-control-user" name="icon" value="<?= $m['icon']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Activ &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <select class="form-control" name="active" id="active">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan device.</div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" href="<?= base_url('engineer/menu') ?>">Back</a>
                        <button class=" btn btn-success" type="submit">Update</button>
                    </div>
                <?php endforeach; ?>
                </form>
        </div>
    </div>
</div>

</div>
<!-- End Basic Card Example -->