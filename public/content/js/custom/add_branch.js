$(document).ready(function(){
    $("#btn_add_branch").on("click", function(e){
        alert("Please wait. Data is loading");

        $('#modalNewDataForm').attr('action', "/branch/new");
        $('#option_select_box').attr('name', "courier_id");
        $("#option_select_box_title").text("Courier");
        $("#modalNewData_Header").text("New Courier Branch");

        getCourier();
    });
});

function getCourier(){
    $url = "/get_courier";
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
