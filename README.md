# gnusbot
Yet another GNU Social RSS/Feed Bot written in PHP.
The script allows to publish multiple rss feeds in multiple accounts/nodes

== TODO ==
* Put the username prefix in control filenames so there can be different things published in different accounts configured at different times, currently control file is per-website, so it assumes that when a post is published (quitted) it is done for all usernames/accounts
* We are not checking values returned from the API to give the returned=true whe publishing via CURL
