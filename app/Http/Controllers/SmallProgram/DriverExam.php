<?php

namespace App\Http\Controllers\SmallProgram;

use App\Libs\Http;
use App\Model\SmallProgram\Model_DriverExam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverExam extends Controller
{
    public function __construct()
    {
        $this->model = new Model_DriverExam();
    }
    //
    public function getQuestions(Request $request)
    {
        $type = $request->get('type', 1);
        $level = $request->get('lv', 1);

        $where = [
            'type'  => $type,
            'level' => $level
        ];
        $list = $this->model->where($where)->get();

        return Http::json(10000, '获取成功', $list);
    }
}
