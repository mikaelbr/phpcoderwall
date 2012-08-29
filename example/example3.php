<?php
require '../vendor/autoload.php';

$coderwall = PhpCoderwall\PhpCoderwall::getInstance();
$team = $coderwall->getTeamById("4f27193d973bf0000400029d");
?>

<pre>
    <?php print_r($team) ?>
</pre>