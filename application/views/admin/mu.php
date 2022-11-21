<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="group-row card-header py-3">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">List Account</h6>
            </div>
            <div class="float-right">
                <button class="btn btn-primary font-weight-bold dropdown-button" type="button" href="#" data-toggle="modal" data-target="#logoutModal2">
                    + Account
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Time Created</th>
                            <th>Edit</th>
                            <th>Delete </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        foreach ($user2 as $u) :
                        ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $u['user_name']; ?></td>
                                <td><?= $u['nama_role']; ?></td>
                                <td><?= $u['password']; ?></td>
                                <td><?= date("d M Y", strtotime($u['time_created'])); ?></td>
                                <td><a class="" href="<?= base_url('admin/edit_user/') . $u['id']; ?>"><i class="fas fa-fw fa-edit text-primary dropdown-item"></i></a></td>
                                <td><a class="" href="<?= base_url('admin/hapus/akun/') . $u['id']; ?>" onclick="return confirm('yakin?');"><i class="fas fa-fw fa-trash text-danger"></i></a></td>
                            </tr>
                        <?php $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Creat Modal-->
<div class="modal fade" id="logoutModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="post" action="<?= base_url('admin/register'); ?>">
                <div class="form-group mx-3 mt-3">
                    <input type="username" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <label class="h6 text-gray-900 mx-2" for="exampleFormControlSelect1">Select role :</label>
                <div class="radio container">

                    <input class="form-check-input mx-2" type="radio" name="role" id="role" value="1">
                    <label class="form-check-label col-sm-2 mx-3">Admin</label>

                    <input class="form-check-input" type="radio" name="role" id="role" value="2">
                    <label class="form-check-label col-sm-3">Supervisor</label>

                    <input class="form-check-input" type="radio" name="role" id="role" value="3">
                    <label class="form-check-label col-sm-2">User</label>

                    <input class="form-check-input" type="radio" name="role" id="role" value="4">
                    <label class="form-check-label">Engineer</label>

                </div>
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0 mx-auto">
                        <input type="password" class="form-control form-control-user" id="pwd1" name="pwd1" placeholder="Password">
                        <?= form_error('pwd1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-sm-5 mx-auto">
                        <input type="password" class="form-control form-control-user" id="pwd2" name="pwd2" placeholder="Repeat Password">
                    </div>
                </div>
                <div class="mx-3 ">
                    <button class="btn btn-primary mb-3 " type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>