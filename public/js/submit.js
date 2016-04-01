function FormObj() {
    "use strict";
function _submitForm() {
    "use strict";
    $('body').on('submit', '#formid', function(e) {
    e.preventDefault();
    $('input[type="submit"]').prop('disabled', true);
    var _name = $("#name").val();
    var _lastname = $("#lastname").val();
    var _email = $("#email").val();
    var _subject = $("#subject").val();    
    var _message = $("#message").val();    
    var _token = $("#token").val();    
    var _submit = "Submit";
    $.ajax({
        type: "POST",
        url: "/public/contacts",
        data: 
            "name="         + _name + 
            "&lastname="    + _lastname + 
            "&email="       + _email + 
            "&subject="     + _subject + 
            "&message="     + _message +
            "&action="      + _submit +
            "&token="      + _token,
        success : function(data){            
            if(data != "true"){
               window.location = "/public/contacts";}
            else {
              window.location = "/public/contacts";}}}); // $.ajax        
    }); //e.preventDefault();
    } // function _submitForm()
    function _formSuccess(){
    "use strict";
    alert("Success");
        $(".flash")
            .empty()
            .removeClass("error none")
            .append("It works! Thanks for filling out our form. An email has been sent with your request")
            .addClass('success', 5000, "easeOutBounce");
        $('#formid')
            .trigger("reset");
        $('input[type="submit"]').prop('disabled', true);
        console.log($("span.green").removeClass('green'));} // function _formSuccess()
    function _formEmpty(){
    "use strict";
    alert("Remove");
        $(".flash")
            .empty()
            .removeClass("success none")
            .append("Red Color. Empty All")
            .addClass('error');} // function _formEmpty()
    this.init = function() {
    "use strict";
    $("document")
        .ready(function() {
        _submitForm();
    });
    } // this.init = function()
} // function jsQbj

$('input[type="submit"]').prop('disabled', true);
var formObj = new FormObj();
formObj.init();
 
 $('.clear-button').addClass('none');

$(document).on('click', '.clear-button', function(){
$(this).prev().val("").change();});