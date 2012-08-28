<?php
require '../vendor/autoload.php';

$coderwall = PhpCoderwall\PhpCoderwall::getInstance();
$team = $coderwall->getTeam("Github");
?>

<pre>
    <?php print_r($team) ?>
</pre>