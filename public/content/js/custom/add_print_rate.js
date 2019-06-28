$(document).ready(function(){
    $("#btn_add_print_rate").on("click", function(e){
        alert("Please wait. Data is loading");

        getPrintColor();
        getPrintType();
        getPrintSide();
        getPaperSize();
        getPaperType();
    });
});

function getPrintColor(){
    $url = "/color/get";
    var select_box = $("#option_color");
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

function getPrintType(){
    $url = "/print_type/get";
    var select_box = $("#option_print_type");
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

function getPrintSide(){
    $url = "/print_side/get";
    var select_box = $("#option_print_side");
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

function getPaperSize(){
    $url = "/paper_size/get";
    var select_box = $("#option_print_size");
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

function getPaperType(){
    $url = "/paper_type/get";
    var select_box = $("#option_paper_type");
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

// function setParentData($data, $select_box){
//
//     if($data != -1 && $data.length>0){
//           $option="";
//           for($i=0;$i<$data.length;$i++){
//             $option+='<option value="'+$data[$i].id+'">'+$data[$i].title+'</option>';
//           }
//           $select_box.append($option);
//     }
//     else{
//       alert("Failed to load data, try again");
//     }
//
// }
