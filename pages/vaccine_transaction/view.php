<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("
        SELECT 
            vi.*, 
            v.name AS vaccine_name,
            s.name AS supplier_name
        FROM vaccine_inventory vi
        LEFT JOIN vaccines v ON vi.vaccine_id = v.id
        LEFT JOIN vaccine_supplier s ON vi.supplier_id = s.id
        WHERE vi.id = '$id'
    ");
    foreach($SelectTable as $value){
        $vaccine_name = $value["vaccine_name"];
        $batch_no = $value["batch_no"];
        $manufacturer = $value["manufacturer"];
        $supplier_name = $value["supplier_name"];
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
<div class="modal-header">
    <h5 class="modal-title">View Vaccine Inventory</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- This Alert is needed -->
<div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
    <strong>ERROR!</strong> Please Fill in the required Inputs below!
    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div id="update_result"></div>

<div class="modal-body">
    <div class="row">

        <!-- Vaccine -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Vaccine:</label>
            <div class="fs-6 text-dark"><?php echo $vaccine_name ?? '—'; ?></div>
        </div>

        <!-- Batch Number -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Batch Number:</label>
            <div class="fs-6 text-dark"><?php echo $batch_no ?? '—'; ?></div>
        </div>

        <!-- Manufacturer -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Manufacturer:</label>
            <div class="fs-6 text-dark"><?php echo $manufacturer ?? '—'; ?></div>
        </div>

        <!-- Supplier -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Supplier:</label>
            <div class="fs-6 text-dark"><?php echo $supplier_name ?? '—'; ?></div>
        </div>

        <!-- Quantity Received -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Quantity Received:</label>
            <div class="fs-6 text-dark"><?php echo $quantity_received ?? '—'; ?></div>
        </div>

        <!-- Quantity Available -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Quantity Available:</label>
            <div class="fs-6 text-dark"><?php echo $quantity_available ?? '—'; ?></div>
        </div>

        <!-- Unit -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Unit:</label>
            <div class="fs-6 text-dark"><?php echo $unit ?? '—'; ?></div>
        </div>

        <!-- Temperature Range -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Temperature Range:</label>
            <div class="fs-6 text-dark"><?php echo $temperature_range ?? '—'; ?></div>
        </div>

        <!-- Expiry Date -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Expiry Date:</label>
            <div class="fs-6 text-dark"><?php echo date('F d, Y', strtotime($expiry_date)) ?? '—'; ?></div>
        </div>

        <!-- Received By -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Received By:</label>
            <div class="fs-6 text-dark"><?php echo $received_by ?? '—'; ?></div>
        </div>

        <!-- Date Received -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Date Received:</label>
            <div class="fs-6 text-dark"><?php echo date('F d, Y', strtotime($date_received)) ?? '—'; ?></div>
        </div>

        <!-- Status -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Status:</label>
            <div class="badge 
                <?php 
                    echo ($status == 'Available') ? 'badge-success' :
                        (($status == 'Used') ? 'badge-primary' :
                        (($status == 'Expired') ? 'badge-danger' :
                        (($status == 'Damaged') ? 'badge-warning' : 'badge-secondary')));
                ?>">
                <?php echo $status ?? '—'; ?>
            </div>
        </div>

        <!-- Storage Location -->
        <div class="col-lg-12 mb-4">
            <label class="fw-bold text-muted mb-0">Storage Location:</label>
            <div class="fs-6 text-dark"><?php echo nl2br($storage_location ?? '—'); ?></div>
        </div>

        <!-- Remarks -->
        <div class="col-lg-12 mb-4">
            <label class="fw-bold text-muted mb-0">Remarks:</label>
            <div class="fs-6 text-dark"><?php echo nl2br($remarks ?? '—'); ?></div>
        </div>

    </div>
</div>
