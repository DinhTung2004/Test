<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 14-May-17
 * Time: 15:04
 */
    session_start();ob_start();

if(isset($_SESSION['cart']) && $_SESSION['cart']!= null)
{
    echo "<pre>";
    print_r($_SESSION['cart']);
}
else echo "rong";

?>

