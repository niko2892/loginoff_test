<?php

$i = 0;
$imgID = rand(1, 3);
$img = file_get_contents("./img/$imgID.jpg");
if ($img) {
    if(!$_COOKIE['i']) {
        setcookie("i", 1, time()+3600, '/');
    } else {
        setcookie("i", ++$_COOKIE['i'], time()+3600, '/');
    }
    echo $img;
} else {
    setcookie("i", $_COOKIE['i'], time()+3600, '/');
}


