<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Illuminate\Http\Request;
use App\User;
use App\Picture;
use App\HomeAddress;
use App\CourierAddress;

class ProfileController extends Controller
{
    public function showProfileForm(){
        $user = Auth::user();

        $context = [
            "user" => $user,
        ];
        return view('user.profile')->with($context);
    }

    public function saveProfile(Request $request){

        $this->validate($request, [
            "name" => "required|string|max:255",
            // "phone" => "required|string|max:15",
            // "email" => "required|string|max:100",
            "picture" => "mimes:jpg,png,jpeg",

            "division" => "required|integer",
            "district" => "required|integer",
            "upazila" => "required|integer",
            "post_office" => "required|integer",
            "others" => "required|string|max:150",

            "courier" => "integer",
            "branch" => "integer",
        ]);

        $user = Auth::user();

        //update user name
        $user->name = $request->name;
        $user->save();

        //create local variable
        $picture = $request->picture;
        $courier_address = $user->courier_address;

        //save profile picture
        $this->saveProfilePicture($picture, $user);

        //save home address
        $this->saveHomeAddress($request, $user);

        //save courier address
        if($request->branch){
        $this->saveCourierAddress($request, $user);
        }

        return redirect('/order/new')->withErrors(['message'=>'Profile updated successfully']);
    }

    private function saveProfilePicture($picture, $user){
        if($picture){
            $profile_pic = $user->profile_picture;
            $title = str_random(10).date('YmdHis').".".$picture->extension();

            //save the file into storage
            $picture->storeAs('public/pictures', $title);

            if(! $profile_pic){
                $profile_pic = new Picture();
                $profile_pic->user_id = $user->id;
            }

            $profile_pic->picture = $title;
            $profile_pic->save();

            //resize the image
            $path = public_path('storage/pictures/'.$title);
            
            $img = Image::make($path)->resize(150,150, function($constraint){
                // $constraint->aspectRatio();
            });
            $img->save($path);
        }
    }

    private function saveHomeAddress($request, $user){
        $home_address = $user->home_address;

        if(!$home_address){
            $home_address = new HomeAddress();
            $home_address->user_id = $user->id;
        }

        $home_address->division_id = $request->division;
        $home_address->district_id = $request->district;
        $home_address->upazila_id = $request->upazila;
        $home_address->post_office_id = $request->post_office;
        $home_address->others = $request->others;

        $home_address->save();

    }

    private function saveCourierAddress($request, $user){
        $address = $user->courier_address;

        if(!$address){
            $address = new CourierAddress();
            $address->user_id = $user->id;
        }

        $address->courier_id = $request->courier;
        $address->branch_id = $request->branch;

        $address->save();

    }
}
