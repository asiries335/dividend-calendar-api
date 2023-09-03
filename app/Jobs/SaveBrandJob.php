<?php

namespace App\Jobs;

use App\Components\Brands\Handlers\DTO\SaveBrandDto;
use App\Components\Brands\Handlers\SaveBrandHandler;
use App\Components\Stocks\Handlers\DTO\SaveStockDto;
use App\Components\Stocks\Handlers\SaveStockHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveBrandJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private SaveBrandDto $dto;

    /**
     * @param SaveBrandDto $dto
     */
    public function __construct(SaveBrandDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Execute the job.
     */
    public function handle(SaveBrandHandler $handler): void
    {
        $handler->handle($this->dto);
    }
}
