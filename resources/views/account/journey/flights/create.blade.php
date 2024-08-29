<form action="/account/journey/flights/create" method="POST">
    @csrf

    <div>
        <label for="origin_name">
            Origin Name
            @if ($errors->has('origin_name'))
                <span>{{ $errors->first('origin_name') }}</span>
            @endif
        </label>
        <input type="text" name="origin_name" id="origin_name" placeholder="London"
            value="{{ old('origin_name') ?? '' }}">
    </div>

    <div>
        <label for="destination_name">
            Destination Name
            @if ($errors->has('destination_name'))
                <span>{{ $errors->first('destination_name') }}</span>
            @endif
        </label>
        <input type="text" name="destination_name" id="destination_name" placeholder="Zurich"
            value="{{ old('destination_name') ?? '' }}">
    </div>

    <div>
        <label for="origin_lat">
            Origin Latitude
            @if ($errors->has('origin_lat'))
                <span>{{ $errors->first('origin_lat') }}</span>
            @endif
        </label>
        <input type="text" name="origin_lat" id="origin_lat" placeholder="Origin latitude"
            value="{{ old('origin_lat') ?? '' }}">
    </div>

    <div>
        <label for="origin_lng">
            Origin Longitude
            @if ($errors->has('origin_lng'))
                <span>{{ $errors->first('origin_lng') }}</span>
            @endif
        </label>
        <input type="text" name="origin_lng" id="origin_lng" placeholder="Origin longitude"
            value="{{ old('origin_lng') ?? '' }}">
    </div>

    <div>
        <label for="destination_lat">
            Destination Latitude
            @if ($errors->has('destination_lat'))
                <span>{{ $errors->first('destination_lat') }}</span>
            @endif
        </label>
        <input type="text" name="destination_lat" id="destination_lat" placeholder="Destination latitude"
            value="{{ old('destination_lat') ?? '' }}">
    </div>

    <div>
        <label for="destination_lng">
            Destination Longitude
            @if ($errors->has('destination_lng'))
                <span>{{ $errors->first('destination_lng') }}</span>
            @endif
        </label>
        <input type="text" name="destination_lng" id="destination_lng" placeholder="Destination longitude"
            value="{{ old('destination_lng') ?? '' }}">
    </div>

    <button type="submit">Save</button>
    <a href="/account/journey">Cancel</a>
</form>
