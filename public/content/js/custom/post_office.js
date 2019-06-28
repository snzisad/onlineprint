
$(document).ready(function(){
    $("#upazila").on("change", function(){
        $id = $(this).val();
        getPostOffice($id);
    });
  });
  
  
  function getPostOffice($upa_id){
      $url = "get_postoffice/"+$upa_id;
  
      $.ajax({
        url: $url,
        type: 'GET',
        async: true,
        success: function(data){
        $status=data.status;
            
        if($status == "1"){
            setPostOffice(data.data);
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
  
  function setPostOffice($data){
  
    var target_box = $("#post_office");
    target_box.empty();
  
      if($data != -1 && $data.length>0){
            $option='<option value="" selected disabled>--Select a Post Office--</option>';
            for($i=0;$i<$data.length;$i++){
              $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
            }
            target_box.append($option);
      }
      else{
        console.log("Failed to load data");
      }
      
  }
  