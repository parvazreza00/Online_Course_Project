<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    function ContactIndex(){
    	return view('Contact');
    }

    //table data retrive for showing admin panel
    function getContactData(){
    	$result = json_encode(ContactModel::orderBy('id','desc')->get());
    	return $result;
    }

    //delete contact method
    function ContactDelete(Request $req){
     $id= $req->input('id');
     $result=ContactModel::where('id','=',$id)->delete();
     if($result==true){      
       return 1;
     }
     else{
     	return 0;
     }
	}

}
