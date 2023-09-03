<?php

namespace App\Components\Brands\Handlers;

use App\Components\Brands\Handlers\DTO\SaveBrandDto;
use App\Models\Brand;
use App\Repositories\Eloquent\BrandEloquentRepository;
use Psr\Log\LoggerInterface;

class SaveBrandHandler
{
    private LoggerInterface $logger;
    private BrandEloquentRepository $repository;

    /**
     * @param LoggerInterface $logger
     * @param BrandEloquentRepository $repository
     */
    public function __construct(LoggerInterface $logger, BrandEloquentRepository $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    /**
     * @param SaveBrandDto $dto
     * @return bool
     */
    public function handle(SaveBrandDto $dto): bool
    {
        if ($this->repository->findByCompany($dto->company)) {
            // Данная компания уже существует
            return true;
        }

        $brand = new Brand();

        $brand->name = $dto->name;
        $brand->description = $dto->description;
        $brand->info = $dto->info;
        $brand->company = $dto->company;
        $brand->sector = $dto->sector;
        $brand->country = $dto->country;
        $brand->website = $dto->website;
        $brand->figi = $dto->figi;
        $brand->provider = $dto->providerEnum->value;

        $this->repository->store($brand);

        $this->logger->info('save brand', [
            'brand_id' => $brand->id,
            'company' => $brand->company
        ]);

        return true;
    }
}
