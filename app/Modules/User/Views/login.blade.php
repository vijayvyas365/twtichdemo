@extends('layouts.login')
@section('title','Streamlabs - Login' )
@section('login')
<div class="panel panel-body login-form" style="margin-top: 250px;">
    <div class="text-center">
        <div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
    </div>
    @include('layouts.message')
    <div class="form-group">
        <a href="{{$data['authURL']}}" class="btn bg-pink-400 btn-block legitRipple">Login With Twitch<i class="icon-circle-right2 position-right"></i></a>
    </div>
</div>
@stop