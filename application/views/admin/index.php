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
                    <form>
                        <div class="form-group row">
                            <label for="exampleFormNoPOInput" class="col-sm-2 col-form-label">No. PO</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user">
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
                                <input type="text" class="form-control form-control-user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormTypeInput" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="example FormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormTypeInput" class="col-sm-2 col-form-label">Wide</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="example FormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Length</label>
                            <div class="col-sm-10">
                                <a>= 5000 M</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormWeightInput" class="col-sm-2 col-form-label">Weight</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-user">
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
</div>
<!-- /.container-fluid -->