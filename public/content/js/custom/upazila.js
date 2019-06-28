
$(document).ready(function(){
    $("#district").on("change", function(){
        $id = $(this).val();
        getUpazila($id);
    });
  });
  
  
  function getUpazila($dist_id){
      $url = "get_upazila/"+$dist_id;
  
      $.ajax({
        url: $url,
        type: 'GET',
        async: true,
        success: function(data){
        $status=data.status;
            
        if($status == "1"){
            setUpazila(data.data);
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
  
  function setUpazila($data){
  
    var target_box = $("#upazila");
    target_box.empty();
  
      if($data != -1 && $data.length>0){
            $option='<option value="" selected disabled>--Select a Upazila--</option>';
            for($i=0;$i<$data.length;$i++){
              $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
            }
            target_box.append($option);
      }
      else{
        console.log("Failed to load data");
      }
      
  }
  