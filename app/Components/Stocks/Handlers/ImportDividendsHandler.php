<?php

namespace App\Components\Stocks\Handlers;

use App\Components\Dividends\Handlers\SaveDividendHandler;
use App\GetDividends\DTO\GetDividendsDto;
use App\GetDividends\GetDividendsHandlerInterface;
use App\Jobs\ImportStockDividendsJob;
use App\Models\Stock;
use App\Repositories\Eloquent\StockEloquentRepository;
use Carbon\Carbon;
use Illuminate\Bus\Dispatcher;

class ImportDividendsHandler
{
    private StockEloquentRepository $stockEloquentRepository;
    private Dispatcher $dispatcher;
    private GetDividendsHandlerInterface $getDividendsHandler;
    private SaveDividendHandler $saveDividendHandler;

    /**
     * @param StockEloquentRepository $stockEloquentRepository
     * @param Dispatcher $dispatcher
     * @param GetDividendsHandlerInterface $getDividendsHandler
     * @param SaveDividendHandler $saveDividendHandler
     */
    public function __construct(
        StockEloquentRepository      $stockEloquentRepository,
        Dispatcher                   $dispatcher,
        GetDividendsHandlerInterface $getDividendsHandler,
        SaveDividendHandler          $saveDividendHandler
    )
    {
        $this->stockEloquentRepository = $stockEloquentRepository;
        $this->dispatcher = $dispatcher;
        $this->getDividendsHandler = $getDividendsHandler;
        $this->saveDividendHandler = $saveDividendHandler;
    }

    /**
     * Асинхронный импорт дивидендов по всем акциям
     *
     * @return bool
     */
    public function asyncHandleByAll(): bool
    {
        /** @var Stock $stock */
        foreach ($this->stockEloquentRepository->getAllCursor() as $stock) {
            $this->dispatcher->dispatch(new ImportStockDividendsJob($stock));
        }


        return true;
    }

    /**
     * Импорт дивидендов по аккции
     *
     * @param Stock $stock
     * @return bool
     */
    public function handleByStock(Stock $stock): bool
    {
        // TODO: Передавать даты через аргументы имутабле
        $dto = new GetDividendsDto(
            $stock->figi,
            Carbon::now(),
            Carbon::now()->addMonths(2)
        );

        // Получаем дивиденды
        if (!$dividends = $this->getDividendsHandler->handle($dto)) {
            // нет дивидендов
            return true;
        }

        foreach ($dividends as $dividend) {
            $this->saveDividendHandler->handle(
                $stock->id,
                $dividend
            );
        }

        return true;
    }
}
