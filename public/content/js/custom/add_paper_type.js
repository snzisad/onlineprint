$(document).ready(function(){
    $("#btn_add_paper_type").on("click", function(e){
        $('#modalNewDataTitleForm').attr('action', "/paper_type/new");
        $("#modalNewDataTitle_header").text("New Paper Type");
    });
});
