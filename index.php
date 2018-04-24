<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once (__DIR__ . "/config.php");
require_once(SITE_ROOT . "/includes/header.php");

?>
<body>
<div>Exercise Bot</div>
<br>
<div>Choose your day:</div>
<br>
<div><a href="/exercise_generator/view/monday.php">Monday</a></div>
<div><a href="/tuesday.php">Tuesday</a></div>
<div><a href="/wednesday.php">Wednesday</a></div>
<div><a href="/thursday.php">Thursday</a></div>
<div><a href="/friday.php">Friday</a></div>


</body>
</html>