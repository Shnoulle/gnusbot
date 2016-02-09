# gnusbot
GnuSBot aka. GSB is a GNUSocial bot written in PHP that fetchs RSS/Feed entries and publish them to the chosens GNU Social accounts. Just a first draft, feel free to request changes or collaborate. There's a lot to do better.
<br />
    The script allows to publish multiple RSS feeds in multiple accounts/nodes.

<h2>TODO</h2>
* Put the username prefix in control filenames so there can be different things published in different accounts configured at different times, currently control file is per-website, so it assumes that when a post is published (quitted) it is done for all usernames/accounts
* We are not checking values returned from the API to give the returned=true whe publishing via CURL

<h2>Changelog</h2>
<h3>Version 0.1.1 - 2016-02-08</h3>
<ul class="task-list">
<li>First release</li>
</ul>

<h2>Demo</h2>
https://quitter.no/notice/1010101
