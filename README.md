# phpCoderwall v0.1


## Requirements

* PHP > v.5.3.0
* Access to request pages (curl or file_get_contents)

For easier installation you should also have [composer](http://getcomposer.org/) installed. 

## Documentation and Examples 

### Fetching user information
```php
<?php
require 'vendor/autoload.php';

$coderwall = PhpCoderwall\PhpCoderwall::getInstance();
$user = $coderwall->getUser("mikaelbr", true);

// E.g. use:
echo $user->name;
?>
```

*Notice:* The second argument defines if we want to fetch full information about a user. This entails
more user properties and full information about the team given user is a part of.

#### Properties of the CoderwallUser object

<table>
    <tr><th>Property</th><th>Description</th></tr>
    <tr>
        <td>username</td>
        <td>The username of given user.</td>
    </tr>
    <tr>
        <td>name</td>
        <td>Full name of the user.</td>
    </tr>
    <tr>
        <td>location</td>
        <td>Location of the user. E.g. Norway.</td>
    </tr>
    <tr>
        <td>endorsements</td>
        <td>The number of endorsements a user has recived.</td>
    </tr>
    <tr>
        <td>team</td>
        <td>This is a ID to the users team. Can be run through PhpCoderwall#getTeamById() to get full team information.</td>
    </tr>
    <tr>
        <td>accounts</td>
        <td>Collection of all the account types the user has on Coderwall. See more information under properties of the Account object.</td>
    </tr>
    <tr>
        <td>badges</td>
        <td>A collection of CoderwallBadges. See more information about the badges class below.</td>
    </tr>
    <tr>
        <td>badgesCount</td>
        <td>The number of total badges the user has.</td>
    </tr>
</table>

#### Additional properties of the full information CoderwallUser object

<table>
    <tr><th>Property</th><th>Description</th></tr>
    <tr>
        <td>title</td>
        <td>Self set title for user.</td>
    </tr>
    <tr>
        <td>company</td>
        <td>What company the user works for</td>
    </tr>
    <tr>
        <td>thumbnail</td>
        <td>URL to the avatar image thumbnail.</td>
    </tr>
    <tr>
        <td>specialities</td>
        <td>Collection of strings. A set of specialities the user has added.</td>
    </tr>
    <tr>
        <td>accomplishments</td>
        <td>Collection of strings. A set of accomplishments the user has added</td>
    </tr>
</table>

#### Properties of the Account object

<table>
    <tr><th>Property</th><th>Description</th></tr>
    <tr>
        <td>type</td>
        <td>The account type. Either github, twitter or linkedin</td>
    </tr>
    <tr>
        <td>username</td>
        <td>The users username on the given account type.</td>
    </tr>
</table>

#### Properties of the CoderwallBadge object

<table>
    <tr><th>Property</th><th>Description</th></tr>
    <tr>
        <td>name</td>
        <td>The name of the achivement/badge.</td>
    </tr>
    <tr>
        <td>description</td>
        <td>Extended badge description</td>
    </tr>
    <tr>
        <td>created</td>
        <td>A timestamp of when the user recived the badge. E.g. "2012-02-23T19:03:55Z"</td>
    </tr>
    <tr>
        <td>badge</td>
        <td>URL to the badge image.</td>
    </tr>
</table>


### Fetching team information
```php
<?php
require 'vendor/autoload.php';

$coderwall = PhpCoderwall\PhpCoderwall::getInstance();
$team = $coderwall->getTeam("Github");

// E.g. use:
echo $team->score;
?>
```

*Notice:* As per now, the Coderwall's Team API isn't really open and working, so there is a 5 min cache. This means
that if you try to first get the Github team and right away the Heroku team, you'll get the Github team information
both times. We'll just have to wait until Coderwall releases the Team API to the public.

#### Properties of the CoderwallTeam object

<table>
    <tr><th>Property</th><th>Description</th></tr>
    <tr>
        <td>name</td>
        <td>The name of the team.</td>
    </tr>
    <tr>
        <td>id</td>
        <td>The teams unique ID.</td>
    </tr>
    <tr>
        <td>score</td>
        <td>Score in the Coderwall leader board.</td>
    </tr>
    <tr>
        <td>rank</td>
        <td>Ranking in the Coderwall leader board.</td>
    </tr>
    <tr>
        <td>size</td>
        <td>Number of team members</td>
    </tr>
    <tr>
        <td>slug</td>
        <td>Filtered team name, used in the Coderwall URL.</td>
    </tr>
    <tr>
        <td>avatar</td>
        <td>URL to the image avatar.</td>
    </tr>
    <tr>
        <td>country</td>
        <td>Collection of strings. With each index a country of the given team.</td>
    </tr>
    <tr>
        <td>neighbors</td>
        <td>Overview of the team neighbors. Collection of simplified CoderwallTeam objects with all properties set, except the following: neighbors and teamMembers</td>
    </tr>
    <tr>
        <td>teamMembers</td>
        <td>Overview of the teams members. Collection of simplified CoderwallUser objects only with the following properties set: username, name, endorsements and badgesCount</td>
    </tr>
</table>

### Fetching team information by team ID
```php
<?php
require 'vendor/autoload.php';

$coderwall = PhpCoderwall\PhpCoderwall::getInstance();
$team = $coderwall->getTeamById("4f27193d973bf0000400029d");

// E.g. use:
echo $team->name; // Github
?>
```

Returns a CoderwallTeam object as seen above.

## Installation

Install phpCoderwall by using [composer](http://getcomposer.org/) and add a `composer.json` file 
to your root, with the following content:

```
{
    "require": {
        "mikaelbr/phpcoderwall": "dev-master"
    }
}
```

Then run (in the root, with a terminal), depending on your setup, either 

```
composer install
```

or 

```
php composer.phar install
```

With this you can try to run a example as shown above.

---------

You can also use this library without composer. Just get the code base by cloning the repository, 
and either write an auto load function or require the files manually. 