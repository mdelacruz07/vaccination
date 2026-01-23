<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['id'];
    $info_id = explode("cut", $id);
    $id=$info_id[0];
    $dose=$info_id[1];

    session_start();
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM post_vaccination WHERE id = '$id'");
    foreach($SelectTable as $value){
        $id = $value['id'];
        $firstname = $value['firstname'];
        $middlename = $value['middlename'];
        $lastname = $value['lastname'];
        $initial_VS = $value['initial_VS'];
        if($dose == "01_Yes"){
            $addmission_time_hour = $value['addmission_time_hour_1'];
            $addmission_time_minute = $value['addmission_time_minute_1'];
            $discharge_time_hour = $value['discharge_time_hour_1'];
            $discharge_time_minute = $value['discharge_time_minute_1'];
            $BP_1 = $value['BP_1_1'];
            $BP_2 = $value['BP_2_1'];
            $BP_3 = $value['BP_3_1'];
            $remarks = $value['remarks_1'];
            $dose = "2nd Dose";
        }else{
            $addmission_time_hour = $value['addmission_time_hour'];
            $addmission_time_minute = $value['addmission_time_minute'];
            $discharge_time_hour = $value['discharge_time_hour'];
            $discharge_time_minute = $value['discharge_time_minute'];
            $BP_1 = $value['BP_1'];
            $BP_2 = $value['BP_2'];
            $BP_3 = $value['BP_3'];
            $remarks = $value['remarks'];
            $dose = "1st Dose";
        }
        $brgy = $value['brgy'];
        $bday = $value['bday'];
        $age = date_diff(date_create(), date_create($bday));
        $age = $age->format("%Y");
    }
    include '../inc/header.php';
	// print_bg.jpg
    ?>

<form id ="update_form" enctype="multipart/form-data" class="col-6 offset-3 mb-0 " >
	<center><img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 80px; hight:80px;"></center>
	<center>
		<p style="font-size:14px; margin:none; padding:none;"><b  style="font-size:14px;">Bago City Health Office</b><br>Vaccine Information Management System</p>
    	<b style="font-size:14px;">Post vaccination Monitoring</b><br>
		<b style="font-size:14px;"><?php echo date("F d Y"); ?></b><br></center>
		<hr class=" p-0 m-0">
    <div class="modal-body p-2 m-0" style="background: url(../../dist/img/print_bg.jpg); background-repeat: no-repeat; background-size: auto; border:2px dashed green;">
        <div class="row p-0 m-0">
            
            <div class="row col-sm-12 p-0 m-0">
                <div class="form-group col-lg-12 p-0 m-0">
                    <label>Full Name:</label>
                    <div class="row p-0 m-0">
						<p class="col-4 text-center"><?php echo $firstname; ?></p> 
						<p class="col-4 text-center"><?php echo $middlename; ?></p> 
						<p class="col-4 text-center"><?php echo $lastname; ?></p> 
                    </div>
                    <div class="row p-0 m-0">
						<p class="col-7 text-left"><b>Address:</b></p> 
						<p class="col-3 text-center"><b>Birthday:</b></p> 
						<p class="col-2 text-center"><b>Age:</b></p> 
						<p class="col-7 text-left"><?php echo $brgy; ?></p> 
						<p class="col-3 text-center"><?php echo $bday; ?></p> 
						<p class="col-2 text-center"><?php echo $age; ?></p> 
                    </div>
                </div>

                <div class="form-group col-12 p-0 m-0">
					<hr class=" p-0 m-0">
                    <center><label class="m-0 p-0" style="font-size:12px;"><u><?php echo $dose; ?></u></label><center>
					<label>Initial Vital Sign:</label>
                        <div class="row p-0 m-0">
							<p class="col-4 text-center"><b>Blood Pressure</b></p> 
							<p class="col-4 text-center"><b>SPO<sub>2</sub></b></p> 
							<p class="col-4 text-center"><b>Pulse Rate</b></p> 

							<p class="col-4 text-center"><?php echo $BP_1; ?></p> 
							<p class="col-4 text-center"><?php echo $BP_2; ?></p> 
							<p class="col-4 text-center"><?php echo $BP_3; ?></p> 
                        </div>
                </div>

                <div class="form-group col-lg-12 p-0 m-0">
                    <label></label>
                    <div class="row p-0 m-0">
						<p class="col-6 text-center"><b>Admission Time:</b></p> 
						<p class="col-6 text-center"><b>Discharge Time:</b></p> 
						<p class="col-6 text-center"><?php echo $addmission_time_hour; ?>:<?php echo $addmission_time_minute; ?></p>
						<p class="col-6 text-center"><?php echo $discharge_time_hour; ?>:<?php echo $discharge_time_minute; ?></p>
                    </div>
                </div>
				<div class="form-group col-12 p-0 m-0">
                <label>Remarks:</label>
				<br>
				<Br>
				<br>
				<Br>
				<br>
				<Br>
				<br>
				</div>
            </div>
        </div>
    </div>
</form> 
<script>
// window.open();
// window.print();
// window.close();
window.print();
</script>
<?php
include '../inc/footer.php'; ?>