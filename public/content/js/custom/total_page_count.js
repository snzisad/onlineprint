$(document).ready(function(){
  	document.getElementById("pages").onkeyup = count_page;
  	document.getElementById("total_sets").onkeyup = count_page;
});

function count_page(){
    $page = $('#pages').val();
    $set = $('#total_sets').val();

    $total_page = ($page)*($set);

    price_count($total_page);
    
    $('#total_pages').val($total_page);
}

function price_count($total_page){
      $rate = $('#rate').val();
      $price = $total_page*$rate;
      $('#price').val($price);
}
