<?php

namespace App\Http\Controllers\SmallProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Express extends Controller
{
    //
    public function showExpress()
    {
        echo file_get_contents("https://m.kuaidi100.com/index_all.html?type=全峰&postid=123456");
    }
}
