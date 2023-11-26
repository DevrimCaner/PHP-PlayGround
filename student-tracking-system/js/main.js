//Spinner
const boderSpinner = "<div class='spinner-border' role='status'> <span class='visually-hidden'>Yükleniyor...</span></div>";
//Alerts
const successAlert = "<div class='alert alert-success alert-dismissible fade show' role='alert'> <span id='infoDivAllertMessage'> </span><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
const dangerAlert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <span id='infoDivAllertMessage'> </span> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
const secondaryAlert = "<div class='alert alert-secondary alert-dismissible fade show' role='alert'> <span id='infoDivAllertMessage'> </span> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
//Functions
function GoPage(){
    console.log('GoPage')
    window.setTimeout(function(){
        window.location.href = window.location.href;            
    }, 2000);
}
function GoPageHref(href){
    console.log('GoPage')
    window.setTimeout(function(){
        window.location.href = href;            
    }, 2000);
}