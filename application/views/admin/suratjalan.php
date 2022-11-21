<!-- Begin Page Content -->
<div class="container-fluid" id="targetbro">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Surat Jalan</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <form action="<?= base_url('admin/suratjalan'); ?>" method="post">
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. Surat Jalan</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_su" id="no_su" class="form-control form-control-user">
                                <?= form_error('no_su', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormDateInput" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" name="tanggal" class="form-control form-control-user">
                                <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">NO. Order Lgn</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_order" id="no_order" class="form-control form-control-user">
                                <?= form_error('no_order', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">PO NO</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_po" id="no_po" class="form-control form-control-user">
                                <?= form_error('no_po', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-3 col-form-label">Customer</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="customer" id="customer" class="form-control ">
                                        <?= form_error('customer', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group row">
                                    <span class="input-group-btn ">
                                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#tambahCustomer">
                                            <i class="fa fa-search"> </i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="alamat" id="alamat" class="form-control form-control-user" readonly>
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-8">

                                <div class="form-group row">
                                    <label for="exampleFormSupplierInput" class="col-sm-3 col-form-label">Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telepon" id="telepon" class="form-control form-control-user">
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group row">
                                    <label for="exampleFormDateInput" class="col-sm-4 col-form-label">Fax</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="fax" class="form-control form-control-user">
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="form-group row">
                            <table style="text-align:center" class="table table-bordered" id="tableLoop">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1">No</th>
                                        <th class="col-lg-5">Nama Barang</th>
                                        <th class="col-lg-2">Unit</th>
                                        <th class="col-lg-2">Total</th>
                                        <th class="col-lg-2">Total Palet</th>
                                        <th class="col-lg-2"><button class="btn btn-primary" id="BarisBaru"><i class="fa fa-plus"></i> Tambah</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><input type="text" name="nama_barang[]" class="form-control form-control-user">';</td>
                                        <td><input type="text" name="unit[]" class="form-control form-control-user">';</td>
                                        <td><input type="text" name="total[]" class="form-control form-control-user">';</td>
                                        <td><input type="text" name="total_palet[]" class="form-control form-control-user">';</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer row">
                            <div class="form-group text-left col-lg-6">
                                <button type="reset" class="btn btn-primary"> RESET</button>
                            </div>
                            <div class="form-group text-right col-lg-6">
                                <button class="btn btn-success" type="submit">Konfirmasi

                                </button>
                                <button type=" reset" class="btn btn-default">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Tambah Modal-->
<div class="modal fade" id="tambahCustomer">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                <button class="close" type="button" id="tutup_modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- OPTION TAMBAH -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- DataTales Example -->

                <div class="table-responsive">
                    <font size="2" face="Arial">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Tambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customer as $c) : ?>
                                    <tr>
                                        <th><?= $c['id']; ?></th>
                                        <th><?= $c['nama_customer']; ?></th>
                                        <th><?= $c['alamat']; ?></th>
                                        <td class="text-center"> <span class="input-group-btn ">
                                                <button class="btn btn-success btn-xs" id="pilihcustomer" data-id="<?= $c['id']; ?>" data-customer="<?= $c['nama_customer']; ?>" data-alamat="<?= $c['alamat']; ?>"><i class="fa fa-check"> </i>
                                                    Pilih
                                                </button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
                </font>

            </div>



        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#pilihcustomer', function() {
            var customer = $(this).data('customer');
            var name = $(this).data('name');
            var alamat = $(this).data('alamat');
            $('#customer').val(customer);
            $('#alamat').val(alamat);
            // $('#tutup_modal').trigger('click');

        })
    })
</script>

<script>
    $(document).ready(function() {
        for (B = 1; B <= 0; B++) {
            Barisbaru();
        }
        $('#BarisBaru').click(function(e) {
            e.preventDefault();
            Barisbaru();
        });

        $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
    });

    function Barisbaru() {
        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();
        });
        var Nomor = $("#tableLoop tbody tr").length + 1;
        var Baris = '<tr>';
        Baris += '<td class="text-center">' + Nomor + '</td>';
        Baris += '<td>';
        Baris += '<input type="text" name="nama_barang[]" class="form-control form-control-user">';
        Baris += '</td>';
        Baris += '<td>';
        Baris += '<input type="text" name="unit[]" class="form-control form-control-user">';
        Baris += '</td>';
        Baris += '<td>';
        Baris += '<input type="text" name="total[]" class="form-control form-control-user">';
        Baris += '</td>';
        Baris += '<td>';
        Baris += '<input type="text" name="total_palet" class="form-control form-control-user">';
        Baris += '</td>';
        Baris += '<td class="text-center">';
        Baris += '<button class="btn btn-sm btn-danger" data-toggle="tooltip" id="HapusBaris"><i class="fa fa-times"></i></button>';
        Baris += '</td>';
        Baris += '</tr>';

        $("#tableLoop tbody").append(Baris);
        $("#tableLoop tbody tr").each(function() {
            $(this).find('td:nth-child(2) input').focus();
        });

    }

    $(document).on('click', '#HapusBaris', function(e) {
        e.preventDefault();
        var Nomor = 1;
        $(this).parent().parent().remove();
        $('tableLoop tbody tr').each(function() {
            $(this).find('td:nth-child(1)').html(Nomor);
            Nomor++;
        });
    });

    $(document).ready(function() {
        $('#SimpanData').submit(function(e) {
            e.preventDefault();
            biodata();
        });
    });
</script>

<!-- Konfirmasi Modal-->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body mx-auto mt-4 mb-4">Surat Jalan Telah Disimpan</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>