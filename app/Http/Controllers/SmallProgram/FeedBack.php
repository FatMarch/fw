<?php

namespace App\Http\Controllers\SmallProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedBack extends Controller
{
    //
    public function postFeed(Request $request)
    {
        $con  = $request->get('con');
        $data = [
            'uid' => 1,
            'content' => $con ?? 1,
        ];

        $result = (new \App\Model\SmallProgram\FeedBack())->insert($data);

        return response()->json($result);
    }

    public function getFeedInfo(Request $request)
    {
        $fid = $request->get('fid');
        $info = (new \App\Model\SmallProgram\FeedBack())->find($fid);

        return response()->json($info);
    }
}
