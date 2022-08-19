@extends('layouts.master')
@section('title','Cars Listing')
@section('content-header','Cars')

@section('content')
    <div class="row">
        <div class="col">
            <button class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#create">
                <i class="fas fa-plus"></i> Add New Car
            </button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                    </thead>
                     <tbody>
                     @forelse($cars as $car)
                        <tr>
                            <td class="align-middle">
                                <img width="100" height="64" class="img-thumbnail" src="{{ asset("storage/cars/$car->image") }}" alt="{{ $car->name }}">
                            </td>
                            <td class="align-middle">{{ $car->name }}</td>
                            <td class="align-middle">{{ $car->category->name }}</td>
                            <td class="align-middle">{{ $car->brand }}</td>
                            <td class="align-middle">&#8358; {{ number_format($car->price) }}</td>
                            <td class="align-middle">
                                <div class="btn-group">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-edit"></i> edit
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash"></i> delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                     @empty
                         <h1>No cars in the database</h1>
                     @endforelse
                     </tbody>
                </table>
                {{ $cars->links() }}
            </div>
        </div>
    </div>





    <div class="modal fade" tabindex="-1" id="create" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Car</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(count($categories) != 0)
                    <form method="post" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input value="{{ old('price') }}" name="price" type="number" class="form-control @error('price') is-invalid @enderror"
                                   id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand</label>
                            <input value="{{ old('brand') }}" name="brand" type="text"
                                   class="form-control @error('brand') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choose Category</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Body</label>
                            <textarea name="body" id="" cols="30" rows="5"
                                      class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" name="image" id="" class="form-control-file @error('image') is-invalid @enderror">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Now</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                                    Create New Category
                                </a>
                            </div>
                            <div class="card-body">
                                You have not created any categories yet. PLease create one now
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection

