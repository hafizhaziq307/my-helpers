<?php

// For testing purposes
function dd($item = 'hello world')
{
    echo "<pre>";
    print_r($item);
    echo "</pre>";
    die;
}

function printResult($obj, $attributes)
{
    foreach ($attributes as $attribute) {
        echo "<div>" . $attribute . ": "  . $obj->$attribute . "</div>";
    }
    echo "<br>";
}
