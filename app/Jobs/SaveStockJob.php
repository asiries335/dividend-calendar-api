<?php

namespace App\Jobs;

use App\Components\Stocks\Handlers\DTO\SaveStockDto;
use App\Components\Stocks\Handlers\SaveStockHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveStockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SaveStockDto $saveStockDto;

    /**
     * @param SaveStockDto $saveStockDto
     */
    public function __construct(SaveStockDto $saveStockDto)
    {
        $this->saveStockDto = $saveStockDto;
    }

    /**
     * Execute the job.
     */
    public function handle(SaveStockHandler $saveStockHandler): void
    {
        $saveStockHandler->handle($this->saveStockDto);
    }
}
