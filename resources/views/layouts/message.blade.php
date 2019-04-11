@if(Session::has('flash_message'))
<div class="alert alert-success">
    <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold"> {{ Session::get('flash_message') }}</span>
</div>
@endif

@if(Session::has('error_message'))
<div class="alert alert-danger">
    <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold"> {{ Session::get('error_message') }}</span>
</div>
@endif