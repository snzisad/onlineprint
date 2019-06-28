$(document).ready(function(){
    $("#btn_add_district").on("click", function(e){
        alert("Please wait. Data is loading");
        $('#modalNewDataForm').attr('action', "/district/new");
        $('#option_select_box').attr('name', "division_id");
        $("#option_select_box_title").text("Division");
        $("#modalNewData_Header").text("New District");

        getDivision();
    });
});

function getDivision(){
    $url = "/get_division";
    var select_box = $("#option_select_box");
    select_box.empty();

    $.ajax({
        url: $url,
        type: 'GET',
        async: false,
        success: function(data){
          $status=data.status;

          if($status == "1"){
            setParentData(data.data, select_box);
          }
          else{
              console.log(data.message);
          }

        },
        error: function(data){
          console.log(data);
        }
      });
}
