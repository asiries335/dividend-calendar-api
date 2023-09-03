<?php

namespace App\Console\Commands;

use App\Imports\Stocks\ImportStocksProviderInterface;
use Illuminate\Console\Command;

class ImportStocksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ImportStocksProviderInterface $importStocksProvider): void
    {
        $importStocksProvider->asyncHandle();
    }
}
