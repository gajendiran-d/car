@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-none d-md-block">&nbsp;</div>
                @if (\Session::has('success'))
                    <div class="alert alert-success  text-center">
                        <p>{{ \Session::get('success') }}</p>
                    </div><br />
                @endif
                @if (\Session::has('error'))
                    <div class="alert alert-danger  text-center">
                        <p>{{ \Session::get('error') }}</p>
                    </div><br />
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <div class="row">
                                <div class="col-md-8">{{ __('Car List') }}</div>
                                <div class="col-md-4 text-right"><span class="badge badge-dark">{{ $count }}</span>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->type == 'A' || Auth::user()->type == 'M')
                            <div align="right">
                                <a href="{{ action('CarController@create') }}"> <i
                                        class="fa fa-plus fa-2x text-success"></i></a>
                            </div>
                        @endif
                        @if ($count == 0)
                            <div class="text-center text-danger">Sorry no data exist</div>
                            <div>&nbsp;</div>
                        @else
                            <div class="table-responsive">
                                <table id="carTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Brand</th>
                                            <th class="text-left">Model</th>
                                            <th class="text-left">Color</th>
                                            <th class="text-left">Year</th>
                                            @if (Auth::user()->type == 'A')
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($car as $value)
                                            <td class="text-left"><label
                                                    class="col-form-label">{{ $value['brand'] }}</label></td>
                                            <td class="text-left"><label
                                                    class="col-form-label">{{ $value['model'] }}</label></td>
                                            <td class="text-left"><label
                                                    class="col-form-label">{{ $value['color'] }}</label></td>
                                            <td class="text-left"><label class="col-form-label">{{ $value['year'] }}</label>
                                            </td>
                                            @if (Auth::user()->type == 'A')
                                                <td class="text-center"><a class="btn btn-link"
                                                        href="{{ action('CarController@edit', $value['id']) }}"><i
                                                            class="fa fa-edit text-primary"></i></a></td>
                                                <td class="text-center">
                                                    <form onclick="return confirm('Do you really want to delete?')"
                                                        action="{{ action('CarController@destroy', $value['id']) }}"
                                                        method="post">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-link" type="submit"><i
                                                                class="fa fa-trash text-danger"></i></button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#carTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('car.list') !!}',
                columns: [{
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'model',
                        name: 'model'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });
    </script> --}}
@endsection
