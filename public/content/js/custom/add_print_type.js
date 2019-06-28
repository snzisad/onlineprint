$(document).ready(function(){
    $("#btn_add_print_type").on("click", function(e){
        $('#modalNewDataTitleForm').attr('action', "/print_type/new");
        $("#modalNewDataTitle_header").text("New Print Type");
    });
});
