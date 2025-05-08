<?php

namespace App\Http\Controllers;

use App\Models\tbl__customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function ADDCustomer(Request $request){
        $data=new tbl__customer();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->Address=$request->Address;
        $data->Gender=$request->Gender;
        $data->DOB=$request->DOB;
        $data->phone=$request->phone;
        $data->save();

        return view('BackEnd.pages.Customer.ADD');

    }

     public function showCustomer(Request $request){
        $Customers=tbl__customer::all();

        return view('BackEnd.pages.Customer.Table',compact('Customers'));
     }
 
}
