<button type="button" class="btn btn-success mb-2  mx-4" data-toggle="modal" data-target="#tambahModal">Tambah Device +</button>

<?= $this->session->flashdata('message'); ?>
<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Nama Mesin</th>
            <th scope="col">Chip ID</th>
            <th scope="col">Waktu Daftar</th>
            <th scope="col">Edit</th>


    </thead>
    <tbody>
        <?php $i = 1;
        ?>
        <?php foreach ($device as $d) :
        ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $d['nama_device']; ?></td>
                <td><?= $d['chip_id']; ?></td>
                <td><?= $d['time_created']; ?></td>

                <td>
                    <a href="<?= base_url('engineer/edit_device/') . $d['id'] ?>"><span class=" badge rounded-pill bg-primary text-light">Edit</span></a>
                    <a href="<?= base_url('engineer/hapus_device/') . $d['id']; ?>"><span class="badge rounded-pill bg-danger text-light" onclick="return confirm('yakin?');">Hapus</span></a>

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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Device</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- FORM TAMBAH -->
            <form class="user mx-2" method="post" action="<?= base_url('engineer/tambah_device'); ?>">
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-auto">
                        <label class="col-form-label">Chip_id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;</label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="chipid" name="chipid" placeholder="Masukan chip id device">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                        <label class="col-form-label">Nama_device &nbsp;:</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="namadevice" name="namadevice" placeholder="Masukan nama device">
                    </div>
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