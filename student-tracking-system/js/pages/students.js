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