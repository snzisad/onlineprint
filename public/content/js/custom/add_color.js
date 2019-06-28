$(document).ready(function(){
    $("#btn_add_color").on("click", function(e){
        $('#modalNewDataTitleForm').attr('action', "/color/new");
        $("#modalNewDataTitle_header").text("New Color");
    });
});
