<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Daily Production ECK" . date('d M Y') . ".xls");
?>
<html>

<body>
    <div class="container">
        <p class="text-center" style="font-size:16pt">Daily Production ECK</p>
        <div class="data-tables a">

            <table class="table table-bordered" id="dataTable" border="1" align="center">
                <thead>
                    <tr>
                        <th rowspan="3" colspan="2" width="100">Date</th>
                        <th rowspan="2" width="100" style="font-weight: bold;">Availability (90%)</th>
                        <th rowspan="2" width="100" style="font-weight: bold;">Perfomance Efficiency (95%)</th>
                        <th rowspan="2" width="100" style="font-weight: bold;">Yield (99%)</th>
                        <th rowspan="2" width="100" style="font-weight: bold;">OEE (85%)</th>
                        <th rowspan="3" width="70">Working Shift</th>
                        <th rowspan="3" width="100">Start Time</th>
                        <th rowspan="3" width="100">End</th>
                        <th rowspan="3" width="100">Shift Hours / Available Time (min)</th>
                        <th rowspan="3" width="70">Loading Time (min)</th>
                        <th rowspan="3" width="80">Operation Time(min)</th>
                        <th rowspan="3" width="100">Planned Downtime (min)</th>
                        <th rowspan="3" width="100">Breakdown / Unplanned Down Time (min)</th>
                        <th rowspan="3" width="100">Availability (%)</th>
                        <th rowspan="2" colspan="3" width="200">Product Size</th>
                        <th rowspan="3" width="80">Layer / pallet</th>
                        <th rowspan="3" width="70">Paper Used (Kg)</th>
                        <th rowspan="3" width="70">Lem Used (Kg)</th>
                        <th rowspan="3" width="70">Kg / Layer</th>
                        <th rowspan="3" width="70">Output (Layer)</th>
                        <th rowspan="3" width="70">Output (Kg)</th>
                        <th rowspan="3" width="50">Waste</th>
                        <th rowspan="3" width="50" style="font-weight: bold;">Paper Waste Rate</th>
                        <th rowspan="3" width="100" style="font-weight: bold;">Performance Efficiency</th>
                        <th rowspan="3" width="100" style="font-weight: bold;">Yield (%)</th>
                        <th rowspan="3" width="100" style="font-weight: bold;">OEE</th>
                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <th><?= ceil($all['ava'] * 100); ?>%</th>
                        <th><?= ceil($all['pe'] * 100); ?>%</th>
                        <th><?= ceil($all['yield'] * 100); ?>%</th>
                        <th><?= ceil($all['oee'] * 100); ?>%</th>
                        <th>Cell Size (mm)</th>
                        <th>Paper Width (mm)</th>
                        <th>Thickness (mm)</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    ?>
                    <?php foreach ($oee as $e) :
                    ?>
                        <tr>
                            <td colspan="2" align="center"><?= date("d M Y", strtotime($e['tanggal'])); ?></td>
                            <td align="center"><?php echo ceil($e['ava'] * 100); ?>%</td>
                            <td align="center"><?php echo ceil($e['pe'] * 100); ?>%</td>
                            <td align="center"><?php echo ceil($e['yield'] * 100); ?>%</td>
                            <td align="center"><?php echo ceil($e['oee'] * 100); ?>%</td>
                            <td align="center"><?php echo $e['shift']; ?></td>
                            <td align="center"><?php echo date("H:i:s", strtotime($e['waktu_mulai'])); ?></td>
                            <td align="center"><?php echo date("H:i:s", strtotime($e['waktu_akhir'])); ?></td>
                            <td align="center"><?php echo $e['av']; ?></td>
                            <?php
                            $code_wo = $e['code_wo'];
                            $pd = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo='$code_wo' AND kategori='Plan Downtime'")->row_array();
                            $dl = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo='$code_wo' AND kategori='Downtime Losses'")->row_array(); ?>
                            <td align="center"><?= $load = $e['av'] - $pd['waktu'] ?></td>
                            <td align="center"><?= $load - $dl['waktu']; ?></td>
                            <td align="center"><?= $pd['waktu'] ?></td>
                            <td align="center"><?= $dl['waktu']; ?></td>
                            <td align="center"><?php echo ceil($e['ava'] * 100); ?>%</td>
                            <td align="center"><?php echo $e['cell_size']; ?></td>
                            <td align="center"><?php echo $e['paper_width']; ?></td>
                            <td align="center"><?php echo $e['thickness']; ?></td>
                            <td align="center"><?php echo ceil(800 / $e['thickness']); ?></td>
                            <td align="center"><?php echo $e['pemakaian_kertas']; ?></td>
                            <td align="center"><?php echo $e['pemakaian_lem']; ?></td>
                            <td align="center"><?php echo $e['kg_layer']; ?></td>
                            <td align="center"><?php echo $e['output_pieces']; ?></td>
                            <td align="center"><?php echo $e['output_kg']; ?></td>
                            <td align="center"><?php echo $e['berat_buangan_lem']; ?></td>
                            <td align="center"><?php echo ceil(($e['berat_buangan_kertas'] / $e['pemakaian_kertas']) * 100); ?>%</td>
                            <td align="center"><?php echo ceil($e['pe'] * 100); ?>%</td>
                            <td align="center"><?php echo ceil($e['yield'] * 100); ?>%</td>
                            <td align="center"><?php echo ceil($e['oee'] * 100); ?>%</td>
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