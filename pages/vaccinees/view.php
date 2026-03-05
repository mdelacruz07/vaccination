<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = isset($_GET['primary_id']) ? (int) $_GET['primary_id'] : 0;

    $result = $systemcore->SelectCustomize("SELECT p.*, v1.name AS first_vaccine_name,
        IF(p.second_vaccine_id = 0 OR v2.name IS NULL, 'None', v2.name) AS second_vaccine_name
        FROM patient p
        LEFT JOIN vaccines v1 ON p.first_vaccine_id = v1.id
        LEFT JOIN vaccines v2 ON p.second_vaccine_id = v2.id
        WHERE p.is_archive = 0
        AND p.id = {$id}
        ORDER BY p.id DESC
    ");
    
    $data = ($result && $result->num_rows > 0) ? $result->fetch_assoc() : [];

    $fullname = trim(($data['firstname'] ?? '') . ' ' . ($data['middlename'] ?? '') . ' ' . ($data['lastname'] ?? ''));

    $category = $data['category'] ?? '—';
    $province = $data['province'] ?? '—';
    $city = $data['city'] ?? '—';
    $barangay = $data['barangay'] ?? '—';
    $indigenous = !empty($data['indigenous']) ? 'Yes' : 'No';
    $pwd = !empty($data['pwd']) ? 'Yes' : 'No';
    $guardian = $data['guardian_name'] ?? '—';
    $comorbidity = $data['pedia_comorbidity'] ?? '—';

    $first_vaccine_name = $data['first_vaccine_name'] ?? 'None';
    $first_date = $data['first_dose_date'] != null ? $data['first_dose_date'] : 'None';
    $first_batch = $data['first_batch_no'] != '' ? $data['first_batch_no'] : 'None';
    $first_lot = $data['first_lot_no'] != '' ? $data['first_lot_no'] : 'None';

    $second_vaccine_name = $data['second_vaccine_name'] ?? 'None';
    $second_date = $data['second_dose_date'] != null ? $data['second_dose_date'] : 'None';
    $second_batch = $data['second_batch_no'] != '' ? $data['second_batch_no'] : 'None';
    $second_lot = $data['second_lot_no'] != '' ? $data['second_lot_no'] : 'None';

    $vaccinator = $data['vaccinator_name'] ?? '—';

    $first_dose_status = !empty($data['first_dose']) ? 'Yes' : 'No';
    $second_dose_status = !empty($data['second_dose']) ? 'Yes' : 'No';
    $booster_status = !empty($data['booster']) ? 'Yes' : 'No';

?>
<div class="modal-header">
    <h5 class="modal-title">View Patient</h5>
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
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <tbody>

                <tr>
                    <th width="15%">Full Name</th>
                    <td width="35%"><?= $fullname ?></td>
                    <th width="15%">Category</th>
                    <td width="35%"><?= $category ?></td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td><?= implode(', ', array_filter([$barangay, $city, $province])) ?></td>
                    <th>Indigenous</th>
                    <td><?= $indigenous ?></td>
                </tr>

                <tr>
                    <th>PWD</th>
                    <td><?= $pwd ?></td>
                    <th>Guardian Name</th>
                    <td><?= $guardian ?></td>
                </tr>

                <tr>
                    <th>Pedia Comorbidity</th>
                    <td><?= $comorbidity ?></td>
                    <th>Vaccinator</th>
                    <td><?= $vaccinator ?></td>
                </tr>

            </tbody>
        </table>
    </div>


    <div class="table-responsive mt-4">
        <table class="table table-bordered table-sm text-center">
            <thead class="thead-light">
                <tr>
                    <th width="20%"></th>
                    <th width="40%">1st Dose</th>
                    <th width="40%">2nd Dose</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <th>Vaccine</th>
                    <td><?= $first_vaccine_name ?></td>
                    <td><?= $second_vaccine_name ?></td>
                </tr>

                <tr>
                    <th>Dose Date</th>
                    <td><?= date('M j, Y', strtotime($first_date)) ?></td>
                    <td><?= date('M j, Y', strtotime($second_date)) ?></td>
                </tr>

                <tr>
                    <th>Batch No</th>
                    <td><?= $first_batch ?></td>
                    <td><?= $second_batch ?></td>
                </tr>

                <tr>
                    <th>Lot No</th>
                    <td><?= $first_lot ?></td>
                    <td><?= $second_lot ?></td>
                </tr>

                <tr>
                    <th>Dose Given</th>
                    <td><?= $first_dose_status ?></td>
                    <td><?= $second_dose_status ?></td>
                </tr>

                <tr>
                    <th>Booster</th>
                    <td colspan="2"><?= $booster_status ?></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

