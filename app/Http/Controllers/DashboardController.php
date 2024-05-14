<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard');
    }

    public function getNewOrders()
    {
        $orders = Order::where('status', 'Baru')->orderBy('id', 'DESC')->get();
    
        return response()->json($orders);
    }
}
