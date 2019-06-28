$(document).ready(function(){
    // $("#color").on("change", function(){
    //     getRate();
    // });
    getRate();

  	document.getElementById("color").onchange = getRate;
  	document.getElementById("print_type").onchange = getRate;
  	document.getElementById("print_side").onchange = getRate;
  	document.getElementById("paper_size").onchange = getRate;
  	document.getElementById("paper_type").onchange = getRate;
});

function getRate(){
  $('#rate').val("0");
  $('#price').val("0");

  $color = $('#color').val();
  $print_type = $('#print_type').val();
  $print_side = $('#print_side').val();
  $paper_size = $('#paper_size').val();
  $paper_type = $('#paper_type').val();
  $csrf = document.getElementsByName('_token')[0].getAttribute("value");

  $url = "/get_rate";

  $.ajax({
      url: $url,
      type: 'POST',
      async: true,
      data: {
        "color": $color,
        "print_type" : $print_type,
        "print_side": $print_side,
        "paper_size" : $paper_size,
        "paper_type": $paper_type,
        "_token" : $csrf,
      },
      success: function(data){
        $status=data.status;

        if($status == "1"){
          setRate(data.data);
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

function setRate($data){
    $('#rate').val($data.rate);
    updatePrice();
}

function updatePrice(){
  $page = $('#total_pages').val();
  $rate = $('#rate').val();

  $price = ($page)*($rate);

  $('#price').val($price);
}
