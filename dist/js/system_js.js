// window.alert = function() {};
//Setting up
function system_alert_toaster(type,message){
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
        if(type == "success"){
            toastr.success(message)
        }
        else if(type == "warning"){
            toastr.warning(message)
        }
        else{
            toastr.error(message)
        }
    });
}
function turn_off_overlay(){
    document.getElementById("overlay").style.display = "none";//this will turn off the overlay effect/ the dark background
}
function turn_off_required(id){
    document.getElementById(id).style.display = "none";//this will turn off the alert at the conformation wich is the required the dark background
}

function apear_upload_image(input, profile) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+profile)
                .attr('src', e.target.result)
                .width("100%")
                .height("100%");
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function reset_apear_upload_image(){
    document.getElementById("profile").src = "../../dist/img/default_avatar.png";
}


//Conforming for required inputs and setting up Confirm Box
function set_system_cardinal_operation(des, operation, form_id, form_file_name, table_div_id, table_file_name, table_id, required_notice, modal_open, modal_close){
    //setting conformation and required in fields!!
    var form = document.getElementById(form_id);//form ID
    var form_inputs_error = 0;
    if(operation == "create" || operation == "update" || operation == "delete"){
        for ( var i = 0; i < form.elements.length; i++ ) {
            var e = form.elements[i];
            var element_value = e.value;
            var element_alt = e.alt;
            var element_name = e.name;

            //Finding if inputs are required!!
            // Clean UP the red borders for required inputs
            if(element_alt == "required"){
                document.getElementById(required_notice).style.display = "none";
                document.getElementsByName(element_name)[0].style.borderColor = "gray"; 
                document.getElementsByName(element_name)[0].style["boxShadow"] = "none";
            }
            // Adding UP the red borders for required inputs
            if(element_alt == "required"){
                if(element_value == ""){
                    document.getElementsByName(element_name)[0].style.borderColor = "red";
                    document.getElementsByName(element_name)[0].style["boxShadow"] = "0 0 5px #f20a0a";
                    form_inputs_error++;//adding error if there is empty inputs!!
                }
            }
        }
    }

    // Conditions for inputs if there is no error!!
    if(form_inputs_error != 0){
        document.getElementById(required_notice).style.display = "block";// if error display error for required inputs
    }else{
        $('#confirmation_box').modal({ // make conformation box background unclickable!!
            backdrop: 'static',
            keyboard: false
        });
        $('#confirmation_box').modal("show");// open confirmation box

        //set data details for conformation box
        document.getElementById("overlay").style.display = "block";//this will turn on the overlay effect/ the dark background
        document.getElementById("confirmation_des").innerHTML = des;

        document.getElementById("confirmation_operation").value = operation; //the operation to do
        document.getElementById("confirmation_form_id").value = form_id; //the form id where the inputs located
        document.getElementById("confirmation_form_file_name").value = form_file_name; //the form file name where the data will be process(ajax)
        document.getElementById("confirmation_table_div_id").value = table_div_id;  // the div ID whre the table will be display
        document.getElementById("confirmation_table_file_name").value = table_file_name; //the filename to be used for table (ajax)
        document.getElementById("confirmation_table_id").value = table_id; //the id of the table for bootstrap ID
        document.getElementById("confirmation_modal_open").value = modal_open; //the modal to open
        document.getElementById("confirmation_modal_close").value = modal_close; //the modal to close
    }
}
//Ones The Operation is Confirmed
function confirmation(){
    turn_off_overlay(); 
    //Get all the values needed from input in conformation boxes!!
    var operation = document.getElementById("confirmation_operation").value;
    var form_id = document.getElementById("confirmation_form_id").value;
    var form_file_name = document.getElementById("confirmation_form_file_name").value;
    var table_div_id = document.getElementById("confirmation_table_div_id").value;
    var table_file_name = document.getElementById("confirmation_table_file_name").value;
    var table_id = document.getElementById("confirmation_table_id").value;
    var modal_open = document.getElementById("confirmation_modal_open").value;
    var modal_close = document.getElementById("confirmation_modal_close").value;

    $('#'+modal_open).modal({ // make conformation box background unclickable!!
        backdrop: 'static',
        keyboard: false
    });
    
    //The CRUDE FUNCTION!!!
    if(operation == "create"){//Create Function!!
        //Ajax code for passing the value to a certain file name!
        sys_create(operation,form_id,form_file_name,table_div_id,table_file_name,table_id);
        $('#'+modal_open).modal("show");//the modal to open
        $('#'+modal_close).modal("hide");//the modal to close
    }
    
    else if(operation == "update"){
        //Ajax code for passing the value to a certain file name!
        sys_update(operation, form_id, form_file_name, table_div_id);
    }
    else if(operation == "delete"){
        //Ajax code for passing the value to a certain file name!
        sys_delete(operation, form_id, form_file_name, table_div_id, table_file_name, table_id)
    }
    else if(operation == "select_to_create"){
        sys_select_create(operation,form_id,form_file_name,table_div_id,table_file_name,table_id);
        $('#'+modal_open).modal("show");//the modal to open
        $('#'+modal_close).modal("hide");//the modal to close
    }
    else if(operation == "select_to_delete"){
        sys_select_delete(operation,form_id,form_file_name,table_div_id,table_file_name,table_id);
        $('#'+modal_open).modal("show");//the modal to open
        $('#'+modal_close).modal("hide");//the modal to close
    }
}


