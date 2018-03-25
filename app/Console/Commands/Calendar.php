<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\SmallProgram\Model_Calendar;

class Calendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get day info';

    protected $model = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->model = new Model_Calendar();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        for ($i = 6; $i <= 12; $i++) {
            $this->model->initData($i);

            usleep(20000);
        }

        echo "执行完成";
    }
}
