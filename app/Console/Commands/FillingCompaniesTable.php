<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;

class FillingCompaniesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filling:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fills in the table with companies';

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
        for ($i = 1000; $i <= 10000; $i++) {

            $company = new Company([
                'company_name' => "Test Company $i"
            ]);
            $company->save();
        }
    }
}
