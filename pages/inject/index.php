<?php
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
//Data With Default value
    $current_residence = "N/A";
    $civil_status = "N/A";
    $employment_status = "N/A";
    $sub_category ="N/A";
    $province = "_0645_NEGROS_OCCIDENTAL";
    $city = "_64502_BAGO_CITY";
    $region = "06_Western_Visayas";
    $idcategory = "N/A";
    $idnumber = "N/A";
    $phid = "N/A";
    $pwdid = "N/A";
    $suffix ="N/A";
    $pregnant = "N/A";
    $covid_status = "N/A";
    $covid_exposure = "N/A";
    $medical_clearance = "N/A";
    $occupation = "N/A";
    $agency = "N/A";
    $if_allergy = "N/A";
    $if_severe_allergic = "N/A";
    $bleeding_disorders = "N/A";
    $allergies_to_PEG = "N/A";
    $allergy = "N/A";
    $if_bleeding = "N/A";
    $symtoms = "N/A";
    $if_receive_vaccine = "N/A";
    $convalescent = "N/A";
    $if_pregnant = "N/A";
    $comorbidity = "N/A";
    $prof_vaccinator = "N/A";
    $defferal = "N/A";
    $reason_refusal = "N/A";
    $indigenous = "N/A";
    $pwd ="N/A";
    $adverse_event = "N/A";
    $adverse_event_cons = "N/A";
    $allergy_to_vaccine = "N/A";
    $profile_comorbidity = "N/A";
    $ped_comorbid = "N/A";
    $encoded = "YES";
    $brgy_array = array("_64502001_ABUANAN", "_64502002_ALIANZA", "_64502003_ATIPULUAN", "_64502004_BACONG_MONTILLA", "_64502005_BAGROY", "_64502006_BALINGASAG", "_64502007_BINUBUHAN", "_64502008_BUSAY", "_64502009_CALUMANGAN", "_64502010_CARIDAD", "_64502011_DULAO", "_64502012_ILIJAN", "_64502013_LAG_ASAN", "_64502014_MA_AO_BARRIO", "_64502015_JORGE_L._ARANETA_(MA_AO_CENTRAL)", "_64502016_MAILUM", "_64502017_MALINGIN", "_64502018_NAPOLES", "_64502019_PACOL", "_64502020_POBLACION", "_64502021_SAGASA", "_64502022_TABUNAN", "_64502023_TALOC", "_64502024_SAMPINIT");
    $contact = "123456789";
    $gender_array = array("01_Female","02_Male");
    $encoded_by = "Auto Generated";
    $lastname_array = array('Abbott','Acevedo','Acosta','Adams','Adkins','Aguilar','Aguirre','Albert','Alexander','Alford','Allen','Allison','Alston','Alvarado','Alvarez','Anderson','Andrews','Anthony','Armstrong','Arnold','Ashley','Atkins','Atkinson','Austin','Avery','Avila','Ayala','Ayers','Bailey','Baird','Baker','Baldwin','Ball','Ballard','Banks','Barber','Barker','Barlow','Barnes','Barnett','Barr','Barrera','Barrett','Barron','Barry','Bartlett','Barton','Bass','Bates','Battle','Bauer','Baxter','Beach','Bean','Beard','Beasley','Beck','Becker','Bell','Bender','Benjamin','Bennett','Benson','Bentley','Benton','Berg','Berger','Bernard','Berry','Best','Bird','Bishop','Black','Blackburn','Blackwell','Blair','Blake','Blanchard','Blankenship','Blevins','Bolton','Bond','Bonner','Booker','Boone','Booth','Bowen','Bowers','Bowman','Boyd','Boyer','Boyle','Bradford','Bradley','Bradshaw','Brady','Branch','Bray','Brennan','Brewer','Bridges','Briggs','Bright','Britt','Brock','Brooks','Brown','Browning','Bruce','Bryan','Bryant','Buchanan','Buck','Buckley','Buckner','Bullock','Burch','Burgess','Burke','Burks','Burnett','Burns','Burris','Burt','Burton','Bush','Butler','Byers','Byrd','Cabrera','Cain','Calderon','Caldwell','Calhoun','Callahan','Camacho','Cameron','Campbell','Campos','Cannon','Cantrell','Cantu','Cardenas','Carey','Carlson','Carney','Carpenter','Carr','Carrillo','Carroll','Carson','Carter','Carver','Case','Casey','Cash','Castaneda','Castillo','Castro','Cervantes','Chambers','Chan','Chandler','Chaney','Chang','Chapman','Charles','Chase','Chavez','Chen','Cherry','Christensen','Christian','Church','Clark','Clarke','Clay','Clayton','Clements','Clemons','Cleveland','Cline','Cobb','Cochran','Coffey','Cohen','Cole','Coleman','Collier','Collins','Colon','Combs','Compton','Conley','Conner','Conrad','Contreras','Conway','Cook','Cooke','Cooley','Cooper','Copeland','Cortez','Cote','Cotton','Cox','Craft','Craig','Crane','Crawford','Crosby','Cross','Cruz','Cummings','Cunningham','Curry','Curtis','Dale','Dalton','Daniel','Daniels','Daugherty','Davenport','David','Davidson','Davis','Dawson','Day','Dean','Decker','Dejesus','Delacruz','Delaney','Deleon','Delgado','Dennis','Diaz','Dickerson','Dickson','Dillard','Dillon','Dixon','Dodson','Dominguez','Donaldson','Donovan','Dorsey','Dotson','Douglas','Downs','Doyle','Drake','Dudley','Duffy','Duke','Duncan','Dunlap','Dunn','Duran','Durham','Dyer','Eaton','Edwards','Elliott','Ellis','Ellison','Emerson','England','English','Erickson','Espinoza','Estes','Estrada','Evans','Everett','Ewing','Farley','Farmer','Farrell','Faulkner','Ferguson','Fernandez','Ferrell','Fields','Figueroa','Finch','Finley','Fischer','Fisher','Fitzgerald','Fitzpatrick','Fleming','Fletcher','Flores','Flowers','Floyd','Flynn','Foley','Forbes','Ford','Foreman','Foster','Fowler','Fox','Francis','Franco','Frank','Franklin','Franks','Frazier','Frederick','Freeman','French','Frost','Fry','Frye','Fuentes','Fuller','Fulton','Gaines','Gallagher','Gallegos','Galloway','Gamble','Garcia','Gardner','Garner','Garrett','Garrison','Garza','Gates','Gay','Gentry','George','Gibbs','Gibson','Gilbert','Giles','Gill','Gillespie','Gilliam','Gilmore','Glass','Glenn','Glover','Goff','Golden','Gomez','Gonzales','Gonzalez','Good','Goodman','Goodwin','Gordon','Gould','Graham','Grant','Graves','Gray','Green','Greene','Greer','Gregory','Griffin','Griffith','Grimes','Gross','Guerra','Guerrero','Guthrie','Gutierrez','Guy','Guzman','Hahn','Hale','Haley','Hall','Hamilton','Hammond','Hampton','Hancock','Haney','Hansen','Hanson','Hardin','Harding','Hardy','Harmon','Harper','Harrell','Harrington','Harris','Harrison','Hart','Hartman','Harvey','Hatfield','Hawkins','Hayden','Hayes','Haynes','Hays','Head','Heath','Hebert','Henderson','Hendricks','Hendrix','Henry','Hensley','Henson','Herman','Hernandez','Herrera','Herring','Hess','Hester','Hewitt','Hickman','Hicks','Higgins','Hill','Hines','Hinton','Hobbs','Hodge','Hodges','Hoffman','Hogan','Holcomb','Holden','Holder','Holland','Holloway','Holman','Holmes','Holt','Hood','Hooper','Hoover','Hopkins','Hopper','Horn','Horne','Horton','House','Houston','Howard','Howe','Howell','Hubbard','Huber','Hudson','Huff','Huffman','Hughes','Hull','Humphrey','Hunt','Hunter','Hurley','Hurst','Hutchinson','Hyde','Ingram','Irwin','Jackson','Jacobs','Jacobson','James','Jarvis','Jefferson','Jenkins','Jennings','Jensen','Jimenez','Johns','Johnson','Johnston','Jones','Jordan','Joseph','Joyce','Joyner','Juarez','Justice','Kane','Kaufman','Keith','Keller','Kelley','Kelly','Kemp','Kennedy','Kent','Kerr','Key','Kidd','Kim','King','Kinney','Kirby','Kirk','Kirkland','Klein','Kline','Knapp','Knight','Knowles','Knox','Koch','Kramer','Lamb','Lambert','Lancaster','Landry','Lane','Lang','Langley','Lara','Larsen','Larson','Lawrence','Lawson','Le','Leach','Leblanc','Lee','Leon','Leonard','Lester','Levine','Levy','Lewis','Lindsay','Lindsey','Little','Livingston','Lloyd','Logan','Long','Lopez','Lott','Love','Lowe','Lowery','Lucas','Luna','Lynch','Lynn','Lyons','Macdonald','Macias','Mack','Madden','Maddox','Maldonado','Malone','Mann','Manning','Marks','Marquez','Marsh','Marshall','Martin','Martinez','Mason','Massey','Mathews','Mathis','Matthews','Maxwell','May','Mayer','Maynard','Mayo','Mays','Mcbride','Mccall','Mccarthy','Mccarty','Mcclain','Mcclure','Mcconnell','Mccormick','Mccoy','Mccray','Mccullough','Mcdaniel','Mcdonald','Mcdowell','Mcfadden','Mcfarland','Mcgee','Mcgowan','Mcguire','Mcintosh','Mcintyre','Mckay','Mckee','Mckenzie','Mckinney','Mcknight','Mclaughlin','Mclean','Mcleod','Mcmahon','Mcmillan','Mcneil','Mcpherson','Meadows','Medina','Mejia','Melendez','Melton','Mendez','Mendoza','Mercado','Mercer','Merrill','Merritt','Meyer','Meyers','Michael','Middleton','Miles','Miller','Mills','Miranda','Mitchell','Molina','Monroe','Montgomery','Montoya','Moody','Moon','Mooney','Moore','Morales','Moran','Moreno','Morgan','Morin','Morris','Morrison','Morrow','Morse','Morton','Moses','Mosley','Moss','Mueller','Mullen','Mullins','Munoz','Murphy','Murray','Myers','Nash','Navarro','Neal','Nelson','Newman','Newton','Nguyen','Nichols','Nicholson','Nielsen','Nieves','Nixon','Noble','Noel','Nolan','Norman','Norris','Norton','Nunez','Obrien','Ochoa','Oconnor','Odom','Odonnell','Oliver','Olsen','Olson','Oneal','Oneil','Oneill','Orr','Ortega','Ortiz','Osborn','Osborne','Owen','Owens','Pace','Pacheco','Padilla','Page','Palmer','Park','Parker','Parks','Parrish','Parsons','Pate','Patel','Patrick','Patterson','Patton','Paul','Payne','Pearson','Peck','Pena','Pennington','Perez','Perkins','Perry','Peters','Petersen','Peterson','Petty','Phelps','Phillips','Pickett','Pierce','Pittman','Pitts','Pollard','Poole','Pope','Porter','Potter','Potts','Powell','Powers','Pratt','Preston','Price','Prince','Pruitt','Puckett','Pugh','Quinn','Ramirez','Ramos','Ramsey','Randall','Randolph','Rasmussen','Ratliff','Ray','Raymond','Reed','Reese','Reeves','Reid','Reilly','Reyes','Reynolds','Rhodes','Rice','Rich','Richard','Richards','Richardson','Richmond','Riddle','Riggs','Riley','Rios','Rivas','Rivera','Rivers','Roach','Robbins','Roberson','Roberts','Robertson','Robinson','Robles','Rocha','Rodgers','Rodriguez','Rodriquez','Rogers','Rojas','Rollins','Roman','Romero','Rosa','Rosales','Rosario','Rose','Ross','Roth','Rowe','Rowland','Roy','Ruiz','Rush','Russell','Russo','Rutledge','Ryan','Salas','Salazar','Salinas','Sampson','Sanchez','Sanders','Sandoval','Sanford','Santana','Santiago','Santos','Sargent','Saunders','Savage','Sawyer','Schmidt','Schneider','Schroeder','Schultz','Schwartz','Scott','Sears','Sellers','Serrano','Sexton','Shaffer','Shannon','Sharp','Sharpe','Shaw','Shelton','Shepard','Shepherd','Sheppard','Sherman','Shields','Short','Silva','Simmons','Simon','Simpson','Sims','Singleton','Skinner','Slater','Sloan','Small','Smith','Snider','Snow','Snyder','Solis','Solomon','Sosa','Soto','Sparks','Spears','Spence','Spencer','Stafford','Stanley','Stanton','Stark','Steele','Stein','Stephens','Stephenson','Stevens','Stevenson','Stewart','Stokes','Stone','Stout','Strickland','Strong','Stuart','Suarez','Sullivan','Summers','Sutton','Swanson','Sweeney','Sweet','Sykes','Talley','Tanner','Tate','Taylor','Terrell','Terry','Thomas','Thompson','Thornton','Tillman','Todd','Torres','Townsend','Tran','Travis','Trevino','Trujillo','Tucker','Turner','Tyler','Tyson','Underwood','Valdez','Valencia','Valentine','Valenzuela','Vance','Vang','Vargas','Vasquez','Vaughan','Vaughn','Vazquez','Vega','Velasquez','Velazquez','Velez','Villarreal','Vincent','Vinson','Wade','Wagner','Walker','Wall','Wallace','Waller','Walls','Walsh','Walter','Walters','Walton','Ward','Ware','Warner','Warren','Washington','Waters','Watkins','Watson','Watts','Weaver','Webb','Weber','Webster','Weeks','Weiss','Welch','Wells','West','Wheeler','Whitaker','White','Whitehead','Whitfield','Whitley','Whitney','Wiggins','Wilcox','Wilder','Wiley','Wilkerson','Wilkins','Wilkinson','William','Williams','Williamson','Willis','Wilson','Winters','Wise','Witt','Wolf','Wolfe','Wong','Wood','Woodard','Woods','Woodward','Wooten','Workman','Wright','Wyatt','Wynn','Yang','Yates','York','Young','Zamora','Zimmerman');
    $firstname_array = array('Allison','Arthur','Ana','Alex','Arlene','Alberto','Barry','Bertha','Bill','Bonnie','Bret','Beryl','Chantal','Cristobal','Claudette','Charley','Cindy','Chris','Dean','Dolly','Danny','Danielle','Dennis','Debby','Erin','Edouard','Erika','Earl','Emily','Ernesto','Felix','Fay','Fabian','Frances','Franklin','Florence','Gabielle','Gustav','Grace','Gaston','Gert','Gordon','Humberto','Hanna','Henri','Hermine','Harvey','Helene','Iris','Isidore','Isabel','Ivan','Irene','Isaac','Jerry','Josephine','Juan','Jeanne','Jose','Joyce','Karen','Kyle','Kate','Karl','Katrina','Kirk','Lorenzo','Lili','Larry','Lisa','Lee','Leslie','Michelle','Marco','Mindy','Maria','Michael','Noel','Nana','Nicholas','Nicole','Nate','Nadine','Olga','Omar','Odette','Otto','Ophelia','Oscar','Pablo','Paloma','Peter','Paula','Philippe','Patty','Rebekah','Rene','Rose','Richard','Rita','Rafael','Sebastien','Sally','Sam','Shary','Stan','Sandy','Tanya','Teddy','Teresa','Tomas','Tammy','Tony','Van','Vicky','Victor','Virginie','Vince','Valerie','Wendy','Wilfred','Wanda','Walter','Wilma','William','Kumiko','Aki','Miharu','Chiaki','Michiyo','Itoe','Nanaho','Reina','Emi','Yumi','Ayumi','Kaori','Sayuri','Rie','Miyuki','Hitomi','Naoko','Miwa','Etsuko','Akane','Kazuko','Miyako','Youko','Sachiko','Mieko','Toshie','Junko');
    $guardian = "N/A";
    $consent = "01_Yes";

