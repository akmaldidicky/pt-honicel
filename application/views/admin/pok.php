<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Purchase Order Paper</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-6">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">PO Description</h6>
            </div>
        </div>
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Purchase Order</h1>
                    </div>
                    <form class="mx-2" method="post" action="<?= base_url('admin/pok'); ?>">
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. PO</label>
                            <div class="col-sm-10">
                                <input type="text" name="po" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormDateInput" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormSupplierInput" class="col-sm-2 col-form-label">Supplier</label>
                            <div class="col-sm-10">
                                <input type="text" name="supplier" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormTypeInput" class="col-sm-2 col-form-label">Paper Type </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="paper" id="paper">
                                    <option value="K275">KRAFT 275</option>
                                    <option value="M140">MEDIUM 140</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormTypeInput" class="col-sm-2 col-form-label">Wide (meter)</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="wide" id="wide">
                                    <option value="1">1</option>
                                    <option value="1.25">1.25</option>
                                    <option value="1.6">1.6</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Length (meter)</label>
                            <div class="col-sm-10">
                                <input type="length" name="length" class="form-control form-control-user" value="5000" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormWeightInput" class="col-sm-2 col-form-label">Total Item</label>
                            <div class="col-sm-10">
                                <input type="number" name="total" class="form-control form-control-user">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Create QR
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->