//Showing Tables
function show_table(div_id, db_table, table_id, values = ""){
    var multi_values = values.split(',');
    if(multi_values[0] == "multi"){
        values = multi_values[1];
    }
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(div_id).innerHTML = this.responseText;
        $(table_id).DataTable();   
    };

    xhttp.open("GET", "../misc/selecting_table.php?table_name="+db_table+"&values="+values, true);
    xhttp.send();  
}


//Upload Function
function uploadImages(form_id){
    fetch("upload_controller.php" , {
        method : "POST",
        body: new FormData( document.getElementById(form_id))
    })
}

//Create Function
function sys_create(operation,form_id,form_file_name,table_div_id,table_file_name,table_id){
    var form_data = [];
    var form = document.getElementById(form_id);//form ID
    for ( var i = 0; i < form.elements.length; i++ ) {
        var e = form.elements[i]; 
        form_data.push(encodeURIComponent(e.name) + "=" + encodeURIComponent(e.value));
    }
    var form = form_data.join("&");

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(table_div_id).innerHTML = this.responseText;
        // uploadImages(form_id);
        $(table_id).DataTable();
        document.getElementById(form_id).reset();  
        reset_apear_upload_image();
    };
    xhttp.open("GET", form_file_name+"?operation="+operation+"&table_name="+table_file_name+"&"+form, true);
    xhttp.send();  
}


//Create Function just for selecting
function sys_select_create(operation,values,form_file_name,table_div_id,table_file_name,table_id){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(table_div_id).innerHTML = this.responseText;
        $(table_id).DataTable(); 
        reset_apear_upload_image();
    };
    xhttp.open("GET", form_file_name+"?operation="+operation+"&table_name="+table_file_name+"&primary_id="+values, true);
    xhttp.send();  
}

//Edit Function
function sys_edit(form_file_name, result_id, primary_id, required_notice, table_id){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById(result_id).innerHTML = this.responseText;
            document.getElementById(required_notice).style.display = "none";
            $(table_id).DataTable();
        }else{
            document.getElementById("loading1").style.display = "block";
        }

    };

    // Check if the filename already has a query string or parameters
    const separator = form_file_name.includes('?') ? '&' : '?';
    const url = form_file_name + separator + "primary_id=" + encodeURIComponent(primary_id);

    xhttp.open("GET", url, true);
    xhttp.send();  

    // OLD CODE
    // xhttp.open("GET", form_file_name+"?primary_id="+primary_id, true);
    // xhttp.send();  
}

//Update Function
function sys_update(operation, form_id, form_file_name, result_div){
    
    var xhttp;
    var form_data = [];
    var form = document.getElementById(form_id);//form ID
    var input_id = "";
    for ( var i = 0; i < form.elements.length; i++ ) {
        var e = form.elements[i];
        var multi_values = e.value.split(',');
        if(multi_values[0] == "multi"){
            var element_value = multi_values[1];
            var element_label = multi_values[2];
        }
        else{
            if(e.value){ //checks if all fields has values if not replace values no none!
                var element_value = e.value;
                var element_label = e.value;
            }else{
                var element_value = " ";
                var element_label = " ";
            }
        }
        
        if(e.id == 'primary_key'){
            input_id = e.value;
        }
        // This block of code is for the enrollment of a student!!so this is a costumized codes
        if(form_id == "enroll_form_student"){
            if(e.name == 'account_id'){
                var account_id = e.value;
            }if(e.name == 'academic_id'){
                var academic_id = e.value;
            }if(e.name == 'semester_id'){
                var semester_id = e.value;
            }if(e.name == 'department_id'){
                var department_id = e.value;
            }if(e.name == 'course_id'){
                var course_id = e.value;
            }if(e.name == 'year_level_id'){
                var year_level_id = e.value;
            }if(e.name == 'section_id'){
                var section_id = e.value;
            }
            input_id = account_id+"on"+academic_id+"on"+semester_id+"on"+department_id+"on"+course_id+"on"+year_level_id+"on"+section_id;
        }
        
        if(document.getElementById(input_id+"-"+e.id)){
            document.getElementById(input_id+"-"+e.id).innerHTML = element_label;
        }
        
        form_data.push(encodeURIComponent(e.name) + "=" + encodeURIComponent(element_value));
    }
    var form = form_data.join("&");
    
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(result_div).innerHTML = this.responseText;
        uploadImages(form_id);
        if(form_id == "enroll_form_student"){
            window.open('enrollment_form.php?primary_id='+input_id+'', '_blank');
        }
    };
    // document.getElementById("result_test").value = form_file_name+"?operation="+operation+"&"+form;
    xhttp.open("GET", form_file_name+"?operation="+operation+"&"+form, true);
    xhttp.send();  
}

