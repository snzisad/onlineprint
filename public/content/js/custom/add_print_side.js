$(document).ready(function(){
    $("#btn_add_print_side").on("click", function(e){
        $('#modalNewDataTitleForm').attr('action', "/print_side/new");
        $("#modalNewDataTitle_header").text("New Print Side");
    });
});
