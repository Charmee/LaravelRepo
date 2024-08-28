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
                        <h1>Mini post list</h1>
                    </div>
                        
                    <hr>
                    <!-- Message if a post is posted successfully -->
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                        @if (count($courses) > 0)
                        @foreach ($courses as $post)
                        <div class="row">
                            <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                <img class="img-fluid" style="max-width:50%;" src="{{ asset('images/'.$post->image)}}" alt="">
                                </div>
                                <div class="col-10">
                                <h4>{{$post->title}}</h4>
                                
                                <!-- <button type="button" class="btn btn-primary m-2" data- 
                                toggle="modal" data-target="#demoModal">Click Here</button> -->
                                <!-- <a href="{{ route('deletedata') }}">Delete</a> -->
                                @if($post->payment)
                                    <p>Payment has been completed successfully!</p>
                                @else
                                <button type="button" class="btn btn-primary m-2" 
                                   onClick="{{ route('addInstmojoPayment') }}"> add instamoho payment </button>

                                @endif

                                <button type="button" class="btn btn-primary m-2" 
                                   onClick="{{ route('addInstmojoPayment') }}"> add payment payment </button>


                                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                                    Launch demo modal
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="demoModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                        <!-- <object width="425" height="350" data="{{ $post->link }}" type="application/x-shockwave-flash"><param name="src" value="{{ $post->link }}" /></object> -->
                                        <!-- <iframe width="560" height="315" src="{{ $post->link }}" frameborder="0" allowfullscreen></iframe> -->
                                            <!-- <iframe width="560" height="315" src="{{ $post->link }}" frameborder="0"  allow="acclerometer; autoplay;encrypted-media;gyroscope;picture-in-pitcture allowfullscreen"></iframe> -->
                                            <!-- <iframe id="ytplayer" type="text/html" width="640" height="360"
                                            src="{{ $post->link }}"
                                            frameborder="0"></iframe> -->
                                            <!-- {{ $post->link }} -->
                                            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/HamQb3IGKZw?si=oKqvSk-8DgkykLLM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $post->link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                                            
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>


                                </div>
                            </div>
                            <p>{{$post->description}}</p>
                     
                            <hr>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>No Posts found</p>
                    @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





