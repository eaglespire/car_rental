

<form action="{{ route('rent') }}" class="request-form ftco-animate bg-primary" method="post">
    @csrf
    <h2>Make your trip</h2>
    <div class="form-group">
        <label for="" class="label">Pick-up location</label>
        <input type="text" class="form-control" placeholder="City, Airport, Station, etc" name="pick_up_location">
    </div>
    <div class="form-group">
        <label for="" class="label">Drop-off location</label>
        <input type="text" class="form-control" placeholder="City, Airport, Station, etc" name="drop_off_location">
    </div>
    <div class="d-flex">
        <div class="form-group mr-2">
            <label for="" class="label">Pick-up date</label>
            <input type="text" class="form-control" id="book_pick_date" placeholder="Date" name="pick_up_date">
        </div>
        <div class="form-group ml-2">
            <label for="" class="label">Drop-off date</label>
            <input type="text" class="form-control" id="book_off_date" placeholder="Date" name="drop_off_date">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="label">{{__("Fullname")}}</label>
        <input type="text" class="form-control"  placeholder="Name" name="name">
    </div>
    <div class="form-group">
        <label for="" class="label">{{__("Your Phone Number")}}</label>
        <input type="text" class="form-control"  placeholder="Name" name="phone">
    </div>
    <div class="form-group">
        <label for="" class="label">Select car to rent</label>
        <select name="car_id" id="">
            @foreach($cars as $car)
                <option value="{{ $car->id }}">{{ $car->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-secondary py-3 px-4">Rent A Car Now</button>
    </div>
</form>
