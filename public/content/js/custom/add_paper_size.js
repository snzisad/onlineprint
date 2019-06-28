$(document).ready(function(){
    $("#btn_add_paper_size").on("click", function(e){
        $('#modalNewDataTitleForm').attr('action', "/paper_size/new");
        $("#modalNewDataTitle_header").text("New Paper Size");
    });
});
