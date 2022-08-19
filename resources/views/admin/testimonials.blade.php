@extends('layouts.master')
@section('title','Categories Listing')
@section('content-header','Testimonials')

@section('content')
    <div class="row">
        <div class="col">
            <button class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#create">
                <i class="fas fa-plus"></i> Add New Testimonial
            </button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Job Title</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                    </thead>
                    @if($testimonials->isNotEmpty())
                        <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td class="align-middle">
                                    <img width="70" height="32" class="img-thumbnail" src="{{ asset("storage/testimonials/$testimonial->image") }}" alt="">
                                </td>
                                <td class="align-middle">{{ $testimonial->name }}</td>
                                <td class="align-middle">{{ $testimonial->job_title }}</td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-warning mr-1" data-toggle="modal" data-target="#edit_{{$testimonial->id}}">
                                            <i class="fas fa-edit"></i> edit
                                        </button>
                                        <form action="{{ route('admin.categories.destroy',$testimonial->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
{{--                            @include('partials._edit')--}}
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
                    <form method="post" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
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
                            <label for="exampleInputEmail1">Job Title</label>
                            <input value="{{ old('job_title') }}" name="job_title" type="text"
                                   class="form-control @error('job_title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                </div>
            </div>
        </div>
    </div>

@endsection
