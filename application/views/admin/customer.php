<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">customer</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="group-row card-header py-3">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">List customer</h6>
            </div>
            <div class="float-right">
                <button class="btn btn-primary font-weight-bold dropdown-button" type="button" href="#" data-toggle="modal" data-target="#createModal">
                    + Customer
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-lg-4">Name</th>
                            <th class="col-lg-2">ID</th>
                            <th class="col-lg-4">Addres</th>
                            <!-- <th class="col-lg-1">Edit</th> -->
                            <th class="col-lg-1">Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer as $c) : ?>
                            <tr>
                                <td><?= $c['id']; ?></td>
                                <td><?= $c['nama_customer']; ?></td>
                                <td><?= $c['alamat']; ?></td>
                                <!-- <td align="center"><a class="fas fa-fw fa-edit text-primary" href=# data-toggle="modal" data-target="#editModal"></a></td> -->
                                <td align="center"><a href="<?= base_url('admin/hapus/cst/') . $c['id']; ?>" onclick="return confirm('yakin?');"><i class="fas fa-fw fa-trash text-danger"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer row">
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Create Modal-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/tambah_cst'); ?>">
                <div class="form-group mx-2 mt-2">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <!-- <div class="form-group mx-2 mt-2">
                    <input type="text" class="form-control form-control-user" id="code" name="code" placeholder="ID">
                </div> -->
                <div class="form-group mx-2">
                    <input type="text" class="form-control form-control-user" id="addres" name="addres" placeholder="Addres">
                    <?= form_error('addres', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mx-auto">
                    <button class="btn btn-primary mb-3" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user">
                <div class="form-group mx-2 mt-2">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group mx-2 mt-2">
                    <input type="text" class="form-control form-control-user" id="id" name="id" placeholder="ID">
                </div>
                <div class="form-group mx-2">
                    <input type="text" class="form-control form-control-user" id="addres" name="addres" placeholder="Addres">
                </div>
            </form>
            <div class="mx-auto">
                <button class="btn btn-primary mb-3" type="button" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div>
                <p class="mt-3 mb-3" align="center">Customer will be deleted</p>
            </div>
            <div class="modal-footer mx-auto">
                <button class="btn btn-primary mb-3" type="button" data-dismiss="modal">OK</button>
                <button class="btn btn-secondary mb-3" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>