@extends('layouts.vertical', ['title' => 'Posts'])

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Posts</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                        <li class="breadcrumb-item active">Foo</li>
                    </ol>
                </div>
                <!-- <h4 class="page-title">Posts</h4> -->
                <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#exampleModal1">Create Post</button>

                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div class="card-box">
                                        <h4 class="header-title m-t-0">Create Post</h4>
                                        <p class="text-muted font-14 m-b-20">

                                        </p>

                                        <form action="{{route('stored')}}" method="POST" class="parsley-examples">
                                            @csrf
                                            <div class="form-group">
                                                <label>User Id</label>
                                                <div>
                                                    <input name="userId" type="text" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div>
                                                    <input name="name" type="text" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Content</label>
                                                <div>
                                                    <textarea name="content" type="text" class="form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Create</button>
                                                    <button type="button" class="btn btn-light waves-effect waves-light m-1" data-dismiss="modal"><i class="fe-x mr-1"></i> Cancel</button>
                                                </div>
                                            </div>


                                        </form>

                                    </div> <!-- end card-box -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title">Filtering</h4>
                <p class="sub-header">
                    include filtering in your FooTable.
                </p>

                <div class="mb-2">
                    <div class="row">
                        <div class="col-12 text-sm-center form-inline">
                            <div class="form-group mr-2">
                                <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                    <option value="">Show all</option>
                                    <option value="active">Active</option>
                                    <option value="disabled">Disabled</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
                <div class="table-responsive">
                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th data-hide="phone">User Id</th>
                                <th data-hide="phone, tablet">Name</th>
                                <th data-hide="phone, tablet">Content</th>
                                <th data-hide="phone, tablet">Created At</th>
                                <th data-hide="phone, tablet">Updated At</th>
                                <th data-hide="phone, tablet">Details</th>
                                <th data-hide="phone, tablet">Edit</th>
                                <th data-hide="phone, tablet">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <th>{{$post->id}}</th>
                                <td>{{$post->user_id}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->content}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>{{$post->updated_at}}</td>

                                <td><button class="btn btn-primary btn-lg" onclick="onDetails(this)" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                                
                                <td><button  class="btn btn-primary btn-lg" onclick="onEdit(this)" data-toggle="modal" data-target="#exampleModal"><i class="icon-pencil" aria-hidden="true"></button></i></td>

                                <script> function onEdit(td){
                                        var node = td.parentNode.parentNode.rowIndex;
                                        i=node;
                                        selectedRow = td.parentElement.parentElement;
                                        document.getElementById('editId').value = selectedRow.cells[0].innerHTML;
                                        document.getElementById('edituserId').value = selectedRow.cells[1].innerHTML;
                                        document.getElementById('editname').value = selectedRow.cells[2].innerHTML;
                                        document.getElementById('editcontent').value = selectedRow.cells[3].innerHTML;
                                    }

                                    function onDetails(td){
                                        var node = td.parentNode.parentNode.rowIndex;
                                        i=node;
                                        selectedRow = td.parentElement.parentElement;
                                        document.getElementById('title').innerHTML=selectedRow.cells[2].innerHTML;
                                        document.getElementById('content').innerHTML=selectedRow.cells[3].innerHTML;
                                    }
                                </script>
                                <!-- <td><a class="btn btn-primary btn-lg" href="{{route('edit',$post->id)}}" data-toggle="modal" data-target="#exampleModal"><i class="icon-pencil" aria-hidden="true"></i></a></td> -->



                                <td>
                                    <form method="POST" id="delete-form-{{$post->id}}" action="{{route('delete',$post->id)}}" style="display:none;">
                                        @csrf
                                        {{method_field('delete')}}
                                    </form>

                                    <button onclick="if(confirm('Do you want to delete?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$post->id}}').submit();

                                }else{
                                    event.preventDefault();

                                }" class="btn btn-danger btn-lg"><i class="icon-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr class="active">
                                <td colspan="5">
                                    <div class="text-right">
                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div> <!-- end .table-responsive-->
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Post Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @csrf
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <h2 id="title" class="header-title m-t-0"></h2>
                                <p id="content" class="text-muted font-14 m-b-20">
                                
                                </p>
                            </div>
                        </div>
                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>




                <!-- edit Modal -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">

                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            <h4 class="header-title m-t-0">Edit Post</h4>
                                            <p class="text-muted font-14 m-b-20">

                                            </p>

                                            <form action="{{route('update',$post->id)}}" method="POST" class="parsley-examples">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Id</label>
                                                        <div>
                                                            <input id="editId" name="id" type="text" class="form-control"  required />
                                                        </div>
                                                 </div>
                                                 <div class="form-group">
                                                 <label>User Id</label>
                                                    <div>
                                                        <input id="edituserId" name="userId" type="text" class="form-control"  required />
                                                    </div>
                                                 </div>
                                                
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <div>
                                                        <input id="editname" name="name" type="text" class="form-control"  required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Content</label>
                                                    <div>
                                                        <input id="editcontent" name="content" type="text" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12 text-center">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Update</button>
                                                        <a href="postlist"><button type="button" class="btn btn-light waves-effect waves-light m-1" data-dismiss="modal"><i class="fe-x mr-1"></i> Cancel</button></a>
                                                    </div>
                                                </div>

                                            </form>

                                        </div> <!-- end card-box -->
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- container -->
        @endsection

        @section('script')
        <!-- Plugins js-->
        <script src="{{asset('assets/libs/footable/footable.min.js')}}"></script>

        <!-- Page js-->
        <script src="{{asset('assets/js/pages/foo-tables.init.js')}}"></script>
        @endsection