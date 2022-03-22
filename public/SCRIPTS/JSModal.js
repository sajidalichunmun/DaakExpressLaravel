var modal=document.getElementById('modal-wrapper');
window.onClick=function(event){
    if(event.target==modal){
        modal.style.display="none";
    }
}

var modal1=document.getElementById('register-modal-wrapper');
window.onClick=function(event){
    if(event.target==modal1){
        modal1.style.display="none";
    }
}

var modal2=document.getElementById('simpleModal');
window.onClick=function(event){
    if(event.target==modal1){
        modal2.style.display="none";
    }
}

$(document).ready(function(){
    $("#modal-wrapper").on('shown.bs.modal', function(){
        $(this).find('#txtUserID').focus();
    });
});
$('input, textarea, select').on('focus', function() {
var id = $(this).attr('id'),
    label = 'label[for="' + id + '"]';

$(this).addClass('has-value');
$(label).addClass('has-value');

}).on('blur', function() {
var id = $(this).attr('id'),
    label = 'label[for="' + id + '"]',
    value = $(this).val();

if (value.length <= 0) {
  $(this).removeClass('has-value');
  $(label).removeClass('has-value');
}
});

var KEYCODE_TAB = 9;

/*
$(document).element.addEventListener('keydown', function(e) {
    if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
        if ( e.shiftKey ) /* shift + tab */ 
/*{
            if (document.activeElement === firstFocusableEl) {
                lastFocusableEl.focus();
                e.preventDefault();
            }
        } else /* tab */ 
/*{
            if (document.activeElement === lastFocusableEl) {
                firstFocusableEl.focus();
                e.preventDefault();
            }
        }
    }
});
*/

var modal2=document.getElementById('simpleModal');
            window.onClick=function(event){
                if(event.target==modal1){
                    modal2.style.display="none";
                }
            }
            
        function validateForm() {
if (document.myform.email.value == "") {
document.getElementById('errors').innerHTML="Please enter a username"; return false;
}}

      $('input, textarea, select').focus();

