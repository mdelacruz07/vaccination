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
    <div class="row">

        <!-- Patient Name -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Full Name:</label>
            <div class="fs-6 text-dark"><?= $fullname ?></div>
        </div>

        <!-- Category -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Category:</label>
            <div class="fs-6 text-dark"><?= $category ?></div>
        </div>

        <!-- Address -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Province:</label>
            <div class="fs-6 text-dark"><?= $province ?></div>
        </div>

        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">City/Municipality:</label>
            <div class="fs-6 text-dark"><?= $city ?></div>
        </div>

        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Barangay:</label>
            <div class="fs-6 text-dark"><?= $barangay ?></div>
        </div>

        <!-- Special Tags -->
        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Indigenous:</label>
            <div class="fs-6 text-dark"><?= $indigenous ?></div>
        </div>

        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">PWD:</label>
            <div class="fs-6 text-dark"><?= $pwd ?></div>
        </div>

        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Guardian Name:</label>
            <div class="fs-6 text-dark"><?= $guardian ?></div>
        </div>

        <div class="col-lg-6 mb-4">
            <label class="fw-bold text-muted mb-0">Pedia Comorbidity:</label>
            <div class="fs-6 text-dark"><?= $comorbidity ?></div>
        </div>
            

        <div class="d-flex col-12">
            <!-- First Dose -->
            <div class="col-6 p-0">
                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">1st Vaccine:</label>
                    <div class="fs-6 text-dark"><?= $first_vaccine_name ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">1st Dose Date:</label>
                    <div class="fs-6 text-dark"><?= $first_date ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">1st Batch No:</label>
                    <div class="fs-6 text-dark"><?= $first_batch ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">1st Lot No:</label>
                    <div class="fs-6 text-dark"><?= $first_lot ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">1st Dose Given:</label>
                    <div class="fs-6 text-dark"><?= $first_dose_status ?></div>
                </div>

            </div>

            <!-- Second Dose -->
            <div class="col-6 p-0">
                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">2nd Vaccine:</label>
                    <div class="fs-6 text-dark"><?= $second_vaccine_name ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">2nd Dose Date:</label>
                    <div class="fs-6 text-dark"><?= $second_date ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">2nd Batch No:</label>
                    <div class="fs-6 text-dark"><?= $second_batch ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">2nd Lot No:</label>
                    <div class="fs-6 text-dark"><?= $second_lot ?></div>
                </div>

                <div class="form-group mb-4">
                    <label class="fw-bold text-muted mb-0">2nd Dose Given:</label>
                    <div class="fs-6 text-dark"><?= $second_dose_status ?></div>
                </div>
            </div>
        </div>

        <!-- Vaccination Status -->
        <!-- Vaccinator -->
         <div class="col-12 d-flex">
            <div class="col-6 p-0 mb-4">
                <label class="fw-bold text-muted mb-0">Vaccinator:</label>
                <div class="fs-6 text-dark"><?= $vaccinator ?></div>
            </div>

            <div class="col-6 p-0 mb-4">
                <label class="fw-bold text-muted mb-0">Booster:</label>
                <div class="fs-6 text-dark"><?= $booster_status ?></div>
            </div>
         </div>
    </div>
</div>

