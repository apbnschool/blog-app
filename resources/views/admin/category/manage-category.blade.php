@extends('admin.master')
@section('body')
    <div class="container-fluid main-container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Category Table</h3>
                    </div>
                    <div class="card-body">
                       <table class="table table-bordered table-striped table-hover">
                           <thead>
                           <tr>
                               <th>sl</th>
                               <th>Category Name</th>
                               <th>Image</th>
                               <th>status</th>
                               <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($categories as $category)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td>{{ $category->category_name }}</td>
                               <td>
                                   <img src="{{ asset($category->image) }}" alt="" class="img-fluid" style="height: 50px;width: 50px">
                               </td>
                               <td>{{ $category->status == 1 ? 'Active' : "Inactive" }}</td>
                               <td class="d-flex">
                                   @if($category->status == 1)
                                       <a href="{{ route('status',['id'=>$category->id]) }}" class="btn btn-outline-warning">Inactive</a>
                                   @else
                                       <a href="{{ route('status',['id'=>$category->id]) }}" class="btn btn-outline-success">Active</a>
                                   @endif
                                   <a href="" class="btn btn-outline-primary">Edit</a>
                                   <form action="{{ route('delete.category',$category->id) }}" method="post">
                                       @csrf
                                       <button onclick="return confirm('Are you sure Delete this !!')" class="btn btn-outline-danger">Delete</button>
                                   </form>
                               </td>
                           </tr>
                           @endforeach
                           </tbody>
                       </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
