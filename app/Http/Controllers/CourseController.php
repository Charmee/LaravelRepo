<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    public function index() {
       // $post = "Laravel Tutorial Series One!";
        $contact = Course::all();
        return view('courses.index', ['courses'=>$contact]);
      }

    public function create() {
        return view('courses.create');
    }

    public function store(Request $request) {
        // validations
        $request->validate([
          'title' => 'required',
          'description' => 'required',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'coach_name' => 'required',
          'link' => 'required',

        ]);
      
        $post = new Course;
      
        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
      
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $file_name;
      
        $post->save();
        return redirect()->route('courses.index')->with('success', 'Post created successfully.');
      }

     public function deletedata(){
         $data=Course::delete()->all();
         return redirect()->route('courses.index')->with('success', 'Post deleted successfully.');
     }

     public function addInstmojoPayment(){
        return view('addInstamojoPayment');
     }

     public function buttonInstamojo(){
          $API_KEY = "test_7d8d39263609eb587bf1212d971";
          $AUTH_TOKEN = "test_f1ab1b25fcfd6e0d64f89ba5835";
          $URL = "https://test.instamojo.com/api/1.1/";
      
          $api = new \Instamojo\Instamojo($API_KEY, $AUTH_TOKEN, $URL);
      
          try {
              $response = $api->paymentRequestCreate(array(
                  "purpose" => "FIFA 16",
                  "amount" => $_POST["amount"],
                  "buyer_name" => $_POST["name"],
                  "send_email" => true,
                  "email" => $_POST["email"],
                  "phone" => "9876567898",
                  "redirect_url" => "http://127.0.0.1:8000/addInstmojoPaymentButSuccess"
                  ));
                  
                  header('Location: ' . $response['longurl']);
                  exit();
          }catch (Exception $e) {
              print('Error: ' . $e->getMessage());
          }
     }

     public function paymentSuccess(){
        $API_KEY = "test_7d8d39263609eb587bf1212d971";
        $AUTH_TOKEN = "test_f1ab1b25fcfd6e0d64f89ba5835";
        $URL = "https://test.instamojo.com/api/1.1/";
    
        $api = new \Instamojo\Instamojo($API_KEY, $AUTH_TOKEN,$URL);
    
        $payid = $_GET["payment_request_id"];
    
        try {
        $response = $api->paymentRequestStatus($payid);
        // echo "<h5>Payment ID: " . $response['payments'][0]['payment_id'] . "</h5>" ;
        // echo "<h5>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h5>" ;
        // echo "<h5>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h5>" ;
        // echo "<h5>Payment Mobile: " . $response['payments'][0]['buyer_phone'] . "</h5>" ;
        // echo "<h5>Payment status: " . $response['payments'][0]['status'] . "</h5>" ;
        // echo "<pre>";
        // dd($response['payments']);
        $respString = json_encode($response['payments'][0]);

    
        $user = Auth::user();
        $courseId = $user->id;
        $record = Course::find($courseId);
      //  $record = Courses::where('id', $courseId)->first();      

        if ($record) {
            // Update specific columns
            $record->payment = $respString;
    
            // Save the changes
            $record->save();
        }
        return view('addInstamojoPayment')->with(['resp'=>$respString]);

        }
        catch (Exception $e) {
        print('Error: ' . $e->getMessage());
        }
     }
      
}
