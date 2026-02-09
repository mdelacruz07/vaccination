<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = isset($_GET['primary_id']) ? (int) $_GET['primary_id'] : 0;

    $result = $systemcore->SelectCustomize("SELECT
        i.id AS vaccine_issuance_id,
        i.issued_to,
        i.vaccinee_id,
        i.issued_date,
        v.name AS vaccine_name,
        CONCAT(vr.firstname, ' ', vr.middlename, ' ', vr.lastname) AS fullname,
        f.facility_name,
        i.quantity,
        i.remarks
        FROM vaccine_issuance i
        LEFT JOIN vaccines v ON v.id = i.vaccine_id
        LEFT JOIN vaccine_registration vr ON vr.id = i.vaccinee_id
        LEFT JOIN system_facilities f ON f.id = i.issued_to
        WHERE r.is_archive = 0
        AND r.id = {$id}
    ");
    
    $data = ($result && $result->num_rows > 0) ? $result->fetch_assoc() : [];

    $vaccine_name = $data['vaccine_name'] ?? '—';
    $supplier_name = $data['supplier_name'] ?? '—';
    $facility_name = $data['facility_name'] ?? '—';
    $quantity = $data['quantity'] ?? '—';
    $remarks = $data['remarks'] ?? '—';
    $receive_by = $data['receive_by'] ?? '—';
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
        <!-- Vaccine Name -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Vaccine Name:</label>
            <div class="fs-6 text-dark"><?= $vaccine_name ?></div>
        </div>

        <!-- Supplier -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Supplier:</label>
            <div class="fs-6 text-dark"><?= $supplier_name ?></div>
        </div>

        <!-- Facility -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Facility:</label>
            <div class="fs-6 text-dark"><?= $facility_name ?></div>
        </div>

        <!-- Quantity -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Quantity Received:</label>
            <div class="fs-6 text-dark"><?= $quantity ?></div>
        </div>

        <!-- Created By -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Received / Created By:</label>
            <div class="fs-6 text-dark"><?= $receive_by ?></div>
        </div>

        <!-- Remarks -->
        <div class="col-lg-12 mb-4">
            <label class="fw-bold text-muted mb-0">Remarks:</label>
            <div class="fs-6 text-dark"><?= nl2br($remarks) ?></div>
        </div>
    </div>
</div>
