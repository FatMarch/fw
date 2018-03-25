<?php

namespace App\Http\Controllers\SmallProgram;

use App\Libs\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SmallProgram\Model_FeedBack;

class FeedBack extends Controller
{
    public function __construct()
    {
        $this->model = new Model_FeedBack();
    }

    /**
     * 意见反馈
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postFeed(Request $request)
    {
        $con  = $request->post('cont');
        if (empty($con)) {
            return Http::json(0, '说点什么吧~');
        }

        $data = [
            'uid' => 1,
            'content' => $con,
        ];

        $result =$this->model->insert($data);
        if ($result) {
            return Http::json(1, '提交成功');
        }

        return Http::json(0, '提交失败');
    }

    /**
     * 获取反馈信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeedInfo(Request $request)
    {
        $fid = $request->get('fid');
        $info = $this->model->find($fid);

        return response()->json($info);
    }
}
