<div class="container">

    <!-- <h2>Snackbar / Toast</h2>
    <p>Snackbars are often used as a tooltips/popups to show a message at the bottom of the screen.</p>
    <p>Click on the button to show the snackbar. It will disappear after 3 seconds.</p>-->

    <!-- <button onclick="myFunction()" class="alert" hidden>Show Snackbar</button>
    <div id="snackbar">Some text some message..</div> -->

    <?= $this->session->flashdata('message'); ?>
    <!-- <button onclick="success()" class="alert" hidden>Show Snackbar</button> -->


    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7 my-auto">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <form class="form-grup row" method="post" action="<?= base_url('user/hasil_produksi'); ?>">
                                    <div class="col-lg-10">
                                        <input type="text" name="code" class="form-control form-control-user" placeholder="scan qrcode" autofocus>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-success" onclick="myFunction()" type=" submit">Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</div>