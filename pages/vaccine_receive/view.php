<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = isset($_GET['primary_id']) ? (int) $_GET['primary_id'] : 0;

    $result = $systemcore->SelectCustomize("SELECT
        r.id AS vaccine_receive_id,
        v.name AS vaccine_name,
        s.name AS supplier_name,
        f.facility_name,
        r.quantity,
        r.remarks,
        r.expiry_date,
        CONCAT(u.first_name, ' ', u.last_name) as receive_by
        FROM vaccine_receive r
        LEFT JOIN vaccines v ON v.id = r.vaccine_id
        LEFT JOIN vaccine_supplier s ON s.id = r.supplier_id
        LEFT JOIN system_facilities f ON f.id = r.facility_id
        LEFT JOIN system_user u ON u.id = r.created_by
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
    $exp = ($data['expiry_date'] != "") ? $data['expiry_date'] : "----:--:--";
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
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th width="35%" class="fw-bold text-muted">Vaccine Name</th>
                <td><?= $vaccine_name ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Supplier</th>
                <td><?= $supplier_name ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Facility</th>
                <td><?= $facility_name ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Quantity Received</th>
                <td><?= $quantity ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Received / Created By</th>
                <td><?= $receive_by ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Expiry Date</th>
                <td><?= date("M d, Y", strtotime($exp)) ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Remarks</th>
                <td><?= nl2br($remarks) ?></td>
            </tr>
        </tbody>
    </table>
</div>
