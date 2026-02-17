<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

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

    $first_batch_no      = trim($_GET["first_batch_no"]);
    $first_lot_no        = trim($_GET["first_lot_no"]);

    $second_dose_date     = $_GET["second_dose_date"];
    $second_vaccine_id    = trim($_GET["second_vaccine_id"]);
    $second_batch_no      = trim($_GET["second_batch_no"]);
    $second_lot_no        = trim($_GET["second_lot_no"]);

    $vaccinator_name     = trim($_GET["vaccinator_name"]);
    $first_dose          = trim($_GET["first_dose"]);
    $second_dose         = trim($_GET["second_dose"]);
    $booster             = trim($_GET["booster"]);

    $updated_by = $_SESSION["user_id"];

    $table = "patient";
    $col_to_update = "category = '$category',
                      firstname = '$firstname',
                      middlename = '$middlename',
                      lastname = '$lastname',
                      province = '$province',
                      city = '$city',
                      barangay = '$barangay',
                      indigenous = '$indigenous',
                      pwd = '$pwd',
                      guardian_name = '$guardian_name',
                      pedia_comorbidity = '$pedia_comorbidity',
                      first_batch_no = '$first_batch_no',
                      first_lot_no = '$first_lot_no',
                      second_dose_date = '$second_dose_date',
                      second_vaccine_id = '$second_vaccine_id',
                      second_batch_no = '$second_batch_no',
                      second_lot_no = '$second_lot_no',
                      vaccinator_name = '$vaccinator_name',
                      first_dose = '$first_dose',
                      second_dose = '$second_dose',
                      booster = '$booster',
                      update_by='$updated_by',
                      update_at=CURRENT_TIMESTAMP
                     ";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Patient Has Been Updated.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $SelectTable = $systemtable->SelectingTable($table, 'none');
?>