@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                
                <div class="card-body">
                   @if(auth()->user()->is_admin == 1)
                    <a href="{{url('admin/routes')}}">Admin</a>
                    <a class="btn btn-secondary float-end mt-3" href="{{ route('courses.create') }}" role="button">Add Post</a>

                    @else
                    <div class=”panel-heading”>Normal User</div>
                    <div class="container">
                    <div class="titlebar">
                        <h1>Paymnent form</h1>
                    </div>
                        
                    <hr>
                    <form action="{{route('addInstmojoPaymentBut')}}" method="POST" name="instamojo_payment">
                    @csrf

                    @isset($resp)
                    @if(is_array($resp) || is_object($resp))
                        @foreach($resp as $item)
                            <p>{{ $item }}</p> <!-- Adjust based on the structure of the array -->
                        @endforeach
                    @else
                        <p>{{ $resp }}</p>
                    @endif
                    @endisset
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Mobile Number</strong>
                                <input type="text" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" maxlength="10" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Email Id</strong>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email id" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Event Fees</strong>
                                <input type="text" name="amount" class="form-control" placeholder="" value="100" readonly="">
                            </div>
                        </div>
                        <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"  >Submit</button>
                        </div>
                    </div>
                    
                    </form> 
                    @endif
                    <a href="{{ url('/home')}} ">Home </a>

</div>
            </div>
        </div>
    </div>
</div>
</div>
