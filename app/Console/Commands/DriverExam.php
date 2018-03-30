<?php

namespace App\Console\Commands;

use App\Model\SmallProgram\Model_DriverExam;
use Illuminate\Console\Command;

class DriverExam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver_exam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $type = ['A1', 'A3', 'B1', 'A2', 'B2', 'C1', 'C2', 'C3', 'D', 'E', 'F'];
        $level = [1, 4];

        (new Model_DriverExam())->dataSpider(4, 'C1');
    }
}
