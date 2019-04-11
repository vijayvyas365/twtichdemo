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


