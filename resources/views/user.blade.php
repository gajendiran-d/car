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
                        <div class="col-md-8">{{ __('List User') }}</div>
                        <div class="col-md-4 text-right"><span class="badge badge-dark">{{$count}}</span></div>
                    </div>
                </h4>
            </div>
            <div class="card-body">
          @if($count==0)
            <div class="text-center text-danger">Sorry no data exist</div>
            <div>&nbsp;</div>
          @else
  <div class="table-responsive">
    <table class="table table-striped">
    <thead>
      <tr>
        <th class="text-left">Name</th>
        <th class="text-left">Email</th>
        <th class="text-left">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($user as $value)
            <tr>
            <td class="text-left"><label class="col-form-label">{{$value['name']}}</label></td>
            <td class="text-left"><label class="col-form-label">{{$value['email']}}</label></td>
            @if($value['type']=='U')
            <td class="text-left">
              <form  action="{{action('HomeController@updateUser')}}" method="post">
                @csrf
                <input name="id" type="hidden" value="{{$value['id']}}">
                <input name="type" type="hidden" value="M">
                <button class="btn btn-info" type="submit">Change to Moderator</button>
              </form>
            </td>
            @endif
            @if($value['type']=='M')
            <td class="text-left">
              <form  action="{{action('HomeController@updateUser')}}" method="post" >
                @csrf
                <input name="id" type="hidden" value="{{$value['id']}}">
                <input name="type" type="hidden" value="AU">
                <button class="btn btn-warning" type="submit">Change to Author</button>
              </form>
            </td>
            @endif
            </tr>
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
 @endsection
