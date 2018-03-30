<?php

namespace App\Model\SmallProgram;

use App\Libs\Curl;
use Illuminate\Database\Eloquent\Model;

class Model_DriverExam extends Model
{
    //
    protected $table = 'sp_driver_exam';

    protected $primaryKey = 'id';

    protected $apiUrl = "https://way.jd.com/jisuapi/driverexamQuery?";

    public function dataSpider($subject = 1, $type = 'C1')
    {
        $count = 1121;
        $key = env('JCLOUD_APPKEY');
        $priod = ceil($count/30);
        $param = [
            'type' => $type, 'subject' => $subject,
            'pagesize' => 30, 'sort' => 'normal',
            'appkey' => $key
        ];

        for ($i = 1; $i <= $priod; $i++) {
            $param['pagenum'] = $i;
            $url = $this->apiUrl . http_build_query($param);
            $ret = Curl::get($url);
            $ret = json_decode($ret, true);

            if (10000 == $ret['code']) {
                $detail = $ret['result']['result']['list'];
                $time = time();
                foreach ($detail as $item) {
                    $item['type'] = $type;
                    $item['subject'] = $subject;
                    $item['add_time'] = $time;

                    $ret = $this->insert($item);
                    var_dump($ret);
                }
            } else {
                echo "$i 请求失败 \n";
            }

            usleep(50000);
        }

    }
}
