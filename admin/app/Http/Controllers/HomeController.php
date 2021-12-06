<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;
use App\Models\ServicesModel;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    function HomeIndex(){
    	$totalContact= ContactModel::count();
    	$totalCourse= CourseModel::count();
    	$totalProject= ProjectModel::count();
    	$totalReview= ReviewModel::count();
    	$totalService= ServicesModel::count();
    	$totalVisitor= VisitorModel::count();

       
       return view('Home',[
       	'totalContact'=>$totalContact,
       	'totalCourse'=>$totalCourse,
       	'totalProject'=>$totalProject,
       	'totalReview'=>$totalReview,
       	'totalService'=>$totalService,
       	'totalVisitor'=>$totalVisitor
       ]);
   }
}
