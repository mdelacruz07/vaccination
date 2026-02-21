<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
    // include '../inc/navbar.php';

    // Vaccine Dropdown
    $query_vaccine = "SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name ASC";
    // $query_vaccine = "SELECT vi.id AS id, v.name AS name, vi.batch_no FROM vaccine_inventory AS vi INNER JOIN vaccines AS v ON vi.vaccine_id = v.id WHERE v.is_archive = 0 ORDER BY v.name ASC";
    $select2vaccine = $systemcore->SelectCustomize($query_vaccine);

    // Supplier Dropdown
    $query_supplier = "SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC";
    $select2supplier = $systemcore->SelectCustomize($query_supplier);

    // Facility Dropdown
    $query_facility = "SELECT id, facility_name FROM system_facilities WHERE status = 'ACTIVE' ORDER BY facility_name ASC";
    $select2facility = $systemcore->SelectCustomize($query_facility);

    $id = $_GET['primary_id'] ?? null;

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_inventory WHERE id = '$id'");
    foreach($SelectTable as $value){
        $vaccine_id = $value["vaccine_id"];
        $batch_no = $value["batch_no"];
        $manufacturer = $value["manufacturer"];
        $supplier_id = $value["supplier_id"];
        $quantity_received = $value["quantity_received"];
        $quantity_available = $value["quantity_available"];
        $unit = $value["unit"];
        $storage_location = $value["storage_location"];
        $temperature_range = $value["temperature_range"];
        $expiry_date = $value["expiry_date"];
        $date_received = $value["date_received"];
        $received_by = $value["received_by"];
        $status = $value["status"];
        $remarks = $value["remarks"];
        $created_by = $value["created_by"];
    }
?>

<style>
    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(-20%, -80%);
        font-size: 11px;
        border-radius: 50px;
    }
</style>

<body class="pages_body">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $system_page_name; ?></h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="col-6">
                            <h2 class="card-title"><b>Vaccine Stocks</b></h2>
                        </div>

                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#modal_min_stock">
                                Set Minimum Stock
                            </button>

                            <div class="card-header-tools">
                                <div class="dropdown">
                                    <button class="btn btn-link position-relative" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell-fill text-white" viewBox="0 0 16 16">
                                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                                        </svg>

                                        <span id="notificationCount" class="badge badge-danger notification-badge d-none">0</span>
                                    </button>

                                    <div id="notificationList" class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 350px; max-height: 400px; overflow-y: auto;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="vaccine_stocks_table"></div>

                        <form id="select_to_delete" hidden>
                            <h1>Deleted ID's</h1>
                            <input type="text" name="selected_id" id="select_to_delete_input" value="none">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal_min_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Minimum Stock Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Setting minimum stock level for vaccines this will use to notify that some vaccines are running low.</p>

                    <form id="minimumStockForm">
                        <div class="mb-3">
                            <label class="form-label">Minimum Stock</label>
                            <input type="number" class="form-control" name="minimum_stock" id="minimum_stock" min="0" required>
                        </div>

                        <button type="submit" class="btn btn-primary d-block ml-auto">Save</button>
                    </form>

                    <!-- Response Message -->
                    <div id="responseMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
</body>
</html>

<script>
    $(document).ready(function() {
        loadStockNotifications();

        // Auto refresh every 30 seconds
        setInterval(loadStockNotifications, 30000);

        $("#minimumStockForm").on("submit", function(e) {
            e.preventDefault();

            let minimumStock = $("#minimum_stock").val();

            $.ajax({
                url: "save_minimum_stock.php",
                type: "POST",
                data: { minimum_stock: minimumStock },
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {
                        $("#responseMessage").html(
                            '<div class="alert alert-success">' + response.message + '</div>'
                        );

                        setTimeout(function() {
                            $("#responseMessage").html('');
                            $('#modal_min_stock').modal('hide');
                        }, 2000);
                    } else {
                        $("#responseMessage").html(
                            '<div class="alert alert-danger">' + response.message + '</div>'
                        );
                    }

                },
                error: function() {
                    $("#responseMessage").html(
                        '<div class="alert alert-danger">Something went wrong.</div>'
                    );
                }
            });
        });

        $('#modal_min_stock').on('show.bs.modal', function () {
            $('#minimum_stock').prop('disabled', true);

            $.ajax({
                url: "get_minimum_stock.php",
                type: "GET",
                dataType: "json",
                success: function(response){
                    $('#minimum_stock').prop('disabled', false);

                    if(response.status === "success"){
                        $('#minimum_stock').val(response.min_qty);
                    } else {
                        $('#minimum_stock').val('');
                    }

                },
                error: function(){
                    $('#minimum_stock').val('');
                }
            });
        });
    });

    function loadStockNotifications() {
        $.ajax({
            url: "get_low_stock_notifications.php",
            type: "GET",
            dataType: "json",
            success: function(response) {

                let list = $("#notificationList");
                let badge = $("#notificationCount");

                list.empty();

                if (response.count > 0) {

                    badge.removeClass("d-none")
                        .text(response.count);

                    response.data.forEach(function(item) {

                        let alertClass = item.current_balance == 0
                            ? "alert-danger"
                            : "alert-warning";

                        list.append(`
                            <div class="dropdown-item p-2">
                                <div class="alert ${alertClass} mb-0 p-2">
                                    <strong>${item.vaccine_name}</strong><br>
                                    Current Balance: ${item.current_balance}<br>
                                    Minimum Stock: ${response.minimum_stock}
                                </div>
                            </div>
                        `);
                    });

                } else {

                    badge.addClass("d-none");

                    list.append(`
                        <div class="dropdown-item text-center text-muted">
                            No low stock vaccines
                        </div>
                    `);
                }
            }
        });
    }

    // setting up the tables
    show_table("vaccine_stocks_table", "vaccine_stocks", "#tbl_vaccines_stocks");

    $(document).on('change', '.delete-checkbox-vaccine-stocks', function() {
        // Check if at least one checkbox is ticked
        const anyChecked = $('.delete-checkbox-vaccine-stocks:checked').length > 0;
        
        // Enable or disable the button
        $('#btn-delete-selected-vaccines-stocks').prop('disabled', !anyChecked);
    });
    
    $('#vaccine_id').select2({
        placeholder: 'SELECT A VACCINE',
        width: '100%',
        dropdownParent: $('#create_vaccine_stocks') // if inside modal
    });

    // Optional: re-trigger Select2 to display selected text properly (useful if you dynamically load form)
    $('#vaccine_id').trigger('change.select2');

    $('.form-control[type="number"]').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
