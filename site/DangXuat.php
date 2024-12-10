<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 4/16/2017
 * Time: 5:25 PM
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>
</head>

<body>
<?php
session_start();
ob_start();
session_destroy();
header("location: ../site/index.php?index=1");
?>
</body>
</html>
