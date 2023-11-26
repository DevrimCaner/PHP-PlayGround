function ADD(){
    buttonClickID = "#addButton";
    infoDivID = "#addInfoDiv";
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("name", $('#name').val());
    //POST
    $.ajax({
        url: "library/addCourse.php",
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

function DELETE(categoryId){
    buttonClickID = "#deleteButton" + categoryId.toString();
    infoDivID = "#deleteInfoDiv" + categoryId.toString();
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    var formData = new FormData();
    formData.append("deleteId", categoryId);
    //POST
    $.ajax({
        url: "library/deleteCourse.php",
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

function EditOn(categoryId){
    inputID = "#edit" + categoryId;
    textID = "#text" + categoryId;
    onButtonID = "#editOnButton" + categoryId;
    offButtonID = "#editOffButton" + categoryId;
    editButtonID = "#editButton" + categoryId;
    $(inputID).show()
    $(textID).hide()
    $(offButtonID).show()
    $(editButtonID).show()
    $(onButtonID).hide()
}
function EditOff(categoryId){
    inputID = "#edit" + categoryId;
    textID = "#text" + categoryId;
    onButtonID = "#editOnButton" + categoryId;
    offButtonID = "#editOffButton" + categoryId;
    editButtonID = "#editButton" + categoryId;
    $(inputID).hide()
    $(textID).show()
    $(offButtonID).hide()
    $(editButtonID).hide()
    $(onButtonID).show()
}

function EDIT(categoryId){
    buttonClickID = "#editButton" + categoryId.toString();
    infoDivID = "#editInfoDiv";
    $(buttonClickID).prop('disabled', true);
    $(infoDivID).html(boderSpinner);
    nameInputID = "#edit" + categoryId;
    var formData = new FormData();
    formData.append("updateId", categoryId);
    formData.append("name", $(nameInputID).val());
    //POST
    $.ajax({
        url: "library/editCourse.php",
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
  