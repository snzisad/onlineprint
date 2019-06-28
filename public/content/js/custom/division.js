
$(document).ready(function(){
  getDivision();
});

function getDivision(){
    $url = "get_division";

    $.ajax({
        url: $url,
        type: 'GET',
        async: true,
        data: {
        //   "catagory_id": $catagory_id,
        //   "_token" : $csrf
        },
        success: function(data){
          $status=data.status;
            
          if($status == "1"){
            setDivision(data.data);
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

function setDivision($data){

  var division_select_box = $("#division");
  division_select_box.empty();

    if($data != -1 && $data.length>0){
          $option='<option value="" selected disabled>--Select a Division--</option>';
          for($i=0;$i<$data.length;$i++){
            $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
          }
          division_select_box.append($option);
    }
    else{
      console.log("Failed to load data");
    }
    
}
