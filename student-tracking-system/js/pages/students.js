function ADD(){
    buttonClickID = "#addButton";
    infoDivID = "#addInfoDiv";
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("firstName", $('#firstName').val());
    formData.append("lastName", $('#lastName').val());
    formData.append("birthDate", $('#birthDate').val());
    //POST
    $.ajax({
        url: "library/addStudent.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        processData: false,
        success:function(result){
            $(buttonClickID).prop('disabled', false);
            $(infoDivID).html("");
            //Converting JSON data to object
            try {
                result = JSON.parse($.trim(result));
            }
            catch(err) {
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Hata');
                console.log(result);
                return;
            }
            
            //Show Message
            if (result.status == "error") {
                $(infoDivID).html(dangerAlert);
                $("#infoDivAllertMessage").html(result.message);
            }
            else if(result.status == 'success'){
                $(buttonClickID).prop('disabled', true);
                $(infoDivID).html(successAlert);
                $("#infoDivAllertMessage").html(result.message);
                GoPage()
            }
            else {
                console.log(result);
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
            }
        },
        error: function(xhr, status, error) {
            $(buttonClickID).prop('disabled', false);
            console.log(xhr.responseText);
            $(infoDivID).html(dangerAlert);
            $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
          }
    });
  }

  function ADDGrade(){
    buttonClickID = "#addButton";
    infoDivID = "#addInfoDiv";
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("course", $("#course").val());
    formData.append("student", $("#student").val());
    formData.append("visa", $("#visa").val());
    formData.append("final", $("#final").val());
    //POST
    $.ajax({
        url: "library/addGrade.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        processData: false,
        success:function(result){
            $(buttonClickID).prop('disabled', false);
            $(infoDivID).html("");
            //Converting JSON data to object
            try {
                result = JSON.parse($.trim(result));
            }
            catch(err) {
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Hata');
                console.log(result);
                return;
            }
            
            //Show Message
            if (result.status == "error") {
                $(infoDivID).html(dangerAlert);
                $("#infoDivAllertMessage").html(result.message);
            }
            else if(result.status == 'success'){
                $(buttonClickID).prop('disabled', true);
                $(infoDivID).html(successAlert);
                $("#infoDivAllertMessage").html(result.message);
                GoPage()
            }
            else {
                console.log(result);
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
            }
        },
        error: function(xhr, status, error) {
            $(buttonClickID).prop('disabled', false);
            console.log(xhr.responseText);
            $(infoDivID).html(dangerAlert);
            $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
          }
    });
  }

  function DELETEGrade(deleteId){
    buttonClickID = "#deleteButton" + deleteId.toString();
    infoDivID = "#deleteInfoDiv" + deleteId.toString();
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("deleteId", deleteId);
    //POST
    $.ajax({
        url: "library/deleteGrade.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        processData: false,
        success:function(result){
            $(buttonClickID).prop('disabled', false);
            $(infoDivID).html("");
            //Converting JSON data to object
            try {
                result = JSON.parse($.trim(result));
            }
            catch(err) {
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Hata');
                console.log(result);
                return;
            }
            
            //Show Message
            if (result.status == "error") {
                $(infoDivID).html(dangerAlert);
                $("#infoDivAllertMessage").html(result.message);
            }
            else if(result.status == 'success'){
                $(buttonClickID).prop('disabled', true);
                $(infoDivID).html(successAlert);
                $("#infoDivAllertMessage").html(result.message);
                GoPage()
            }
            else {
                console.log(result);
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
            }
        },
        error: function(xhr, status, error) {
            $(buttonClickID).prop('disabled', false);
            console.log(xhr.responseText);
            $(infoDivID).html(dangerAlert);
            $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
          }
    });
}

