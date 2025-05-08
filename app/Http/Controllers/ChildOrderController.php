<?php

namespace App\Http\Controllers;

use App\Models\OrderChild;
use Illuminate\Http\Request;

class ChildOrderController extends Controller
{
    public function index()
{
    $childOrders = OrderChild::with( 'product')->get();
    return view('BackEnd.pages.showorder', compact('childOrders'));
}
}
