@if(empty($data["userFollowing"]["follows"]))
<span style="color:red;">No any following user found.</span>
@else
    @foreach($data["userFollowing"]["follows"] as $key => $val)
    <div class="col-lg-3 col-sm-6">
        <div class="thumbnail">
            <div class="thumb">
                <img src="{{$val["channel"]["logo"]}}" alt="">
                <div class="caption-overflow">
                    <span>
                        <a href="{{URL::route('user.show',$val['channel']["_id"])}}" title="View" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5">
                            <i class="icon-eye"></i>
                        </a>
<!--                        <a href="#" title="Unfollow" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5">
                            <i class="icon-heart-broken2"></i>
                        </a>-->
                    </span>
                </div>
            </div>

            <div class="caption">
                <h6 class="no-margin-top text-semibold">
                    <a href="{{URL::route('user.show',$val['channel']["_id"])}}" class="text-default">
                        {{$val['channel']["_id"]}}
                        -
                        {{$val['channel']["display_name"]}}
                    </a> 
                    <a href="#" class="text-muted"><i class="icon-download pull-right"></i></a>
                </h6>
                {{substr($val["channel"]["description"],0,50)}}...
                
                Following
            </div>
        </div>
    </div>
    @endforeach
@endif