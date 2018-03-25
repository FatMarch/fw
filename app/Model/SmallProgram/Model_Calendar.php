<?php

namespace App\Model\SmallProgram;

use App\Libs\Curl;
use Illuminate\Database\Eloquent\Model;

class Model_Calendar extends Model
{
    protected $table = 'sp_calendar';

    protected $primaryKey = 'id';

    protected $url = "https://www.sojson.com/open/api/lunar/json.shtml?date=%s";

    public function initData($month)
    {
        $days = date('t', strtotime("2018-{$month}-01"));

        for ($i = 21; $i <= $days; $i++) {
            $date = date("2018-{$month}-{$i}");
            $url  = sprintf($this->url, $date);
            $result = Curl::get($url);
            $result = json_decode($result, true);

            if (isset($result['status']) && 200 == $result['status']) {
                $detail = $result['data'];

                $data = [
                    'day'   =>  date('Ymd', strtotime($date)),
                    'suit'  => $detail['suit'],
                    'taboo' => $detail['taboo'],
                    'festival' => implode(',', $detail['festivalList']),
                    'add_time' => time()
                ];

                $this->insert($data);
            } else {
                echo "$date 执行失败\n";
                print_r($result);
            }
exit;
            sleep(8);
        }

        echo "执行完成\n";
    }
}
