<?php

namespace App\Http\Controllers\SmallProgram;

use App\Libs\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SmallProgram\Model_Calendar;

class Calendar extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Calendar();
    }

    //
    public function getDayInfo(Request $request)
    {
        $date = $request->get('date');
        if (empty($date)) {
            $date = date('Ymd');
        }

        $info = $this->model->where(['day' => $date])->first();
        if (!empty($info)) {
            $info = $info->toArray();
            return Http::json(10000, '请求成功', $info);
        }
        return Http::json(10004, '没有找到对应的信息');
    }
}
