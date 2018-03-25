<?php

namespace App\Model\SmallProgram;

use App\Libs\Curl;
use Illuminate\Database\Eloquent\Model;

class Model_CookBook extends Model
{
    //
    protected $table = 'sp_cook_cate';

    public function initCate()
    {
        $this->table = 'sp_cook_cate';

        $url = "https://way.jd.com/jisuapi/recipe_class?appkey=8bf48032641cae27a7006930b3fea72b";

        $res = Curl::get($url);
        $res = json_decode($res, true);

        $time = time();
        if (10000 == $res['code']) {
            $data = $res['result']['result'];

            foreach ($data as $item) {
                $insert = [];
                $info = [
                    'id'        => $item['classid'],
                    'name'      => $item['name'],
                    'parent_id' => $item['parentid'],
                    'add_time'  => $time
                ];
                $insert[] = $info;

                if (is_array($item['list'])) {
                    foreach ($item['list'] as $subItem) {
                        $info = [
                            'id'        => $subItem['classid'],
                            'name'      => $subItem['name'],
                            'parent_id' => $subItem['parentid'],
                            'add_time'  => $time
                        ];
                        $insert[] = $info;
                    }
                }

                $this->insert($insert);
            }
        } else {
            var_dump($res['msg']);
        }

        echo "完成";

    }
}
