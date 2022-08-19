@extends('layouts.master')
@section('title','Categories Listing')
@section('content-header','Categories')

@section('content')
    <div class="row">
        <div class="col">
            <button class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#create">
                <i class="fas fa-plus"></i> Add New Category
            </button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                    </thead>
                    @if($categories->isNotEmpty())
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning mr-1" data-toggle="modal" data-target="#edit_{{$category->id}}">
                                           <i class="fas fa-edit"></i>  edit
                                        </button>
                                        <form action="{{ route('admin.categories.destroy',$category->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Do you want to proceed ?')">
                                                <i class="fas fa-trash-alt"></i> delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @include('partials._edit')
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>





    <div class="modal fade" tabindex="-1" id="create" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name of Category</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create Now</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
