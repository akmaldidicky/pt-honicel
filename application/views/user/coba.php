<html>

<head>
    <title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    setTimeout(function() {
        $("#auto_refresh").load("#auto_refresh");
    }, 50000); //refresh setiap 1 Detik. Khusus Area #auto_refresh
</script>
</head>

<body>

    <div id='auto_refresh'>
        <h1 id='My Table'>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code WO</th>
                        <th>Customer</th>
                        <th>Article#</th>
                        <th>QRCode</th>
                        <th>Action</th>
                        <th>Tanggal</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($wo as $w) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $w['code_wo']; ?></td>
                            <td><?= $w['customer']; ?></td>
                            <td><?= $w['article']; ?></td>
                            <td><a href="<?= base_url('admin/wopdf/') . $w['code_wo']; ?>" target="_blank"><img height="50" width="50" src="<?= base_url('assets/img/qrcode/wo/') . $w['qrcode']; ?>"></a></td>
                            <td>
                                <a href="<?= base_url('admin/wopdf/') . $w['code_wo']; ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/img/sign/print.png'); ?>"></a>
                            </td>
                            <td> <?= date("d M Y", strtotime($w['tanggal'])); ?></td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </h1>
    </div>
</body>

</html>