<?php

namespace App\Http\Controllers\SmallProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SmallProgram\Model_CookBook;

class CookBook extends Controller
{
    public function __construct()
    {
        $this->model = new Model_CookBook();
    }

    public function getCook(Request $request)
    {

    }



    public function initCate()
    {
        return $this->model->initCate();
    }
}
