<p align="center"><img src="https://streamlabs.com/imgs/logos/logo-night.svg"></p>


The first/home page lets a user login with Twitch and set their favorite Twitch streamer name. This initiates a backend event listener which listens to all events for given streamer.

The second/streamer page shows an embedded livestream, chat and list of 10 most recent events for your favorite streamer. This page doesn’t poll the backend and rather leverages web sockets and relevant Twitch API.