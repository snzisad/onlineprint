
$(document).ready(function(){
    $("#division").on("change", function(){
        $id = $(this).val();
        getDistrict($id);
    });
  });
  
  function getDistrict($div_id){
      $url = "get_district/"+$div_id;
  
      $.ajax({
          url: $url,
          type: 'GET',
          async: true,
          success: function(data){
            $status=data.status;
              
            if($status == "1"){
              setDistrict(data.data);
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
  
  function setDistrict($data){
  
    var target_box = $("#district");
    target_box.empty();
  
      if($data != -1 && $data.length>0){
            $option='<option value="" selected disabled>--Select a District--</option>';
            for($i=0;$i<$data.length;$i++){
              $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
            }
            target_box.append($option);
      }
      else{
        console.log("Failed to load data");
      }
      
  }
  