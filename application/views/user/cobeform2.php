<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<br>
<div class="col-12">
    <div class="col-6">

        <div class="panel panel-default">
            <div class="panel-heading">Plan Downtime</div>
            <div class="panel-body">
                <!-- membuat form  -->
                <!-- gunakan tanda [] untuk menampung array  -->
                <form action="<?= base_url('supervisor/coba'); ?>" method="POST">
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
                                    <button class="btn btn-success add-lagi" type="button">
                                        <i class="glyphicon glyphicon-plus"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" name="kategori[]" value="Plan Downtime">
                    <button class="btn btn-success mt-3" type="submit">Submit</button>
                </form>

                <!-- class hide membuat form disembunyikan  -->
                <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
                <div class="kopi invisible">
                    <div class="control-group">
                        <table border="0">
                            <!-- <tr>
                            <td><label for="">Detail</label></td>
                            <td></td>
                            <td><label for="">Waktu Awal</label></td>
                            <td></td>
                            <td><label for="">Waktu Akhir</label></td>
                        </tr> -->
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
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="panel panel-default">
            <div class="panel-heading">Downtime Losses</div>
            <div class="panel-body">
                <!-- membuat form  -->
                <!-- gunakan tanda [] untuk menampung array  -->
                <form action="<?= base_url('supervisor/coba'); ?>" method="POST">
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
                                    <button class="btn btn-success add-more" type="button">
                                        <i class="glyphicon glyphicon-plus"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                            <input type="hidden" name="kategori[]" value="Plan Downtime">
                        </table>
                    </div>
                    <button class="btn btn-success mt-3" type="submit">Submit</button>
                </form>

                <!-- class hide membuat form disembunyikan  -->
                <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
                <div class="copy invisible">
                    <div class="control-group">
                        <table border="0">
                            <!-- <tr>
                            <td><label for="">Detail</label></td>
                            <td></td>
                            <td><label for="">Waktu Awal</label></td>
                            <td></td>
                            <td><label for="">Waktu Akhir</label></td>
                        </tr> -->
                            <tr>
                                <td><select class="form-control" name="detail[]" id="">
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
                                <td><input type="time" name="waktu_awal[]" class="form-control"></td>
                                <td></td>
                                <td><input type="time" name="waktu_akhir[]" class="form-control"></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                </td>
                                <input type="hidden" name="kategori[]" value="Plan Downtime">
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- fungsi javascript untuk menampilkan form dinamis  -->
<!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
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