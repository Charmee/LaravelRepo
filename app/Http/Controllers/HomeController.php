<?php
   
namespace App\Http\Controllers;
use App\Models\Course;

use Illuminate\Http\Request;
   
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contact = Course::all();
        // return view('courses.index', ['courses'=>$contact]);
        return view('home', ['courses'=>$contact]);
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    public function addInstmojoPayment(){
        console.log("test changes !!!!!");
    }

    
    
}