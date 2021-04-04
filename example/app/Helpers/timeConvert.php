<?php

use Carbon\Carbon;


function timeConvert($time)
{
    $element = new Carbon($time);
    return $element->diffForHumans();
}
