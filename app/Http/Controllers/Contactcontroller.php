<?php

namespace App\Http\Controllers;

use App\Models\tbl__contact;
use Illuminate\Http\Request;

class Contactcontroller extends Controller
{
    public function ContactADD(Request $request){
        $data=new tbl__contact();
        $data->name=$request->name;
        $data->phone=$request->phone;
        $data->Email=$request->Email;
        $data->date=$request->date;
        $data->save();
        return view('frantEnd.pages.contct');
    }

    public function ShowContact(Request $request){
         $contacts= tbl__contact::all();
         return view('BackEnd.pages.ContactTable',compact('contacts'));
    }
}
