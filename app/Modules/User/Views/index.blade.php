@extends('layouts.master')
@section('title','Streamlabs - '.Auth::user()->username )
@section('breadcrumb')
<h4><i class="icon-arrow-left52 position-left"></i><strong>Search channels</strong> </h4>
@stop
@section('quick_link')
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat" >
            <div class="panel-body">
                <select class="select"></select>
            </div>
        </div>
    </div>
</div>

<div id='searchResult' class="row hide">
    <div class="col-md-12">
        <div class="panel panel-flat" >
            <div class="panel-body" id="searchChannelResult"></div>
        </div>
    </div>
</div>
<h4><i class="icon-arrow-left52 position-left"></i><strong>To whom i am following</strong> </h4>
<div class="row" id="followingList" style="min-height: 600px;">
    
</div>

@stop
@push("scripts")
<script type="text/javascript">
    $(document).ready(function () {
        $('.select').select2({
            placeholder: 'Search for a channel',
            minimumInputLength: 1,
            delay: 250,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection,
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                url: '{{URL::route("user.search")}}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function (data) {

                    var arr = []
                    $.each(JSON.parse(data), function (key, item) {
                        arr.push({
                            id: item._id,
                            text: item.name,
                            description: item.description,
                            logo: item.logo,
                            followers: item.followers,
                            views: item.views
                        })
                    })
                    return {
                        results: arr
                    };
                },
            }
        });

        getUserFollowingList();
    });

    /**
     * It will get user following list
     * @returns html response
     * @author Vijay Vyas
     */
    function getUserFollowingList() {
        $.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            }
        });
        $.ajax({
            url: "{{URL::route('user.getFollowingList')}}",
            method: "GET",
            processData: false,
            cache: false,
            success: function (result) {
                $("#followingList").html(result);
                $.unblockUI();
            }
        });
    }

    /**
     * Ajax call for follow user
     * @param {type} channel
     * @returns NULL
     * @author Vijay Vyas     
     */    
    function follow(channel) {
         $.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            }
        });
        $.ajax({
            url: "{{URL::route('user.follow',[''])}}/" + channel,
            method: "GET",
            processData: false,
            cache: false,
            success: function (result) {
                $.unblockUI();
                getUserFollowingList();
                $("#searchChannelResult").html("");
                $("#searchResult").addClass('hide');
                toastr.success('Added as favourite', 'Success');
            }
        });
    }

    /**
    * 
     * @param {type} res
     * @returns {undefined}     
     * @author Vijay Vyas
     */ 
    function prepareUser(res) {
        var result = '<div class="media stack-media-on-mobile content-group">';
        result += '<a href="#" class="media-left"><img src="' + res.logo + '" class="img-responsive img-rounded media-preview" alt=""></a>';
        result += '<div class="media-body">';
        result += '<h6 class="media-heading"><a href="#">' + res.text + '</a></h6>';
        result += '<ul class="list-inline list-inline-separate text-muted">';
        result += '<li>Watchers: ' + res.views + '</li>';
        result += '<li>Followers: ' + res.followers + '</li>';
        result += '</ul>';
        result += res.description;
        result += '<br><br><button id="followingBTN" onclick="follow(' + res.id + ')" type="button" class="btn bg-danger-400" ><i class="icon-heart5"></i> Follow</button>'
        result += '</div>';

        result += '</div>';
        $("#searchChannelResult").html(result);
    }

    /**
     * it will format the searching result with Logo, followers and viewers
     * @param {type} repo
     * @returns {String}
     * @author Vijay Vyas
     */
    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }
        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><img src='" + repo.logo + "' /></div>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.text + "</div>";
        if (repo.description) {
            markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
        }
        markup += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.followers + " Followers</div>" +
                "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.views + " Watchers</div>" +
                "</div>" +
                "</div></div>";
        return markup;
    }

    /**
     * 
     * @param {type} repo
     * @returns {unresolved}
     * @author Vijay Vyas
     */
    function formatRepoSelection(repo) {
        if (repo.text !== 'Search for a channel') {
            $("#searchResult").removeClass('hide');
            prepareUser(repo);
        }

        return repo.text;
    }

</script>
@endpush