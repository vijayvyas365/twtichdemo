<h1>StreamerEventViewer (SEV)</h1>


<blockquote><p>The first/home page lets a user login with Twitch and set their favorite Twitch streamer name. This initiates a backend event listener which listens to all events for given streamer.</p></blockquote>

As per the requirement, you just have to log in with your twitch account. After logged in, you can able to search streamer/channel and you can mark/add as your favourite streamer.

<blockquote><p>he second/streamer page shows an embedded livestream, chat and list of 10 most recent events for your favorite streamer. This page doesn’t poll the backend and rather leverages web sockets and relevant Twitch API.</p></blockquote>

On this page, you can able to see embedded live stream, chat and recents events of your favorite streamer. I am not storing this events into the database.so,you have to wait for events trigger like update profile, following user etc.

<h2>Demo</h2>
<p>Demo URL: http://18.218.204.8/twitch/</p>
<p>Repository URL: https://github.com/vijayvyas365/twtichdemo</p>

<h2>Server Requirments</h2>

<ul>
    <li>PHP 7.2.X or Above</li>
    <li>Apache 2.4.x or Above</li>
</ul>

<h2>Library</h2>
<ul>
    <li>Laravel 5.8</li>
    <li>Twitch API</li>
</ul>


<h2>Questions</h2>

<blockquote><p>How would you deploy the above on AWS? (ideally a rough architecture diagram will help)</p></blockquote>

<p align="center"><img src="http://18.218.204.8/twitch/public/diagram.png" /></p>

Above diagram describes that Team will commit the code on gitHub after that code automatically will deploy to server through code deploy tool (like Jenkins, GitLab, Teamcity etc) 

<blockquote><p>Where do you see bottlenecks in your proposed architecture and how would you approach scaling this app starting from 100 reqs/day to 900MM reqs/day over 6 months?</p></blockquote>

My Application can't handle too many request. So for that problem, we can configure Amazon EC2 Auto Scaling. that will help me to handle the load for my application.Parameters like minimum and maximum number of instances are set by the user. Using this, the number of Amazon EC2 instances you’re using increases automatically as the demand rises to maintain the performance
