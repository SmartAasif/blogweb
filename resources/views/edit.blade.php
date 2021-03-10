@extends('layouts.vertical', ['title' => 'Validation | Parsley'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            
                        </ol>
                    </div>
                   
                </div>
            </div>
        </div>     
        <!-- end page title --> 

           
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Edit Post</h4>
                    <p class="text-muted font-14 m-b-20">
                
                    </p>

                    <form action="{{route('update',$post->id)}}" method="POST" class="parsley-examples">
                          @csrf
                        <div class="form-group">
                            <label>User Id</label>
                            <div>
                                <input name="userId" type="text" class="form-control" value="{{$post->user_id}}" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <div>
                                <input name="name" type="text" class="form-control" value="{{$post->name}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <div>
                                <input name="content" type="text" class="form-control" value="{{$post->content}}" required/>
                            </div>
                        </div>
                        

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Update</button>
                                <a href="postlist"><button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button></a>
                            </div>
                        </div>

                    </form>

                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection