<?php
require '../vendor/autoload.php';

$coderwall = PhpCoderwall\PhpCoderwall::getInstance();
$user = $coderwall->getUser("mikaelbr");
?>

<pre>
    <?php print_r($user) ?>
</pre>