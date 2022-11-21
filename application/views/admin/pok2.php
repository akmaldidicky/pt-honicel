    <!-- Basic Card Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-6 ">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <i class="text-gray-300 float-right"></i>
                            <h5>
                                Purchase Order Kertas
                            </h5>
                        </div>
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <form method="post" action="<?= base_url('admin/pok'); ?>">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">No. PO</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-user" name="po" id="po" placeholder="Masukan Nomor PO">
                                    <?= form_error('po', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">Supplier</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-user" name="supplier" placeholder="Masukan Nama Supplier">
                                    <?= form_error('supplier', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">Tanggal</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                                <div class="col-6">
                                    <input type="date" class="form-control form-control-user" name="tanggal">
                                    <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">Tipe</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                            </div>
                            <?php foreach ($tipe_item as $t) : ?>
                                <div class="col-6 float-right">
                                    <input type="checkbox" name="tipe[]" value="<?= $t['tipe_item']; ?>">
                                    <label for="tipe"><?= $t['tipe_item']; ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-8 float-right">
                                <button class=" btn btn-success float-right mb-2 mt-3" type="submit">Next </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <div class="col-lg-6 float-right">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <i class="fa fa-filter fa-2x text-gray-300 float-right"></i>
                            <h5>
                                Detail Purchase Order
                            </h5>
                        </div>
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">

                        <form method="post" action="<?= base_url('admin/pok'); ?>">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">No. PO</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-user" name="po2" id="po2" value="<?= $po; ?>" readonly>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">Supplier</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-user" name="supplier2" value="<?= $supplier; ?>" readonly>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-4">
                                    <label class="col-form-label">Tanggal</label>
                                </div>
                                <div class="col-1 float-right">
                                    <label class="col-form-label">:</label>
                                </div>
                                <div class="col-6">
                                    <input type="date" class="form-control form-control-user" name="tanggal2" value="<?= $tanggal; ?>" readonly>
                                </div>
                            </div>
                            <?php if ($tipe) { ?>
                                <?php foreach ($tipe as $ti => $values) : ?>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-4">
                                            <input type="text" class="form-control form-control-user" name="tipee[]" value="<?= $values; ?>" readonly>
                                        </div>
                                        <div class="col-1 float-right">
                                            <label class="col-form-label">:</label>
                                        </div>
                                        <!-- <div class="col-3 float-right">
                                            <select name="lebarr[]" class="form-control form-control-user">
                                                <? //php foreach ($item as $s) : 
                                                ?>
                                                    <option value="<? //= $s['lebar']; 
                                                                    ?>"><? //= $s['lebar']; 
                                                                        ?></option>
                                                   
                                                <? //php endforeach; 
                                                ?>
                                            </select>
                                        </div> -->
                                        <div class="col-3">
                                            <input type="number" min="1" class="form-control form-control-user" name="total[]" placeholder="Total">
                                            <?= form_error('total', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php }; ?>

                            <div>
                                <button class=" btn btn-success float-right mb-2" type="submit">Generate QRCode </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>