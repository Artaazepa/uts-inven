<!-- location-items/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Commodities by Location</h2>
    
    <form method="GET" action="{{ route('commodities.index') }}">
        <label for="commodity_location_id">Select Room:</label>
        <select name="commodity_location_id" id="commodity_location_id" onchange="this.form.submit()">
            <option value="">All Rooms</option>
            @foreach ($commodity_locations as $location)
                <option value="{{ $location->id }}" {{ request('commodity_location_id') == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Condition</th>
                <th>Brand</th>
                <th>Year of Purchase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commodities as $commodity)
                <tr>
                    <td>{{ $commodity->name }}</td>
                    <td>{{ $commodity->condition }}</td>
                    <td>{{ $commodity->brand }}</td>
                    <td>{{ $commodity->year_of_purchase }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