$count = 150;//<-----------------------CHANGE
$facility_id = "CBC04042";//<-----------------------CHANGE
$time_stamp = "2021-12-01";//<-----------------------CHANGE
$dose_1 = "01_Yes";//<-----------------------CHANGE
$dose_2 = "02_No";//<-----------------------CHANGE
$vaccinator_name_array = array("JARA JULIE","JALEA CHERRY","DEOCOS NOLIRYN","VICENTE RIC DONALD");//<-----------------------CHANGE
$vaccine_name_array = array("Pfizer","Moderna","Pfizer","Moderna");//<-----------------------CHANGE
$employmentcategory_array = array("12_C: Rest of Adult Population","13_C: Rest of Pediatric Population");//<-----------------------CHANGE

for($x=0;$x < $count;$x++){
    $letters=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $code_gen = $letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99);
    $brgy = $brgy_array[rand(0, 23)];
    $gender = $gender_array[rand(0, 1)];
    $vaccinator_name = $vaccinator_name_array[rand(0, 3)];
 
    $employmentcategory = $employmentcategory_array[rand(0, 1)];
    $bday = "199".rand(0, 9)."-".rand(1, 12)."-".rand(1, 25);
    $lastname = strtoupper($lastname_array[rand(0, 950)]);
    $firstname = strtoupper($firstname_array[rand(0, 100)]);
    $middlename = strtoupper($lastname_array[rand(0, 950)]);
    if($employmentcategory == "13_C: Rest of Pediatric Population"){
        $guardian = strtoupper($firstname_array[rand(0, 100)])." ".$middlename." ".$lastname;
	$bday = "200".rand(4, 8)."-".rand(1, 12)."-".rand(1, 25);
    }else{
	$guardian = "N/A";
    }

    $vaccine_name = $vaccine_name_array[rand(0, 3)];
	//$vaccine_name = "Pfizer";
	//$vaccine_name = "Moderna";

    if($vaccine_name == "Pfizer"){
	$batch_number = "32155BA";//<-----------------------CHANGE
	$lot_number = "32155BA";//<-----------------------CHANGE
    }
    if($vaccine_name == "Moderna"){
	$batch_number = "086J21A";//<-----------------------CHANGE
	$lot_number = "086J21A";//<-----------------------CHANGE
    }
    
    $table = "local_data_fetcher";
    $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, employment_status, ocupation, agency, current_residence, pregnant, covid_status, covid_exposure, reason_refusal, if_severe_allergic, allergy, if_allergy, dose_1, dose_2, allergies_to_PEG, bleeding_disorders, if_bleeding, symtoms, if_receive_vaccine, comorbidity, consent, defferal, time_stamp, convalescent, if_pregnant, vaccine_name, batch_number, lot_number, vaccinator_name, prof_vaccinator, medical_clearance, allergy_to_vaccine, profile_comorbidity, qr_id, encoded, indigenous, pwd, adverse_event, adverse_event_cons, encoded_by, facility_id, guardian, ped_comorbid";
    $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$occupation', '$agency', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$code_gen', '$encoded', '$indigenous', '$pwd', '$adverse_event', '$adverse_event_cons', '$encoded_by', '$facility_id', '$guardian', '$ped_comorbid'"; 
    //$InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
    echo "SYSTEM INSERTED ".$vaccine_name." ".$firstname." ".$middlename." ==>>>> DATA ENTRY INJECTION ===>> DATA NUMBER $x <BR>";
}
?>