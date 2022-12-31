<?php

// For testing purposes
function dd($item = 'hello world')
{
    echo "<pre>";
    print_r($item);
    echo "</pre>";
    die;
}
