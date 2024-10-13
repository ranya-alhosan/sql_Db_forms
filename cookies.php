<?php
$cookie_name = "page_counter";

if (isset($_COOKIE[$cookie_name])) {
    $counter = $_COOKIE[$cookie_name] + 1;
} else {
    $counter = 1;
}

setcookie($cookie_name, $counter, time() +10, "/");

echo "You have refreshed this page " . $counter . " times.";
?>
