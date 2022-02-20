<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;

class FillingCustomersTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filling:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fills in the table with customers';

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
     * @return int
     */
    public function handle()
    {
        for ($i = 1; $i <= 10000; $i++) {

            $randCompanyId = rand(1, 10000);

            $customer = new Customer([
                'company_id' => $randCompanyId,
                'name' => "Customer $i"
            ]);

            $customer->save();
        }
    }
}
