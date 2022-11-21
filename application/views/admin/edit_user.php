<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Your Device</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6"><?php foreach ($user2 as $u) : ?>
                <form class="user mx-2" method="post" action="<?= base_url('admin/edit_user/') . $u['id']; ?>">


                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">User Name </label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="username" class="form-control form-control-user" name="username" value="<?= $u['user_name']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Role </label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="role" class="form-control form-control-user" name="role" value="<?= $u['role']; ?>">
                            <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-3">
                            <label class="col-form-label">Password </label>
                            <label class="col-form-label float-right"> :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="pwd1" class="form-control form-control-user" name="pwd1" value="<?= $u['password']; ?>">
                        </div>
                    </div>
                    <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan device.</div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" href="<?= base_url('admin/register') ?>">Back</a>
                        <button class=" btn btn-success" type="submit">Update</button>
                    </div>
                <?php endforeach; ?>
                </form>
        </div>
    </div>

</div>
<!-- End Basic Card Example -->