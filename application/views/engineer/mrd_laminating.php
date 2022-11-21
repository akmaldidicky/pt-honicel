<div>
    <?= $this->session->flashdata('message'); ?>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="group-row card-header py-3">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">Master Raw Data Laminating</h6>
            </div>
            <div class="float-right">
                <button type="button" class="btn btn-success mb-2  mx-4" data-toggle="modal" data-target="#tambahModal">Tambah Data +</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">item_code</th>
                            <th scope="col">tebal</th>
                            <th scope="col">cell_size</th>
                            <th scope="col">panjang</th>
                            <th scope="col">lebar</th>
                            <th scope="col">board/pallet</th>
                            <th scope="col">waktu</th>
                            <th scope="col">menit</th>
                            <th scope="col">min/board</th>
                            <th scope="col">speed</th>
                            <th scope="col">weight/pallet</th>
                            <th scope="col">kg/board</th>
                            <th scope="col">pulling_std</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        ?>
                        <?php foreach ($mrd_laminating as $l) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $l['item_code']; ?></td>
                                <td><?= $l['tebal']; ?></td>
                                <td><?= $l['cell_size']; ?></td>
                                <td><?= $l['panjang']; ?></td>
                                <td><?= $l['lebar']; ?></td>
                                <td><?= $l['board/pallet']; ?></td>
                                <td><?= $l['waktu']; ?></td>
                                <td><?= $l['menit']; ?></td>
                                <td><?= $l['min/board']; ?></td>
                                <td><?= $l['speed']; ?></td>
                                <td><?= $l['weight/pallet']; ?></td>
                                <td><?= $l['kg/board']; ?></td>
                                <td><?= $l['pulling_std']; ?></td>


                                <td>
                                    <a href="<?= base_url('engineer/edit_mrd_l/') . $l['id'] ?>"><span class=" badge rounded-pill bg-primary text-light">Edit</span></a>
                                    <a href="<?= base_url('engineer/hapus_mrd_l/') . $l['id']; ?>"><span class="badge rounded-pill bg-danger text-light" onclick="return confirm('yakin?');">Hapus</span></a>

                                </td>

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


<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah MRD Laminating</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- FORM TAMBAH -->
            <form class="user mx-2" method="post" action="<?= base_url('engineer/tambah_mrd_l'); ?>">
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">item_code </label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="item_code" name="item_code">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">tebal</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="tebal" name="tebal">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">cell_size</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="cell_size" name="cell_size">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">panjang</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="panjang" name="panjang">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">lebar</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="lebar" name="lebar">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">board/pallet</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="board/pallet" name="board/pallet">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">waktu</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="waktu" name="waktu">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">menit</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="menit" name="menit">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">min/board</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="min/board" name="min/board">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">speed</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="speed" name="speed">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">weight/pallet </label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="weight/pallet" name="weight/pallet">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">kg/board</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="kg/board" name="kg/board">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2 mt-1 ">
                    <div class="col-3">
                        <label class="col-form-label">pulling_std</label>
                        <label class="col-form-label float-right">: </label>
                    </div>
                    <div class="form-group mx-2 mt-2">
                        <input type="text" id="pulling_std" name="pulling_std">
                    </div>
                </div>

                <div class="modal-body">Pilih "Tambah" untuk menambahkan mrd laminating.</div>
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