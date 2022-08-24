@extends('layouts.master')
@section('title','Bookings')
@section('content-header','Bookings')

@section('content')
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Car Name</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Pick up date</th>
                        <th scope="col">Return date</th>
                        <th scope="col">Pick up location</th>
                        <th scope="col">Drop off location</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                    </thead>
                     <tbody>
                     @forelse($bookings as $booking)
                        <tr>
                            <td class="align-middle">
                                <img width="100" height="64" class="img-thumbnail" src="{{ asset('storage/cars/'.$booking->car->image) }}" alt="{{ $booking->car->name }}">
                            </td>
                            <td class="align-middle">{{ $booking->car->name }}</td>
                            <td class="align-middle">{{ $booking->name }}</td>
                            <td class="align-middle">{{ $booking->phone }}</td>
                            <td class="align-middle">{{ $booking->pick_up_date->toFormattedDateString() }}</td>
                            <td class="align-middle">{{ $booking->drop_off_date->toFormattedDateString() }}</td>
                            <td class="align-middle">{{ $booking->pick_up_location }}</td>
                            <td class="align-middle">{{ $booking->drop_off_location }}</td>
                            <td class="align-middle">{{ $booking->status ? 'Active' : 'Inactive' }}</td>
                            <td class="align-middle">
                                <div class="btn-group">
                                    <form action="{{ route('admin.bookings.update',$booking->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <button {{ $booking->status ? 'disabled' : '' }} class="btn btn-primary" type="submit" onclick="return confirm('Approve?')">
                                            <i class="fas fa-edit"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-success" type="submit" onclick="return confirm('Are You Sure?')">
                                            <i class="fas fa-check"></i> Transaction Completed
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                     @empty
                         <h1>No bookings made</h1>
                     @endforelse
                     </tbody>
                </table>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

@endsection