//Selection
function selection(id,selected_values){
    var selected = document.getElementById(selected_values).value;
    var selected_id = selected.split(','); 
   
    var index = selected_id.indexOf(id);
    if (index > -1) {
        selected_id.splice(index, 1);
    }else{
        selected_id.push(id);
    }

    var selected_id_converted = selected_id.toString();
    document.getElementById(selected_values).value = selected_id_converted;
}

//Delete Function
function sys_delete(operation, form_id, form_file_name, result_div, table_file_name, table_id){
    var xhttp;

    var form_data = [];
    var form = document.getElementById(form_id);//form ID
    for ( var i = 0; i < form.elements.length; i++ ) {
        var e = form.elements[i]; 
        form_data.push(encodeURIComponent(e.name) + "=" + encodeURIComponent(e.value));
    }
    var form = form_data.join("&");
    
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(result_div).innerHTML = this.responseText;
        $(table_id).DataTable();
    };
    xhttp.open("GET", form_file_name+"?operation="+operation+"&table_name="+table_file_name+"&"+form, true);
    xhttp.send();  
}

//Delete Function just for selecting
function sys_select_delete(operation,values,form_file_name,table_div_id,table_file_name,table_id){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(table_div_id).innerHTML = this.responseText;
        $(table_id).DataTable(); 
        reset_apear_upload_image();
    };
    xhttp.open("GET", form_file_name+"?operation="+operation+"&table_name="+table_file_name+"&primary_id="+values, true);
    xhttp.send();  
}


//for Selection with conditionals Function
function select_conditional(target_div, selection_value, table_name, table_col, selection_col_name, condition, other_conditions){
    var xhttp;
   
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(target_div).innerHTML = this.responseText;
    };
    xhttp.open("GET","../misc/selection_conditional.php?selection_value="+selection_value+"&table_name="+table_name+"&table_col="+table_col+"&selection_col_name="+selection_col_name+"&condition="+condition+"&other_conditions="+other_conditions, true);
    xhttp.send();  
}


function select_for_filtering(div_id,table_file_name,table_id,target_get_inputs){
    //gathering data from inputs using the id and cols!
    var form_data = [];
    var target_get_inputs = target_get_inputs.split(','); 
    for ( var i = 0; i < target_get_inputs.length; i++ ) {
        var data = document.getElementById(target_get_inputs[i]).value;
        form_data.push(data);
    }
    var values = form_data.join(",");
    show_table(div_id,table_file_name,table_id,values);
}

function adding_and_removing_field(incrementation_value,field_name,target_result,value_to_passed=""){

    if(field_name == "adding_subject_on_schedule"){
        target_result = target_result+incrementation_value;
        var tObj = document.getElementsByClassName('add_subject_button');
        for(var i = 0; i < tObj.length; i++){
            tObj[i].value=incrementation_value + 1;
        }
    }

    var xhttp;
    var number_of_field = incrementation_value + 1;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(target_result).innerHTML = this.responseText;
    };
    xhttp.open("GET","../misc/adding_fields.php?field_name="+field_name+"&number_of_field="+number_of_field+"&value_to_passed="+value_to_passed, true);
    xhttp.send();  
}

//for inputs that is needed to be filled even the data is out of the form!
// function copy_value_in_inputs(target_inputs,data){
//     var tObj = document.getElementsByClassName(target_inputs);
//     for(var i = 0; i < tObj.length; i++){
//         tObj[i].value=data;
//     }


    //gathering data from inputs using the id and cols!
    // var form_data = [];
    // var target_get_inputs = target_get_inputs.split(','); 
    // var target_col = target_col.split(','); 
    // for ( var i = 0; i < target_get_inputs.length; i++ ) {
    //     var data = document.getElementById(target_get_inputs[i]).value;
    //     form_data.push(encodeURIComponent(target_col[i]) + "=" + encodeURIComponent(data));
    // }
    // var form = form_data.join("&");
// }

function checkURL(url_link){
    document.getElementById("loading").style.display = "block";//this will turn off the overlay effect/ the dark background
    // alert(url);
    $.ajax({
        type: 'HEAD',
        url: url_link,
        
        success: function() {
            // window.location.replace(url);
            window.frames["main_frame"].location = url_link;
            document.getElementById("loading").style.display = "none";
        },
        error: function() {
            // window.location.replace("../error/404.php");
            window.frames["main_frame"].location = "../error/404.php";
            document.getElementById("loading").style.display = "none";
        }
    });
   
}