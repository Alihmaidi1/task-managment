<?php

namespace App\Console\Commands;

use App\Services\repo\interfaces\adminInterface;
use Illuminate\Console\Command;

class dayilyReport extends Command
{

    public $admin;
    // public function __construct(adminInterface $admin){

    //     $this->admin=$admin;

    // }

    protected $signature = 'report:dayily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will report to admin dayily report on the system';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // $product

        $admins=$this->admin->getAllAdmin();

        foreach($admins as $admin){




        }



    }
}