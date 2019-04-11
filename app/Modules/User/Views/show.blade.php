@extends('layouts.master')
<?php $title = 'Welcome';?>
@section('title','Streamlabs - '.$data["userInfo"]->display_name)
@section('breadcrumb')
<h4><i class="icon-arrow-left52 position-left"></i><strong>{{$data["userInfo"]->display_name}}</strong></h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="twitch-embed"></div>
    </div>
    <script src="https://embed.twitch.tv/embed/v1.js"></script>
    <script type="text/javascript">
        new Twitch.Embed("twitch-embed", {
           width: screen.width-60,
           height: screen.height-300,
           channel: "{{$data["userInfo"]->display_name}}"
        });
    </script> 

</div>
<div class="row" id="rows" style="display:none;" >
    <div class="col-md-12">
        <div class="panel panel-body border-top-primary">
            <div class="text-left">
                <h6 class="no-margin text-semibold">Latest Events</h6>
                <p></p>
            </div>

            <div id="latestEvent"></div>
        </div>
    </div>
</div>

@stop
@push("scripts")

<script src="{{ asset('public/echo.js') }}"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script>
    Pusher.logToConsole = true;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '66660eea54c01edb6d09',
        cluster: 'ap2',
        encrypted: true,
        logToConsole: true
    });
    
    Echo.private('user.{{Auth::user()->id}}')
    .listen('EventsNotification', (e) => {
        console.log(e.message);
        $("#rows").show();
        toastr.success('You have a new notification','Live Updates!!!')
        $("#latestEvent").append(e.message);
    });
</script>
@endpush        