<link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
<link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<style>
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

    body {
        background-color: #eeeeee;
        font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    .container {
        margin-top: 50px;
        margin-bottom: 50px
    }

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #4e73df
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #4e73df;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #4e73df;
        border-color: #4e73df;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #4e73df;
        border-color: #4e73df;
        border-radius: 1px
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Tracking</h1>


    <div class="col-lg mx-2 mt-3">
        <form action="<?= base_url('tracking/wo'); ?>" method="post">
            <div class="form-group row">
                <div class="col-4">
                    <input type="text" name="codewo" class="form-control form-control-user" placeholder="Scan QR Code WO">
                </div>
                <div class="col-4">
                    <button class=" btn btn-success" type="submit">Pilih</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Content Row -->
    <?php if ($tracking) { ?>

        <body className='snippet-body'>
            <div class="container">
                <article class="card">
                    <header class="card-header"> Tracking Work Order </header>
                    <div class="card-body">
                        <?php foreach ($warehouse as $w) : ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th>
                                        <div class="col"> <strong>WO ID: </strong> <br><?= $w['code']; ?> </div>
                                    </th>
                                    <th>
                                        <div class="col"> <strong>PO ID #:</strong> <br><?= $w['code_po']; ?></div>
                                    </th>
                                    <th>
                                        <div class="col"> <strong>Status:</strong> <br><?= $w['status']; ?></div>
                                    </th>
                                    <th>
                                        <div class="col"> <strong>Lokasi:</strong> <br><?= $w['tempat']; ?></div>
                                    </th>
                                </tr>
                            </table>
                        <?php endforeach; ?>
                        <div class="track">
                            <?php foreach ($tracking as $t) : ?>
                                <?php foreach ($warehouse as $w) :
                                    $date = date('Y-m-d', strtotime($w['date_created']));
                                ?>
                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?= $t['status']; ?>

                                            <br><?= $date ?></span> </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            <!-- <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Production</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text"> Finish good <br>ware house </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Deliver</span> </div> -->
                        </div>
                    </div>
                    <footer class="card-header">
                        <!-- <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a> -->
                    </footer>
                </article>
            </div>
            <!-- /.container-fluid -->
        </body>
    <?php } else { ?>

        <body className='snippet-body'>
            <div class="container">
                <article class="card">
                    <header class="card-header"> Tracking Work Order </header>
                    <div class="card-body">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>
                                    <div class="col"> <strong>WO ID: </strong> <br></div>
                                </th>
                                <th>
                                    <div class="col"> <strong>PO ID #:</strong> <br></div>
                                </th>
                                <th>
                                    <div class="col"> <strong>Status:</strong> <br></div>
                                </th>
                                <th>
                                    <div class="col"> <strong>Lokasi:</strong> <br></div>
                                </th>
                            </tr>
                        </table>
                        <div class="track">
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"></span> </div>

                            <!-- <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Production</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text"> Finish good <br>ware house </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Deliver</span> </div> -->
                        </div>
                    </div>
                    <footer class="card-header">
                        <!-- <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a> -->
                    </footer>
                </article>
            </div>
            <!-- /.container-fluid -->
        </body>
    <?php } ?>
</div>
</div>
<!-- End of Main Content -->