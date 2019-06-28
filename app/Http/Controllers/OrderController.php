<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Http\Request;
use App\PrintColor;
use App\PrintType;
use App\PrintSide;
use App\PaperSize;
use App\PaperType;
use App\PrintOrder;
use App\PrintPayment;
use App\OrderSequence;
use App\PrintFiles;

class OrderController extends Controller
{

    public function showOrderForm(){
        if(Auth::user()->type == 1){
            return Redirect::route('order_details', ['id'=>0]);
        }

        $context = [
            "print_color" => PrintColor::orderBy('id','asc')->get(),
            "print_type" => PrintType::orderBy('id','asc')->get(),
            "print_side" => PrintSide::orderBy('id','asc')->get(),
            "paper_size" => PaperSize::orderBy('id','asc')->get(),
            "paper_type" => PaperType::orderBy('id','asc')->get(),
        ];

        return view('user.place_order')->with($context);
    }

    public function showOrderDetails($id){
      if($id != 0){
         //get the order with using the id
        $order = OrderSequence::where('id', $id)->with(['items', 'user', 'payment'])->first();
      }
      else{
          //get latest order
        $order = OrderSequence::orderBy('id', 'desc')->with(['items', 'user', 'payment'])->first();
      }

      if($order){
        $context = [
            "user" => $order->user,
            "order" => $order,
            "orders" => OrderSequence::orderBy('id', 'desc')->get(),
        ];
      }
      else{
          $context="";
      }
      return view('dashboard.orders')->with($context);
    }

    public function addOrder(Request $request){

      //create a order sequence
      $sequence = OrderSequence::create([
        'user_id'=>Auth::user()->id,
        'total_page'=>$request->total_page,
        'price'=>$request->price,
      ]);

      //add order according to request
      $this->saveOrderInfo($request, $sequence->id);

      //save payment information
      PrintPayment::create([
          "sequence_id"=> $sequence->id,
          "account"=> $request->account,
          "trnx_id"=> $request->trnxID,
          "amount"=> $request->price,
      ]);

      return response()->json([
          'status' => "1",
          'message' => "Success",
          'data' => ($request->pagesArray+1),
      ], 200);
    }

    public function saveOrderInfo($request, $sequence_id){

        for($i=0; $i<($request->total_data); $i++){
          //create temporary variable
          $page = ("pagesArray".$i);
          $set = ("totalSetArray".$i);
          $total_page = ("totalPageArray".$i);
          $rate = ("rateArray".$i);
          $price = ("priceArray".$i);
          $color_id = ("colorArray".$i);
          $print_type_id = ("printTypeArray".$i);
          $print_side_id = ("printSideArray".$i);
          $paper_size_id = ("paperSizeArray".$i);
          $paper_type_id = ("paperTypeArray".$i);
          $file = ("fileArray".$i);

          // if(!$request->$file){
          //     OrderSequence::find($sequence_id)->delete();
          //
          //     return response()->json([
          //         'status' => "-1",
          //         'message' => "Failed to upload file",
          //     ], 200);
          // }

          //store in database
          $order = PrintOrder::create([
              "sequence_id"=>$sequence_id,
              "page"=>$request->$page,
              "set"=>$request->$set,
              "total_page"=>$request->$total_page,
              "color_id"=>$request->$color_id,
              "print_type_id"=>$request->$print_type_id,
              "print_side_id"=>$request->$print_side_id,
              "paper_size_id"=>$request->$paper_size_id,
              "paper_type_id"=>$request->$paper_type_id,
              "rate"=>$request->$rate,
              "price"=>$request->$price,
          ]);


          try{
              //save the file into storage
              $print_file = $request->$file;
              $title = $order->id.".".$print_file->extension();
              $print_file->storeAs('public/files/', $title);
            }
            catch(\Exception $e){
                OrderSequence::find($sequence_id)->delete();
                
                return response()->json([
                    'status' => "-1",
                    'message' => "Failed to upload file",
                ], 200);
            }

          //save file information into database
          PrintFiles::create([
              'order_id'=>$order->id,
              'title'=>$title,
          ]);

        }
    }

    public function printEnvelop($id){
        $order = OrderSequence::where('id', $id)->with(['user'])->first();

        $context = [
            "user" => $order->user,
        ];
          return view('envelop')->with($context);
    }

    public function removeOrder($id){
        $order = OrderSequence::find($id);

        if($order){
          $order->delete();

          return Redirect::route('order_details', ['id'=>0])->withErrors(['message'=> "Order removed successfully"]);
        }
        else{
          return redirect()->back()->withErrors("Failed to remove this order");
        }
    }
}
