$(document).ready(function(){
    $("#btn_add_upazila").on("click", function(e){
        alert("Please wait. Data is loading");

        $('#modalNewDataForm').attr('action', "/upazila/new");
        $('#option_select_box').attr('name', "district_id");
        $("#option_select_box_title").text("District");
        $("#modalNewData_Header").text("New Upazila");

        getDistrict();
    });
});

function getDistrict(){
    $url = "/get_district/0";
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

function setParentData($data, $select_box){

    if($data != -1 && $data.length>0){
          $option="";
          for($i=0;$i<$data.length;$i++){
            $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
          }
          $select_box.append($option);
    }
    else{
      alert("Failed to load data, try again");
    }

}
