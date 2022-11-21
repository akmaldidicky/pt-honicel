<!-- <button id="refresh" class="btn btn-warning">
    <h1 id="h1"><?= $time; ?></h1>
</button>

<script>
    // $(document).ready(function() {
    //     setInterval(function() {
    //         $("#h1").load("<? //= base_url('supervisor/refresh'); 
                                ?>")
    //     }, 2000);
    // });
    $('#refresh').click(function() {
        location.reload();
    });
</script>-->

<script src="jquery-3.2.1.min.js?t=27"></script>


<br>
<div class="container text-center ">
    <button id="MyButton" class="btn btn-warning mb-4">Refresh</button>
    <div id="refreshDivID">
        <div class="reloaded-divs">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#MyButton").click(function() {
        alert('Confirm to refresh alert messages.');
        $("#refreshDivID").load("#refreshDivID .reloaded-divs > *");
    });
</script>