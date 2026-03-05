
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
        CONCAT(vr.firstname, ' ', vr.lastname) AS fullname,
        f.facility_name,
        i.quantity,
        i.remarks, 
        i.issued_type,
        CONCAT(su.first_name, ' ', su.last_name) AS issue_by
        FROM vaccine_issuance i
        LEFT JOIN vaccines v ON v.id = i.vaccine_id
        LEFT JOIN vaccine_registration vr ON vr.id = i.vaccinee_id
        LEFT JOIN system_facilities f ON f.id = i.issued_to
        LEFT JOIN system_user su ON su.id = i.created_by
        WHERE i.is_archive = 0
        AND i.id = {$id}
    ");
    
    $data = ($result && $result->num_rows > 0) ? $result->fetch_assoc() : [];

    $issued_to_name = "N/A";

    if ($data["issued_to"] != 0) {
        $issued_to_name = $data["facility_name"];
    }

    if ($data["vaccinee_id"] != 0) {
        $issued_to_name = $data["fullname"];
    }

    $vaccine_name = $data['vaccine_name'] ?? '—';
    $issued_to = $issued_to_name;
    $quantity = $data['quantity'] ?? '—';
    $remarks = $data['remarks'] ?? '—';
    $issue_by = $data['issue_by'] ?? '—';
    $issued_type = $data['issued_type'] ?? '—';
    $issued_date = $data['issued_date'] ?? '—';
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
                <th class="fw-bold text-muted">Issued To</th>
                <td><?= $issued_to ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Issued Type</th>
                <td><?= $issued_type ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Quantity Issued</th>
                <td><?= $quantity ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Issued By</th>
                <td><?= $issue_by ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Issued Date</th>
                <td><?= date("M d, Y", strtotime($issued_date)) ?></td>
            </tr>

            <tr>
                <th class="fw-bold text-muted">Remarks</th>
                <td><?= nl2br($remarks) ?></td>
            </tr>
        </tbody>
    </table>
</div>
