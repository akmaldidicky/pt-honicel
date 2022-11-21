<!-- Begin Page Content -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan Mesin Honipack</h1>
    <form action="<?= base_url('user/laplam_akhir'); ?>" method="post">
        <div class="form-group row mx-2">
            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. WO</label>
            <div class="col-4">
                <input type="text" name="nowo" class="form-control form-control-user" placeholder="Scan QR Code WO">
            </div>
            <div class="col-4">
                <button class=" btn btn-success" type="submit">Pilih</button>
            </div>
        </div>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg row">
                    <form action="<?= base_url('user/laplam_akhir'); ?>" method="post">
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. WO</label>
                            <?php foreach ($isi as $i) : ?>
                                <div class="col-sm-10">
                                    <input type="text" name="no_wo" class="form-control form-control-user" value="<?= $i['code_wo']; ?>" readonly>
                                </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="exampleFormDateInput" class="col-sm-4 col-form-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <input type="datetime-local" name="tanggal" class="form-control form-control-user">
                                        <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">Shift</label>
                            <div class="col-sm-10">
                                <input type="text" name="shift" class="form-control form-control-user">
                                <?= form_error('shift', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-10">
                                <input type="text" name="customer" class="form-control form-control-user" value="<?= $i['customer']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Article #</label>
                            <div class="col-sm-10">
                                <input type="text" name="article" class="form-control form-control-user" value="<?= $i['article']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormTypeInput" class="col-sm-2 col-form-label">Top Layer</label>
                            <div class="col-sm-10">
                                <input type="text" name="article" class="form-control form-control-user" value="<?= $i['top_layer']; ?>" readonly>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group row">
                        <label for="exampleFormTypeInput" class="col-sm-2 col-form-label">Produksi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="produksi" id="example FormControlSelect1">
                                <option>Select...</option>
                                <option>Sample</option>
                                <option>Order</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Speed Mesin</label>
                        <div class="col-sm-10">
                            <input type="text" name="speed_mesin" class="form-control form-control-user">
                            <?= form_error('speed_mesin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Kertas Terpakai (kg)</label>
                        <div class="col-sm-10">
                            <input type="text" name="kertas_terpakai" class="form-control form-control-user" placeholder="otomatis" readonly>
                            <?= form_error('kertas_terpakai', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <form>
                            <table style="text-align:center" class="table table-bordered" id="dataTable" width="100%" cellspacing="1" cellpadding="5">
                                <tr>
                                    <th>Roll#</th>
                                    <th>Panjang (M)</th>
                                    <th>Berat Awal (Kg)</th>
                                    <!-- <th>Faktor X</th>
                                    <th>Kertas Dipakai (Kg)</th> -->
                                </tr>
                                <?php $i = 1;
                                $total2 = 0;
                                foreach ($isi2 as $key) :
                                ?>
                                    <tr>
                                        <input type="hidden" class="form-control form-control-user" name="code_item[]" value="<?= $key['code_item']; ?>">
                                        <td><?= $i; ?></td>
                                        <td><input type="text" class="form-control form-control-user" name="panjang[]" value="<?= $key['panjang']; ?>"></td>
                                        <td><input type="text" class="form-control form-control-user" name="berat_awal[]" value="<?= $key['berat']; ?>"></td>
                                        <!-- <td><input type="text" class="form-control form-control-user" name="faktor_x" value="<?= $key['faktor_x']; ?>"></td>
                                        <td><input type="text" class="form-control form-control-user" name="kertas_pakai[]" value="<?= 1800 * $key['faktor_x'];  ?>"></td>
                                        <?php $total = 1800 * $key['faktor_x'];
                                        $total2 += $total; ?> -->
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                                <!-- <tr>
                                    <td>Grand Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="text" name="grand_total" class="form-control form-control-user" value=" <?= $total2 ?>"></td>
                                </tr> -->
                            </table>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormUserInput" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <table style="text-align:center" class="table table-bordered" id="dataTable" width="100%" cellspacing="1" cellpadding="5">
                                <tr>
                                    <th>Berat Awal Honeycomb</th>
                                    <th>Layer Awal Honeycomb</th>
                                    <th>Berat Akhir Honeycomb</th>
                                    <th>Layer Akhir Honeycomb</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="hcb_awal" class="form-control form-control-user"></td>
                                    <td><input type="text" name="hcl_awal" class="form-control form-control-user"></td>
                                    <td><input type="text" name="hcb_akhir" class="form-control form-control-user"></td>
                                    <td><input type="text" name="hcl_akhir" class="form-control form-control-user"></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Papan/Palet</label>
                        <div class="col-sm-10">
                            <input type="number" name="papan_palet" class="form-control form-control-user">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormUserInput" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <table style="text-align:center" class="table table-bordered" id="dataTable" width="100%" cellspacing="1" cellpadding="5">
                                <tr>
                                    <th>Total Produksi (Papan)</th>
                                    <th>Berat/Palet (Kg)</th>
                                    <th>Berat BS Awal/Akhir (Kg)</th>
                                    <th>Berat BS Papan (Kg)</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="total_produksi" class="form-control form-control-user"></td>
                                    <td><input type="text" name="berat_palet" class="form-control form-control-user"></td>
                                    <td><input type="text" name="bs1" class="form-control form-control-user"></td>
                                    <td><input type="text" name="bs2" class="form-control form-control-user"></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">

                            <div class="form-group row">
                                <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Standar Tarikan (Meter)</label>
                                <div class="col-sm-8">
                                    <input type="number" name="std_pull" class="form-control form-control-user">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="form-group row">
                                <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Actual Tarikan (Meter)</label>
                                <div class="col-sm-8">
                                    <input type="number" name="act_pull" class="form-control form-control-user">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row mt-2">

                        <div class="col-lg-6">

                            <div class="form-group row">
                                <label for="exampleFormSupplierInput" class="col-sm-4 col-form-label">Pemakaian Lem (Kg)</label>
                                <div class="col-sm-8">
                                    <input type="number" name="lem_terpakai" class="form-control form-control-user" placeholder="otomatis" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Masalah Produksi</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="masalah_produksi" class="form-control form-control-user" id="exampleFormControlTextareal" rows="3"></textarea>
                        </div>
                    </div>
                    <h2 class="mt-3">Plan Downtime</h2>
                    <div class="control-group after-add-lagi">
                        <table border="0">
                            <tr>
                                <td><label for="">Detail</label></td>
                                <td></td>
                                <td><label for="">Waktu Awal</label></td>
                                <td></td>
                                <td><label for="">Waktu Akhir</label></td>
                            </tr>
                            <tr>
                                <td><select class="form-control" name="detail[]">
                                        <option value=""></option>
                                        <option value="Start-up awal produksi">Start-up awal produksi</option>
                                        <option value="set-up size 1">set-up size 1</option>
                                        <option value="set-up size 2">set-up size 2</option>
                                        <option value="set-up size 3">set-up size 3</option>
                                        <option value="set-up size 4">set-up size 4</option>
                                        <option value="set-up size 5">set-up size 5</option>
                                        <option value="set-up size 6">set-up size 6</option>
                                        <option value="Tidak Ada Order">Tidak Ada Order</option>
                                        <option value="Pembuatan Sample">Pembuatan Sample</option>
                                        <option value="Kebersihan Haria (5S)">Kebersihan Haria (5S)</option>
                                        <option value="Training / Meeting">Training / Meeting</option>
                                        <option value="Perbaikan yang direncanakan">Perbaikan yang direncanakan</option>
                                        <option value="Project / Improvment">Project / Improvment</option>
                                        <option value="aww">aww</option>
                                    </select></td>
                                <td></td>
                                <td><input type="time" name="waktu_awal[]" class="form-control"></td>
                                <td></td>
                                <td><input type="time" name="waktu_akhir[]" class="form-control"></td>
                                <td></td>
                                <td>
                                    <input type="hidden" name="kategori[]" value="Plan Downtime">
                                    <button class="btn btn-success add-lagi" type="button">
                                        <i class="glyphicon glyphicon-plus"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="kopi invisible">
                        <div class="control-group">
                            <table border="0">
                                <tr>
                                    <td><select class="form-control" name="detail[]">
                                            <option value=""></option>
                                            <option value="Start-up awal produksi">Start-up awal produksi</option>
                                            <option value="set-up size 1">set-up size 1</option>
                                            <option value="set-up size 2">set-up size 2</option>
                                            <option value="set-up size 3">set-up size 3</option>
                                            <option value="set-up size 4">set-up size 4</option>
                                            <option value="set-up size 5">set-up size 5</option>
                                            <option value="set-up size 6">set-up size 6</option>
                                            <option value="Tidak Ada Order">Tidak Ada Order</option>
                                            <option value="Pembuatan Sample">Pembuatan Sample</option>
                                            <option value="Kebersihan Haria (5S)">Kebersihan Haria (5S)</option>
                                            <option value="Training / Meeting">Training / Meeting</option>
                                            <option value="Perbaikan yang direncanakan">Perbaikan yang direncanakan</option>
                                            <option value="Project / Improvment">Project / Improvment</option>
                                        </select></td>
                                    <td></td>
                                    <td><input type="time" class="form-control" name="waktu_awal[]"></td>
                                    <td></td>
                                    <td><input type="time" class="form-control" name="waktu_akhir[]"></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                    </td>
                                    <input type="hidden" name="kategori[]" value="Plan Downtime">
                                </tr>
                            </table>
                        </div>
                    </div>
                    <h2>Downtime Losses</h2>
                    <div class="control-group after-add-more">
                        <table border="0">
                            <tr>
                                <td><label for="">Detail</label></td>
                                <td></td>
                                <td><label for="">Waktu Awal</label></td>
                                <td></td>
                                <td><label for="">Waktu Akhir</label></td>
                            </tr>
                            <tr>
                                <td><select class="form-control" name="detail[]">
                                        <option value=""></option>
                                        <option value="Tidak ada material">Tidak ada material</option>
                                        <option value="Tidak ada tenaga kerja">Tidak ada tenaga kerja</option>
                                        <option value="Tidak ada energi listrik">Tidak ada energi listrik</option>
                                        <option value="Setting ulang 1">Setting ulang 1</option>
                                        <option value="Setting ulang 2">Setting ulang 2</option>
                                        <option value="Setting ulang 3">Setting ulang 3</option>
                                        <option value="Setting ulang 4">Setting ulang 4</option>
                                        <option value="Setting ulang 5">Setting ulang 5</option>
                                        <option value="Setting ulang 6">Setting ulang 6</option>
                                        <option value="Setting ulang 7">Setting ulang 7</option>
                                        <option value="Perbaikan 1 (Maintenance)">Perbaikan 1 (Maintenance)</option>
                                        <option value="Perbaikan 2 (Maintenance)">Perbaikan 2 (Maintenance)</option>
                                        <option value="Perbaikan 3 (Maintenance)">Perbaikan 3 (Maintenance)</option>
                                        <option value="Perbaikan 1 (Produksi)">Perbaikan 1 (Produksi)</option>
                                        <option value="Perbaikan 2 (Produksi)">Perbaikan 2 (Produksi)</option>
                                        <option value="Perbaikan 3 (Produksi)">Perbaikan 3 (Produksi)</option>
                                    </select></td>
                                <td></td>
                                <td><input type="time" name="waktu_awal[]" class="form-control"></td>
                                <td></td>
                                <td><input type="time" name="waktu_akhir[]" class="form-control"></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-success add-more" type="button">
                                        <i class="glyphicon glyphicon-plus"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                            <input type="hidden" name="kategori[]" value="Downtime Losses">
                        </table>
                    </div>
                    <div class="copy invisible">
                        <div class="control-group">
                            <table border="0">
                                <tr>
                                    <td><select class="form-control" name="detail[]" id="">
                                            <option value=""></option>
                                            <option value="Tidak ada material">Tidak ada material</option>
                                            <option value="Tidak ada tenaga kerja">Tidak ada tenaga kerja</option>
                                            <option value="Tidak ada energi listrik">Tidak ada energi listrik</option>
                                            <option value="Setting ulang 1">Setting ulang 1</option>
                                            <option value="Setting ulang 2">Setting ulang 2</option>
                                            <option value="Setting ulang 3">Setting ulang 3</option>
                                            <option value="Setting ulang 4">Setting ulang 4</option>
                                            <option value="Setting ulang 5">Setting ulang 5</option>
                                            <option value="Setting ulang 6">Setting ulang 6</option>
                                            <option value="Setting ulang 7">Setting ulang 7</option>
                                            <option value="Perbaikan 1 (Maintenance)">Perbaikan 1 (Maintenance)</option>
                                            <option value="Perbaikan 2 (Maintenance)">Perbaikan 2 (Maintenance)</option>
                                            <option value="Perbaikan 3 (Maintenance)">Perbaikan 3 (Maintenance)</option>
                                            <option value="Perbaikan 1 (Produksi)">Perbaikan 1 (Produksi)</option>
                                            <option value="Perbaikan 2 (Produksi)">Perbaikan 2 (Produksi)</option>
                                            <option value="Perbaikan 3 (Produksi)">Perbaikan 3 (Produksi)</option>
                                        </select></td>
                                    <td></td>
                                    <td><input type="time" name="waktu_awal[]" class="form-control"></td>
                                    <td></td>
                                    <td><input type="time" name="waktu_akhir[]" class="form-control"></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                    </td>
                                    <input type="hidden" name="kategori[]" value="Downtime Losses">
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="hidden" name="code" class="form-control form-control-user" value="1">
                    </div>
                    <div class="box-footer row">
                        <div class="form-group text-left col-lg-6">
                            <a href="<?= base_url('user/mesin_lam'); ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                        <div class="form-group text-right col-lg-6">
                            <button type="submit" class="btn btn-success float-right">Konfirmasi</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(document).ready(function() {
        $(".add-lagi").click(function() {
            var html = $(".kopi").html();
            $(".after-add-lagi").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });
    });
</script>