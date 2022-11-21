</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user">
                <div class="form-group mx-2 mt-2">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name">
                </div>
                <div class="form-group mx-2">
                    <input type="username" class="form-control form-control-user" id="exampleInputUsername" placeholder="Username">
                </div>
                <label class="h6 text-gray-900 mx-2" for="exampleFormControlSelect1">Select role :</label>
                <div class="radio container">

                    <input class="form-check-input mx-2" type="radio" name="role" id="flexRadioDefault1">
                    <label class="form-check-label col-sm-2 mx-3">Admin</label>

                    <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2">
                    <label class="form-check-label col-sm-3">Super user</label>

                    <input class="form-check-input" type="radio" name="role" id="flexRadioDefault3">
                    <label class="form-check-label col-sm-2">User</label>

                    <input class="form-check-input" type="radio" name="role" id="flexRadioDefault4">
                    <label class="form-check-label">Engineer</label>

                </div>
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0 mx-auto">
                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    </div>
                    <div class="col-sm-5 mx-auto">
                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                    </div>
                </div>
            </form>
            <div class="mx-auto">
                <button class="btn btn-primary mb-3" type="button" data-dismiss="modal">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user">
                <div class="form-group mx-2 mt-2">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name">
                </div>
                <div class="form-group mx-2">
                    <input type="username" class="form-control form-control-user" id="exampleInputUsername" placeholder="Username">
                </div>
                <label class="h6 text-gray-900 mx-2" for="exampleFormControlSelect1">Select role :</label>
                <div class="radio container">

                    <input class="form-check-input mx-2" type="radio" name="role" id="flexRadioDefault1">
                    <label class="form-check-label col-sm-2 mx-3">Admin</label>

                    <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2">
                    <label class="form-check-label col-sm-3">Super user</label>

                    <input class="form-check-input" type="radio" name="role" id="flexRadioDefault3">
                    <label class="form-check-label col-sm-2">User</label>

                    <input class="form-check-input" type="radio" name="role" id="flexRadioDefault4">
                    <label class="form-check-label">Engineer</label>

                </div>
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0 mx-auto">
                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    </div>
                    <div class="col-sm-5 mx-auto">
                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                    </div>
                </div>
            </form>
            <div class="mx-auto">
                <button class="btn btn-primary mb-3" type="button" data-dismiss="modal">Create</button>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript' src='#'></script>
<script type='text/javascript' src='#'></script>
<script type='text/javascript' src='#'></script>
<script type='text/javascript'>
</script>
<script type='text/javascript'>
    var myLink = document.querySelector('a[href="#"]');
    myLink.addEventListener('click', function(e) {
        e.preventDefault();
    });
</script>

</body>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>
<script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>

</html>