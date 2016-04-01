function ChangeObj() {
    "use strict";
    function _changeInput() {
        "use strict";
        $('body').on({
            change: function(e) {
            _checkChanges();
            var element = $(this);                
            var _elementVal = element.val();
            var _elementId = element.attr('id');
            var _attr = _elementId + "=";
            var _submit = "onChange";
            if (_elementVal == ''){
                $('.min.' + _elementId)
                    .addClass("none")
                    .parent()
                    .removeClass("green");
                $('input[type="submit"]').prop('disabled', true);
                $('#' + _elementId + ' + .clear-button')
                    .addClass("none");}
            else {
                $('#' + _elementId + ' + .clear-button')
                    .removeClass("none");                
                $.ajax({
                    type: "POST",
                    url: "/public/contacts",
                    data: 
                        _attr        + _elementVal +
                        "&action="      + _submit,
                    success : function(data){            
                        if(data == "true" ){                             
                             _passMessage(_elementId);}
                        else {
                            _errorMessage(_elementId);}}}); // $.ajax
            }},
            keyup: function(e) { 
                var element = $(this);
                var _elementVal = element.val();
                var _elementId = element.attr('id');
                $('.min.' + _elementId).next().removeClass('none');},

            click: function(e) {
            var element = $(this);
            var _elementId = element.attr('id');
            $('#' + _elementId + ' + .clear-button')
                    .removeClass("none");},

            focusout: function(e) {
            var element = $(this);
            var _elementId = element.attr('id');
            var _elementVal = element.val();
            if (_elementVal == '') {
            $('#' + _elementId + ' + .clear-button')
                    .addClass("none");}}                           

        }, 'input, textarea, select'); // $('body')
    } // function _changeInput()
    function _errorMessage(_attr){
    "use strict";
        $('.min.' + _attr)
            .removeClass("none").removeClass("green").addClass("red")
            .text("Your " + _attr + " is wrong");        
        $('input[type="submit"]').prop('disabled', true);} // function _errorMessage()

    function _passMessage(_attr){
        "use strict";
        $('.min.' + _attr)
            .removeClass("none").removeClass("red").addClass("green")
            .text("Your " + _attr + " is passed");


    } // function _passMessage()

    function _checkChanges() {
        "use strict";
        if ($('#name').val()
            && $('#lastname').val() 
            && $('#email').val()
            && $('#subject').val()
            && $('#message').val())
        {
            console.log('All Fields is Empty')
            $('input[type="submit"]').prop('disabled', false);}
        else {
            setTimeout(_checkChanges, 500);}}  // _checkChanges()

    this.init = function() {
    "use strict";
    $("document").ready(function() {
        _changeInput();});} // this.init = function()

} // function ChangeObj()

var changeObj = new ChangeObj;
changeObj.init();