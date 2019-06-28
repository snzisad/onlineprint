
$(document).ready(function(){
    $("#courier").on("change", function(){
        $id = $(this).val();
        getBranch($id);
    });
  });
  
  function getBranch($courier_id){
      $url = "get_branch/"+$courier_id;
  
      $.ajax({
          url: $url,
          type: 'GET',
          async: true,
          success: function(data){
            $status=data.status;
              
            if($status == "1"){
                setBranch(data.data);
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
  
  function setBranch($data){
    var target_box = $("#branch");
    target_box.empty();
  
      if($data != -1 && $data.length>0){
            $option='<option value="" selected disabled>--Select a Branch--</option>';
            for($i=0;$i<$data.length;$i++){
              $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
            }
            target_box.append($option);
      }
      else{
        console.log("Failed to load data");
      }
      
  }
  