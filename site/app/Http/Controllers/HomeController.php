<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ContactModel;
use App\Models\ReviewModel;

class HomeController extends Controller
{
   function HomeIndex(){

       $UserIp=$_SERVER['REMOTE_ADDR'];
       date_default_timezone_set('Asia/Dhaka');
       $timeDate= date("Y-m-d h:i:sa");

       VisitorModel::insert(['ip_address'=>$UserIp,'visit_time'=>$timeDate]);

       $ServicesData = json_decode(ServicesModel::orderBy('id','desc')->limit(12)->get());
       $CoursesData = json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
       $ProjectData = json_decode(ProjectModel::orderBy('id','desc')->limit(18)->get());
       $ReviewData = json_decode(ReviewModel::all());


       return view('Home',[
           'ServicesData'=>$ServicesData,
           'CoursesData'=>$CoursesData,
           'ProjectData'=>$ProjectData,
           'ReviewData'=>$ReviewData
       ]);
   }
//database contact table info
   function ContactSend(Request $request){
        $contact_name=$request->input('contact_name');
        $contact_mobile= $request->input('contact_mobile');
        $contact_email=$request->input('contact_email');
        $contact_msg=$request->input('contact_msg');

        $result= ContactModel::insert([
            'contact_name'=> $contact_name,
            'contact_mobile'=> $contact_mobile,
            'contact_email'=>$contact_email,
            'contact_msg'=>$contact_msg
        ]);

       if($result==true){

            return 1;
       }
       else{

           return 0;
       }

    }

}
