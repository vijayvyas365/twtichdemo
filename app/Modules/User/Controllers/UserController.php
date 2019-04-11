<?php

/**
 * @author Vijay Vyas <vijayvyas3802@gmail.com>
 */

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Auth;
use romanzipp\Twitch\Twitch;
use TwitchApi;
use App\Events\EventsNotification;

class UserController extends Controller {

    /**
     * 
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function index() {
        return View::make("User::index");
    }

    /**
     * searching channel/streams
     * @param Request $request
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function search(Request $request) {
        $query = $request->input("search");
        $type = $request->input("type");

        $option = [
            'query' => $query,
        ];
        $result = TwitchApi::searchChannels($option);
        return json_encode($result["channels"]);
    }

    /**
     * User Following ajax request with webhook subscription
     * @param Request $request
     * @param type $channel
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function follow(Request $request, $channel) {
        try {
            $option = [];
            $res = TwitchApi::follow(Auth::user()->twitch_id, $channel, $option, Auth::user()->token);

            $twitch = new Twitch();

            $userUpdate = $twitch->webhookTopicStreamMonitor($channel);
            $twitch->subscribeWebhook(Config("constant.BASE_URL") . 'events/' . Auth::user()->id, $userUpdate, (int) Config("constant.MAX_TIME"));

            $userFollow = $twitch->webhookTopicUserFollows($channel);
            $twitch->subscribeWebhook(Config("constant.BASE_URL") . 'events/' . Auth::user()->id, $userFollow, Config("constant.MAX_TIME"));

            $toUserFollow = $twitch->webhookTopicUserGainsFollower($channel);
            $twitch->subscribeWebhook(Config("constant.BASE_URL") . 'events/' . Auth::user()->id, $toUserFollow, Config("constant.MAX_TIME"));
        } catch (Exception $ex) {
            return 'Oops! Something went wrong. Please contact to suppor team.';
        }
    }

    /**
     * get User Following List
     * @param Request $request
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function getFollowingList(Request $request) {
        $data = [];
        $options = [
            'direction' => 'DESC',
            'sortby' => 'created_at',
        ];
        $data["userFollowing"] = TwitchApi::followings(Auth::user()->twitch_id, $options);
        return View::make("User::following_user_ajax")->with("data", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function show($userId) {
        $data = [];
        $data["userInfo"] = (object) TwitchApi::user($userId);
        $data["userId"] = $userId;
        return view("User::show")->with("data", $data);
    }

    /**
     * it's callback method. twitch will verified webhook subscription through this method
     * @param Request $request
     * @param type string & id
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function events(Request $request, $userId) {
        $all = $request->all();
        \Log::debug(print_r($all, true));

        $data = '';
        $eventData = isset($all["data"][0]) ? $all["data"][0] : [];
        if (isset($eventData["followed_at"])) {
            $uID = $eventData["from_id"];
            $data = '<div class="well border-top-lg border-top-danger">' . $eventData["from_name"] . ' following to ' . $eventData["to_name"] . '</div><br>';
        }

        if (isset($eventData["display_name"])) {
            $uID = $eventData["id"];
            $data = '<div class="well border-top-lg border-top-danger">' . $eventData["display_name"] . ' has updated his profile.</div><br>';
        }
        event(new EventsNotification($data, $userId));
        //event(new EventsNotification($all["data"][0], $userId));
        if (isset($all['hub_challenge'])) {
            echo $all['hub_challenge'];
        }
    }

}
