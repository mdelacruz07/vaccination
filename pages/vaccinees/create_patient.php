<?php
    include '../../controller/systemcore.php'; 
    include '../../database/connector.php';
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $category            = trim($_GET["category"]);
    $firstname           = trim($_GET["firstname"]);
    $middlename          = trim($_GET["middlename"]);
    $lastname            = trim($_GET["lastname"]);
    $province            = trim($_GET["province"]);
    $city                = trim($_GET["city"]);
    $barangay            = trim($_GET["barangay"]);
    $indigenous          = trim($_GET["indigenous"]);
    $pwd                 = trim($_GET["pwd"]);
    $guardian_name       = trim($_GET["guardian_name"]);
    $pedia_comorbidity   = trim($_GET["pedia_comorbidity"]);

    $first_dose_date     = $_GET["first_dose_date"] ?? "0000-00-00";
    $first_vaccine_id    = trim($_GET["first_vaccine_id"]);
    $first_batch_no      = trim($_GET["first_batch_no"]);
    $first_lot_no        = trim($_GET["first_lot_no"]);

    $second_dose_date     = $_GET["second_dose_date"] ?? "0000-00-00";
    $second_vaccine_id    = trim($_GET["first_vaccine_id"]);

    $vaccinator_name     = trim($_GET["vaccinator_name"]);
    $first_dose          = trim($_GET["first_dose"]);
    $second_dose         = trim($_GET["second_dose"]);
    $booster             = trim($_GET["booster"]);

    $created_by = $_SESSION["user_id"];


    $table = "patient";

    $table_col = "
    `firstname`,
    `middlename`,
    `lastname`,
    `category`,
    `province`,
    `city`,
    `barangay`,
    `indigenous`,
    `pwd`,
    `guardian_name`,
    `pedia_comorbidity`,
    `first_dose_date`,
    `first_vaccine_id`,
    `first_batch_no`,
    `first_lot_no`,
    `second_vaccine_id`,
    `second_dose_date`,
    `vaccinator_name`,
    `first_dose`,
    `second_dose`,
    `booster`,
    `created_by`
    ";

    $table_val = "
    '$firstname',
    '$middlename',
    '$lastname',
    '$category',
    '$province',
    '$city',
    '$barangay',
    '$indigenous',
    '$pwd',
    '$guardian_name',
    '$pedia_comorbidity',
    '$first_dose_date',
    '$first_vaccine_id',
    '$first_batch_no',
    '$first_lot_no',
    '$second_vaccine_id',
    '$second_dose_date',
    '$vaccinator_name',
    '$first_dose',
    '$second_dose',
    '$booster',
    '$created_by'
    ";

    /* ------------------------------
    INSERT PATIENT RECORD
    ---------------------------------*/
    $insert = "INSERT INTO $table ($table_col) VALUES ($table_val)";
    $result = $conn->query($insert);
      
    if (!$result) {
        echo "SQL Error: " . $conn->error . "<br>";
        echo "Query: " . $insert;
        exit;
    }

    $patient_id = $conn->insert_id; // this is the vaccinee_id

    /* ------------------------------
    INSERT ISSUANCE LOG (FIRST DOSE)
    ---------------------------------*/
    if ($first_vaccine_id != 0) {
        $insert_is = "
            INSERT INTO vaccine_issuance 
            (vaccine_id, issued_type, quantity, issued_date, vaccinee_id, remarks, created_by, update_by) 
            VALUES 
            ('$first_vaccine_id', 'Used', 1, NOW(), '$patient_id', 'Used for $firstname $middlename $lastname as first dose', '$created_by', 0)
        ";

        $result_is = $conn->query($insert_is);

        if (!$result_is) {
            echo "SQL Error: " . $conn->error . "<br>";
            echo "Query: " . $insert_is;
        }
    }
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> A New transaction log Has Been Added.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = "vaccine_patient";

    $SelectTable = $systemtable->SelectingTable($table_name,'none');
?>