$(document).ready(function(){
    $("#btn_add_courier").on("click", function(e){
        $('#modalNewDataTitleForm').attr('action', "/courier/new");
        $("#modalNewDataTitle_header").text("New Courier");
    });
});
