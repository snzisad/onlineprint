
$(document).ready(function(){
    getCourier();
  });
  
  function getCourier(){
      $url = "get_courier";
  
      $.ajax({
          url: $url,
          type: 'GET',
          async: true,
          success: function(data){
            $status=data.status;
              
            if($status == "1"){
                setCourier(data.data);
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
  
  function setCourier($data){
  
    var division_select_box = $("#courier");
    division_select_box.empty();
  
      if($data != -1 && $data.length>0){
            $option='<option value="" selected disabled>--Select a Courier--</option>';
            for($i=0;$i<$data.length;$i++){
              $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
            }
            division_select_box.append($option);
      }
      else{
        console.log("Failed to load data");
      }
      
  }
  