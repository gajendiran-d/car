@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success  text-center">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger  text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center"><b>{{ __('Edit Car') }}</b></div>

                    <div class="card-body">
                        <form method="post" action="{{ action('CarController@update', $id) }}"
                            enctype="multipart/form-data" name="form" id="form">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Brand') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="brand" value="{{ $car['brand'] }}"
                                        maxlength="75" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Model') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="model" value="{{ $car['model'] }}"
                                        maxlength="75" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Color') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="color" value="{{ $car['color'] }}"
                                        maxlength="75" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Year') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="year" required>
                                        @php
                                            $currentYear = date('Y');
                                        @endphp
                                        @foreach (range(1980, $currentYear) as $value)
                                            <option value="{{ $value }}"
                                                @if ($car['year'] == $value) selected @endif>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Address') }}</label>
                                <div class="col-md-8">
                                    <div id="map" style="height: 300px;"></div>
                                    <div id="display-coordinates" class="text-primary">Latitude: {{ $car['latitude'] }}, Longitude: {{ $car['latitude'] }}</div>
                                </div>
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label">{{ __('Image') }}<span
                                        class="text-danger"> *</span></label>
                                <div class="col-md-4">
                                    <input type="file" name="image" id="image" onchange="imagePreview(this);" />
                                </div>
                                <div class="col-md-4" align="right">
                                    <img id="image_preview" width="100px" height="60px"
                                        src="{{ URL::to('/') }}/img/{{ $car['image'] }}" />
                                </div>
                                <script type="text/javascript">
                                    function imagePreview(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#image_preview').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                            </div>

                            <div align="right">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('display-coordinates').innerText = "Latitude: " + lat + ", Longitude: " + lng;
        });
    </script>
@endsection
