<?php

return [
    'client_id'     => env('TWITCH_KEY', ''),
    'client_secret' => env('TWITCH_SECRET', ''),
    'redirect_url'  => env('TWITCH_REDIRECT_URI', ''),
    //'scopes'         => 'channel_read+viewing_activity_read+user:read:broadcast+channel_editor+user:edit+user:edit:broadcast+user:read:broadcast+channel_read'
    //'scopes'         => 'channel_read'
    'scopes' => [
        'channel_read',
        'viewing_activity_read',
        'channel_check_subscription',
        'channel_commercial',
        'channel_editor',
        'channel_feed_edit',
        'channel_feed_read',
        'channel_stream',
        'user_subscriptions',
        'user_read',
        'user_follows_edit',
        'user_blocks_read',
        'user_blocks_edit',
        'channel:moderate',
        'chat:edit',
        'chat:read',
        'whispers:read',
        'whispers:edit',
        'analytics:read:games',
        'channel:read:subscriptions',
        'clips:edit',
        'user:edit',
        'user:edit:broadcast',
        'user:read:email',
        'user:read:broadcast',
    ],
];
