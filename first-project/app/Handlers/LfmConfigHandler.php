<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Auth;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        return Auth::guard('admin')->user()->id;
    }
}
