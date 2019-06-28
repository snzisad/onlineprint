$(document).ready(function(){
    $("#input_image").on("change", function(){
        readImage(this)
    });

});

function readImage(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
            $('#picture').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}