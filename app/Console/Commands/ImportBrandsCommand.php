<?php

namespace App\Console\Commands;

use App\Imports\Brands\ImportBrandsProviderInterface;
use Illuminate\Console\Command;

class ImportBrandsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-brands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ImportBrandsProviderInterface $importBrandsProvider): void
    {
        $importBrandsProvider->asyncHandle();
    }
}
