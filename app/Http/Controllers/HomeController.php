<?php

namespace App\Http\Controllers;
use App\User;
use Image;
use App\Slider;
use App\Game;
use App\WithDraw;
use App\AddMoney;
use App\Payment;
use App\Package;
use App\PackageRequest;
use App\Contest;
use App\ContestWinner;
use App\ContestRating;
use Carbon\Carbon;
use App\Trend;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
        public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.index');
    }
      
}
