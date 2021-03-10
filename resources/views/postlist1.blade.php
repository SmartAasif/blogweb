@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

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
                    <h4 class="page-title">Datatables</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Posts</h4>
                        <p class="text-muted font-13 mb-4">
                            
                        <button class="btn btn-success"><a href="create" style="color:white;">Add post</a></button><br><br>
                        </p>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            @foreach($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->user_id}}</td>
          <td>{{$post->name}}</td>
         
          <td><a class="btn btn-raised btn-primary btn-sm" href="{{route('edit',$post->id)}}"><i class="icon-pencil" aria-hidden="true"></i>
            </a></td>

            <td>
            <form method="POST" id="delete-form-{{$post->id}}" action="{{route('delete',$post->id)}}" style="display:none;">
              @csrf
              {{method_field('delete')}}






            </form>

            <button onclick="if(confirm('Are you sure to delete this post?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{$post->id}}').submit();


  


                    }else{
                        event.preventDefault();

                    }" class="btn btn-raised btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>
            </button>
          </td>
        </tr>
        @endforeach

                        
                        
                            <tbody>
                               
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
@endsection