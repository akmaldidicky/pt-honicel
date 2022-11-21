<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=" . $nama['nama_karyawan'] . "(Absensi).xls");
?>
<html>

<body>
    <div class="container">
        <p class="text-center" style="font-size:16pt">DAFTAR HADIR</p>
        <h4>NAMA : <?= $nama['nama_karyawan']; ?></h4>
        <div class="data-tables a">

            <table class="table table-bordered" id="dataTable" border="1" align="center">
                <thead>
                    <tr>
                        <th width="30">#</th>
                        <th width="150">Tanggal</th>
                        <th width="150">Jam Masuk</th>
                        <th width="150">Jam Pulang</th>
                        <th width="100">Lama Kerja</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    ?>
                    <?php foreach ($absen as $a) :
                    ?>
                        <tr>
                            <td align="center"><?= $i; ?></td>
                            <td align="center"><?php echo date("d M Y", strtotime ($a['time_created'])); ?></td>
                            <td align="center"><?php echo date("H:i:s", strtotime ($a['jam_masuk'])); ?></td>
                            <td align="center"><?php echo date("H:i:s", strtotime ($a['jam_pulang'])); ?></td>
                            <td align="center"><?php echo $a['lama_kerja']; ?></td>
                        </tr>
                        <?php $i++
                        ?>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>