function DELETE(deleteId){
    buttonClickID = "#deleteButton";
    infoDivID = "#deleteInfoDiv";
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("deleteId", deleteId);
    //POST
    $.ajax({
        url: "library/deleteStudent.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        processData: false,
        success:function(result){
            $(buttonClickID).prop('disabled', false);
            $(infoDivID).html("");
            //Converting JSON data to object
            try {
                result = JSON.parse($.trim(result));
            }
            catch(err) {
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Hata');
                console.log(result);
                return;
            }
            
            //Show Message
            if (result.status == "error") {
                $(infoDivID).html(dangerAlert);
                $("#infoDivAllertMessage").html(result.message);
            }
            else if(result.status == 'success'){
                $(buttonClickID).prop('disabled', true);
                $(infoDivID).html(successAlert);
                $("#infoDivAllertMessage").html(result.message);
                GoPageHref('index.php?page=students')
            }
            else {
                console.log(result);
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
            }
        },
        error: function(xhr, status, error) {
            $(buttonClickID).prop('disabled', false);
            console.log(xhr.responseText);
            $(infoDivID).html(dangerAlert);
            $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
          }
    });
}

function EDITGrade(editId){
    visaEdit = "#visaEdit" + editId.toString();
    finalEdit = "#finalEdit" + editId.toString();
    buttonClickID = "#editButton" + editId.toString();
    infoDivID = "#editInfoDiv";
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("updateId", editId);
    formData.append("visa", $(visaEdit).val());
    formData.append("final", $(finalEdit).val());
    //POST
    $.ajax({
        url: "library/editGrade.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        processData: false,
        success:function(result){
            $(buttonClickID).prop('disabled', false);
            $(infoDivID).html("");
            //Converting JSON data to object
            try {
                result = JSON.parse($.trim(result));
            }
            catch(err) {
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Hata');
                console.log(result);
                return;
            }
            
            //Show Message
            if (result.status == "error") {
                $(infoDivID).html(dangerAlert);
                $("#infoDivAllertMessage").html(result.message);
            }
            else if(result.status == 'success'){
                $(buttonClickID).prop('disabled', true);
                $(infoDivID).html(successAlert);
                $("#infoDivAllertMessage").html(result.message);
                GoPage()
            }
            else {
                console.log(result);
                $(infoDivID).html(secondaryAlert);
                $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
            }
        },
        error: function(xhr, status, error) {
            $(buttonClickID).prop('disabled', false);
            console.log(xhr.responseText);
            $(infoDivID).html(dangerAlert);
            $("#infoDivAllertMessage").html('Bilinmeyen Mesaj');
          }
    });
}

function EditOn(editId){
    visaEdit = "#visaEdit" + editId;
    visaText = "#visaText" + editId;
    finalEdit = "#finalEdit" + editId;
    finalText = "#finalText" + editId;
    averageText = '#averageText' + editId;
    averageEdit = '#averageEdit' + editId;
    onButtonID = "#editOnButton" + editId;
    offButtonID = "#editOffButton" + editId;
    editButtonID = "#editButton" + editId;
    $(visaEdit).show()
    $(visaText).hide()
    $(finalEdit).show()
    $(finalText).hide()
    $(averageEdit).show()
    $(averageText).hide()
    $(offButtonID).show()
    $(editButtonID).show()
    $(onButtonID).hide()
    $(visaEdit).change(function(){
        $(averageEdit).val((parseFloat($(visaEdit).val()) * 0.4) + (parseFloat($(finalEdit).val()) * 0.6))
    });
    $(finalEdit).change(function(){
        $(averageEdit).val((parseFloat($(visaEdit).val()) * 0.4) + (parseFloat($(finalEdit).val()) * 0.6))
    });
}
function EditOff(editId){
    visaEdit = "#visaEdit" + editId;
    visaText = "#visaText" + editId;
    finalEdit = "#finalEdit" + editId;
    finalText = "#finalText" + editId;
    averageText = '#averageText' + editId;
    averageEdit = '#averageEdit' + editId;
    onButtonID = "#editOnButton" + editId;
    offButtonID = "#editOffButton" + editId;
    editButtonID = "#editButton" + editId;
    $(visaEdit).hide()
    $(visaText).show()
    $(finalEdit).hide()
    $(finalText).show()
    $(averageEdit).hide()
    $(averageText).show()
    $(offButtonID).hide()
    $(editButtonID).hide()
    $(onButtonID).show()
}

$("#visa").change(CalcAverage);
$("#final").change(CalcAverage);
function CalcAverage(){
$("#average").val((parseFloat($("#visa").val()) * 0.4) + (parseFloat($("#final").val()) * 0.6))
}