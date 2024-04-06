<?php
$target = $_SERVER['DOCUMENT_ROOT'] . "/storage/app/public";
$link = $_SERVER['DOCUMENT_ROOT'] . "/public/storage";

if (symlink($target, $link)) {
    echo "OK.";
} else {
    echo "Failed: " . error_get_last()['message'];
}
?>
