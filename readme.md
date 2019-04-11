<h1>StreamerEventViewer (SEV)</h1>


<blockquote><p>The first/home page lets a user login with Twitch and set their favorite Twitch streamer name. This initiates a backend event listener which listens to all events for given streamer.</p></blockquote>

<blockquote><p>he second/streamer page shows an embedded livestream, chat and list of 10 most recent events for your favorite streamer. This page doesn’t poll the backend and rather leverages web sockets and relevant Twitch API.</p></blockquote>


<h1>Demo</h1>
<p>Demo URL: http://18.218.204.8/twitch/</p>
<p>Repository URL: https://github.com/vijayvyas365/twtichdemo</p>


<h1>Questions</h1>

<blockquote><p>How would you deploy the above on AWS? (ideally a rough architecture diagram will help)</p></blockquote>

<p align="center"><img src="http://18.218.204.8/twitch/public/diagram.png" /></p>

Above diagram describes that Team will commit the code on gitHub after that code automatically will deploy to server through code deploy tool (like Jenkins, GitLab, Teamcity etc) 

<blockquote><p>Where do you see bottlenecks in your proposed architecture and how would you approach scaling this app starting from 100 reqs/day to 900MM reqs/day over 6 months?</p></blockquote>

My Application can't handle too many request. So for that problem, we can configure Amazon EC2 Auto Scaling. that will help me to handle the load for my application.Parameters like minimum and maximum number of instances are set by the user. Using this, the number of Amazon EC2 instances you’re using increases automatically as the demand rises to maintain the performance
