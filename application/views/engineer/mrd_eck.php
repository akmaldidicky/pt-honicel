    <?= $this->session->flashdata('message'); ?>
    </div>

    <div class="container-fluid">
        <?= $this->session->flashdata('message'); ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="group-row card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Master Raw Data ECK</h6>
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
                                <th scope="col">cell_size</th>
                                <th scope="col">width</th>
                                <th scope="col">tebal</th>
                                <th scope="col">layer/pallet</th>
                                <th scope="col">durasi</th>
                                <th scope="col">menit</th>
                                <th scope="col">min/layer</th>
                                <th scope="col">speed</th>
                                <th scope="col">total_weight</th>
                                <th scope="col">kg/layer</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 1;
                            ?>
                            <?php foreach ($mrd_eck as $e) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $e['item_code']; ?></td>
                                    <td><?= $e['cell_size']; ?></td>
                                    <td><?= $e['width']; ?></td>
                                    <td><?= $e['tebal']; ?></td>
                                    <td><?= $e['layer/pallet']; ?></td>
                                    <td><?= $e['durasi']; ?></td>
                                    <td><?= $e['menit']; ?></td>
                                    <td><?= $e['min/layer']; ?></td>
                                    <td><?= $e['speed']; ?></td>
                                    <td><?= $e['total_weight']; ?></td>
                                    <td><?= $e['kg/layer']; ?></td>

                                    <td>
                                        <a href="<?= base_url('engineer/edit_mrd_eck/') . $e['id'] ?>"><span class=" badge rounded-pill bg-primary text-light">Edit</span></a>
                                        <a href="<?= base_url('engineer/hapus_mrd_eck/') . $e['id']; ?>"><span class="badge rounded-pill bg-danger text-light" onclick="return confirm('yakin?');">Hapus</span></a>

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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah MRD ECK</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- FORM TAMBAH -->
                <form class="user mx-2" method="post" action="<?= base_url('engineer/tambah_mrd_eck'); ?>">
                    <div class="row g-3 align-items-center mb-2 mt-1 ">
                        <div class="col-3">
                            <label class="col-form-label">item_code</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="item_code" name="item_code">
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
                            <label class="col-form-label">width</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="width" name="width">
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
                            <label class="col-form-label">layer/pallet</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="layer/pallet" name="layer/pallet">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2 mt-1 ">
                        <div class="col-3">
                            <label class="col-form-label">durasi</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="durasi" name="durasi">
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
                            <label class="col-form-label">min/layer</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="min/layer" name="min/layer">
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
                            <label class="col-form-label">total_weight</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="total_weight" name="total_weight">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2 mt-1 ">
                        <div class="col-3">
                            <label class="col-form-label">kg/layer</label>
                            <label class="col-form-label float-right">: </label>
                        </div>
                        <div class="form-group mx-2 mt-2">
                            <input type="text" id="kg/layer" name="kg/layer">
                        </div>
                    </div>
                    <div class="modal-body">Pilih "Tambah" untuk menambahkan mrd eck.</div>
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
    </div>