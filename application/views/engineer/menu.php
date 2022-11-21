<button type="button" class="btn btn-success mb-2  mx-4" data-toggle="modal" data-target="#tambahModal">Tambah Sub Menu +</button>

<?= $this->session->flashdata('message'); ?>
<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Menu</th>
            <th scope="col">Url</th>
            <th scope="col">Icon</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>


    </thead>
    <tbody>
        <?php $i = 1;
        ?>
        <?php foreach ($menu as $m) :
        ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $m['title']; ?></td>
                <td><?= $m['menu']; ?></td>
                <td><?= $m['url']; ?></td>
                <td><?= $m['icon']; ?></td>
                <td><?= $m['is_active']; ?></td>

                <td>
                    <a href="<?= base_url('engineer/edit_menu/') . $m['id'] ?>"><span class=" badge rounded-pill bg-primary text-light">Edit</span></a>
                    <a href="<?= base_url('engineer/hapus_menu/') . $m['id']; ?>"><span class="badge rounded-pill bg-danger text-light" onclick="return confirm('yakin?');">Delete</span></a>
                </td>

            </tr>
            <?php $i++
            ?>
        <?php endforeach;
        ?>
    </tbody>
</table>


<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- FORM TAMBAH -->
            <form class="user mx-2" method="post" action="<?= base_url('engineer/tambah_menu'); ?>">
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <input class="form-control mx-2 mt-2" type="text" id="title" name="title" placeholder="Title Submenu ">
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <select name="nama_menu" id="nama_menu" class="form-control mx-2">
                        <option value="">Select Menu</option>
                        <?php foreach ($menu2 as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <input class="form-control mx-2 mt-2" type="text" id="url" name="url" placeholder="Submenu URL">
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <input class="form-control mx-2 mt-2" type="text" id="icon" name="icon" placeholder="Submenu Icon">
                </div>
                <div class="row g-3 align-items-center mx-1 mb-2">
                    <input type="checkbox" id="active" name="active" value=1>
                    <div class="mx-1">Activ ?</div>
                </div>
                <div class="modal-body">Pilih "Tambah" untuk menambahkan Device.</div>
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