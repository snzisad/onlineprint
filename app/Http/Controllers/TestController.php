<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Division;
use App\Upazila;
use App\PostOffice;
use App\Courier;
use App\CourierBranch;
use App\PaperType;
use App\PaperSize;
use App\PrintColor;
use App\PrintSide;
use App\PrintType;
use App\PrintRate;

class TestController extends Controller
{
    public function addRandomDivision(){
        for ($i=0; $i<10;$i++){
            $title = str_random(10);

            Division::insert([
                "title" => $title   
            ]);
        }

        return "Success";
        
    }

    public function addRandomCourier(){
        for ($i=0; $i<10;$i++){
            $title = str_random(10);

            Courier::insert([
                "title" => $title   
            ]);
        }

        return "Success";
        
    }

    public function addRandomCourierBranch(){
        for ($i=0; $i<20;$i++){
            $title = str_random(10);
            $id = rand(1,3);

            CourierBranch::insert([
                "courier_id" => $id,
                "title" => $title   
            ]);
        }

        return "Success";
    }

    public function addRandomDistrict(){
        for ($i=0; $i<20;$i++){
            $title = str_random(10);
            $div_id = rand(1,3);

            District::insert([
                "division_id" => $div_id,
                "title" => $title   
            ]);
        }

        return "Success";
    }

    public function addRandomUpazila(){
        for ($i=0; $i<20;$i++){
            $title = str_random(10);
            $id = rand(1,3);

            Upazila::insert([
                "district_id" => $id,
                "title" => $title   
            ]);
        }

        return "Success";
    }

    public function addRandomPostOffice(){
        for ($i=0; $i<20;$i++){
            $title = str_random(10);
            $id = rand(1,3);

            PostOffice::insert([
                "upazila_id" => $id,
                "title" => $title   
            ]);
        }

        return "Success";
    }

    public function addRandomPageType(){
        for ($i=0; $i<20;$i++){
            $title = str_random(10);

            PaperType::insert([
                "title" => $title   
            ]);
        }

        return "Success";
    }

    public function addRandomData(){
        for ($i=0; $i<20;$i++){
            $title = str_random(10);

            PaperSize::insert([
                "title" => $title   
            ]);
        }

        return "Success";
    }

    public function addRandomPrintRate(){
        for ($i=0; $i<20;$i++){

            PrintRate::insert([
                "print_color_id" => rand(1,3), 
                "print_type_id" => rand(1,3), 
                "print_side_id" => rand(1,3), 
                "paper_size_id" => rand(1,3), 
                "paper_type_id" => rand(1,3), 
                "rate" => rand(3,10), 
            ]);
        }

        return "Success";
    }
}
