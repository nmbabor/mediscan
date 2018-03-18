/*==== For Dynamic Image Upload*/
$(document).ready(function(){
    $("#file").change(function(){
        readURL(this);
    });

});

function loadPhoto(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_load').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}