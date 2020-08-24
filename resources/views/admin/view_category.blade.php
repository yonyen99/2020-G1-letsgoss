@extends('layouts.app')

@section('content')

<div class="container">
    {{-- button search --}}
        <div class="form-group has-search mt-4">
            <span class="fa fa-search form-control-feedback"></span>
            <input class="form-control" id="search" type="text" placeholder="Search..">
            {{-- errow con confirm password with new password --}}
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            {{-- success confirm password with new password--}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            {{-- warning confirm password with new password--}}
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <h3 class="text-center"><b class="text-success">C</b>ategories</h3>
            <div class="row">
                <div class="col-md-11"></div>
                <div class="col-md-1">
                    <button class="btn btn-warning text-light" data-toggle="modal" data-target="#addCategory">Create</button>
                </div>
                <!-- Form Add Category -->
                <div class="modal" id="addCategory">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{route('categories.store')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <h3 class="mb-4"><b>Create Category</b></h3>
                                    <input type="text" name="category" class="form-control mb-4 capitalize" placeholder="Category name" id="category" required>
                                    <span id="availability"></span>
                                    <button type="submit" class="btn btn-warning float-right text-light ml-2 remove_btnCreate">CREATE</button>
                                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal">DISCARD</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Categories --}}
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    @foreach($categories as $category)
                    <!-- View Categories List -->
                    <tbody id="mydata">
                        <tr class="event">
                            <td class=" text-info action">{{$category->name}}</td>
                            <td>
                                <a href="{{route('categories.destroy',$category->id)}}" class="text-danger" id="delete" data-toggle="modal" data-target="#removeCategory{{$category->id}}"><span class="material-icons text-danger" data-toggle="tooltip" title="Delete Category!">delete</span></a>
                                <a href="{{route('categories.edit',$category->id)}}" class="text-pimary" id="delete" data-toggle="modal" data-target="#editCategory{{$category->id}}"><span class="material-icons text-info" data-toggle="tooltip" title="Edit Category!">edit</span></a>
                                @method('DELETE')
                            </td>

                            <!-- Form Update Category -->
                            <div class="modal" id="editCategory{{$category->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{route('categories.update',$category->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <h3 class="mb-4"><b>Update Category</b></h3>
                                                <input type="text" name="category" class="form-control mb-4 capitalize" value="{{$category->name}}" id="categoryUpdate">
                                                <span id="availabilityUpdate"></span>
                                                <button type="submit" class="btn btn-warning float-right text-light ml-2 remove_btnUpdate" id="myBtn">Update</button>
                                                <button type="button" class="btn btn-danger float-right" data-dismiss="modal">DISCARD</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Form Remove Category -->
                            <div class="modal" id="removeCategory{{$category->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <h3 class="mb-4"><b>Remove Category</b></h3>
                                                <p>Are you sure you want to delete the category?</p>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                                                <button type="submit" class="btn btn-warning float-right text-light ml-2">OK</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
</div>
<script>

    // CREATE CATEGORY
    $(document).ready(function(){
        $("#category").keyup(function(){

            var category = $(this).val();
            // console.log(category)
            $.ajax({
                url:"{{ route('categories_available.check') }}",
                method:"GET",
                data:{category:category},
                    success:function(data){
                        if(data != ''){
                            $('#availability').html('<span class="text-danger">Categories already exists</span><button type="submit" class="btn btn-warning float-right text-light ml-2" disabled>CREATE</button>');
                            $('button').remove('.remove_btnCreate');
                        }else{
                            $('#availability').html('<button type="submit" class="btn btn-warning float-right text-light ml-2 ">CREATE</button>');
                            $('button').remove('.remove_btnCreate');
                        }
                    }
            })

        });
    });

    // UPDATE CATEGORY 

    $(document).ready(function(){
        $("#categoryUpdate").keyup(function(){
            var category = $(this).val();
            console.log(category)
            $.ajax({
                url:"{{ route('categories_available.checkUpdate') }}",
                method:"GET",
                data:{category:category},
                    success:function(data){
                        if(data != ''){
                            $('#availabilityUpdate').html('<span class="text-danger">Categories already updated</span>');
                            document.getElementById("myBtn").disabled = true;
                        }else{
                            $('#availabilityUpdate').html('<span class="text-success"></span>');
                        }
                    }
            })

        });
    });


   
</script>

@endsection