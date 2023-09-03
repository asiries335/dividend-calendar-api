<?php

namespace App\Components\Stocks\Handlers;

use App\Components\Stocks\Handlers\DTO\SaveStockDto;
use App\Models\Stock;
use App\Repositories\Eloquent\StockEloquentRepository;
use Psr\Log\LoggerInterface;

/**
 * Обработчик сохранения акции
 */
class SaveStockHandler
{
    private LoggerInterface $logger;
    private StockEloquentRepository $repository;

    public function __construct(LoggerInterface $logger, StockEloquentRepository $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    /**
     * @param SaveStockDto $dto
     * @return bool
     */
    public function handle(SaveStockDto $dto): bool
    {
        if($this->repository->findByFigi($dto->figi)) {
            // Акция существует - пропускаем
            return true;
        }

        $stock = new Stock();

        $stock->figi = $dto->figi;
        $stock->ticker = $dto->ticker;
        $stock->class_code = $dto->classCode;
        $stock->isin = $dto->isin;
        $stock->currency = $dto->currency;
        $stock->name = $dto->name;
        $stock->exchange = $dto->exchange;
        $stock->sector = $dto->sector;
        $stock->country = $dto->country;
        $stock->ipo_date = $dto->ipoDate;
        $stock->provider = $dto->providerEnum->value;

        $this->repository->store($stock);

        $this->logger->info('Save Stock', [
            'stock_id' => $stock->id,
            'figi' => $stock->figi
        ]);

        return true;
    }
}
