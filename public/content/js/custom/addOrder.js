var fileArray = [];
var pagesArray = [];
var totalSetArray = [];
var totalPageArray = [];
var colorArray = [];
var printTypeArray = [];
var printSideArray = [];
var paperSizeArray = [];
var paperTypeArray = [];
var rateArray = [];
var priceArray = [];
var total_price = 0;
var all_page = 0;
var validExtensions = ['pdf','doc','docx'];

$(document).ready(function(){

  $("#add_to_table_button").on("click", function(){
      addToTable()
  });

  $("#send_order_button").on("click", function(){

    if(fileArray.length>0){
        return true;
    }
    else{
      alert("Please upload at least 1 file");
      return false;
    }
  });

  $("#confirm_order_payment").on("click", function(){

      if(! $("#account_number").val() || ! $("#trnxID").val()){
        return;
      }
      addOrder()
  });

  $(document).on('click', '#remove_table_item', function(e){
      removeItem($(this).parent().parent());
      return false;
  });

});

function addToTable(){

    var file = $('#print_file')[0].files[0];
    var page_number = $('#pages').val();

    //check file is uploaded or not
    if(!file){
      alert("Please select a file to print");
      return false;
    }
    else if(file.size>1048576){
        alert("The file should be less than 1 MB");
        return false;
    }
    else if(!page_number){
        alert("Please enter page number");
        return false;
    }
    else{ //check file extension
        fileName = file.name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if($.inArray(fileNameExt, validExtensions) == -1){
            alert("Please select a pdf, doc, docx file to print");
            return false;
        }
    }

    var total_sets = $('#total_sets').val();
    var total_page = $('#total_pages').val();
    var color = $('#color').val();
    var print_type = $('#print_type').val();
    var print_side = $('#print_side').val();
    var paper_size = $('#paper_size').val();
    var paper_type = $('#paper_type').val();
    var rate = $('#rate').val();
    var price = $('#price').val();

    //store in array
    fileArray.push(file);
    pagesArray.push(page_number);
    totalSetArray.push(total_sets);
    totalPageArray.push(total_page);
    colorArray.push(color);
    printTypeArray.push(print_type);
    printSideArray.push(print_side);
    paperSizeArray.push(paper_size);
    paperTypeArray.push(paper_type);
    rateArray.push(rate);
    priceArray.push(price);


    $data = "<tr>"+
    "<td class='file_name'>"+file.name+"</td>"+
    "<td>"+page_number+"</td>"+
    "<td>"+total_sets+"</td>"+
    "<td>"+total_page+"</td>"+
    "<td>"+$('#color  option:selected').text()+"</td>"+
    "<td>"+$('#print_type  option:selected').text()+"</td>"+
    "<td>"+$('#print_side  option:selected').text()+"</td>"+
    "<td>"+$('#paper_size  option:selected').text()+"</td>"+
    "<td>"+$('#paper_type  option:selected').text()+"</td>"+
    "<td>"+rate+"</td>"+
    "<td>"+price+"</td>"+
    "<td><a href='#' id='remove_table_item'>Remove</a></td>"+
    "</tr>";

    $('.order_table').append($data);

    //update total price
    updateTotalPagePrice(1, price, total_page);

}

function removeItem($content){
    var position = $content.index();

    //update total price
    updateTotalPagePrice(-1, priceArray[position], totalPageArray[position]);

    fileArray.splice(position, 1);
    pagesArray.splice(position, 1);
    totalSetArray.splice(position, 1);
    totalPageArray.splice(position, 1);
    colorArray.splice(position, 1);
    printTypeArray.splice(position, 1);
    printSideArray.splice(position, 1);
    paperSizeArray.splice(position, 1);
    paperTypeArray.splice(position, 1);
    rateArray.splice(position, 1);
    priceArray.splice(position, 1);

    $content.remove();
}

function updateTotalPagePrice($action, $price, $page){
  if($action == 1){
    total_price = parseFloat(total_price)+parseFloat($price);
    all_page = parseInt(all_page)+parseInt($page);
  }
  else if($action == -1){
    total_price = parseFloat(total_price)-parseFloat($price);
    all_page = parseInt(all_page)-parseInt($page);
  }
  $("#total_print_price").text(total_price.toFixed(2)+" taka");
}

function addOrder(){
  if(fileArray.length>0){
    var account = $('#account_number').val();
    var trnxID = $('#trnxID').val();
    var url = "/order/new";
    var csrf = document.getElementsByName('_token')[0].getAttribute("value");

    var formData = new FormData();

    var i = 0;
    for (; i < fileArray.length; i++) {
        formData.append("pagesArray"+i, pagesArray[i]);
        formData.append("totalSetArray"+i, totalSetArray[i]);
        formData.append("totalPageArray"+i, totalPageArray[i]);
        formData.append("colorArray"+i, colorArray[i]);
        formData.append("printTypeArray"+i, printTypeArray[i]);
        formData.append("printSideArray"+i, printSideArray[i]);
        formData.append("paperSizeArray"+i, paperSizeArray[i]);
        formData.append("paperTypeArray"+i, paperTypeArray[i]);
        formData.append("rateArray"+i, rateArray[i]);
        formData.append("priceArray"+i, priceArray[i]);
        formData.append("fileArray"+i, fileArray[i]);
    }
    formData.append('account', account);
    formData.append('trnxID', trnxID);
    formData.append('price', total_price);
    formData.append('total_page', all_page);
    formData.append('_token', csrf);
    formData.append('total_data', i);


    $.ajax({
        url: url,
        type: 'POST',
        async: false,
        cache:false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          $status=data.status;
          $data=data.data;

          if($status == "1"){
            alert("Order Successfull");
            console.log(data.data);
            // window.location.href=location.href;
          }
          else{
              console.log(data.message);
              alert("Something wrong, please try again");
          }

        },
        error: function(data){
          console.log(data);
          alert("Failed to upload file. Please try another file");
        }
      });

  }
  else{
    alert("Please upload at least 1 file");
  }
}
