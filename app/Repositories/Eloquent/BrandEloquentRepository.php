<?php

namespace App\Repositories\Eloquent;

use App\Models\Brand;

class BrandEloquentRepository
{
    /**
     * @param string $company
     * @return Brand|null
     */
    public function findByCompany(string $company): ?Brand
    {
        return Brand::query()->where('company', $company)->first();
    }

    /**
     * @param Brand $brand
     * @return bool
     */
    public function store(Brand $brand): bool
    {
        return $brand->save();
    }
}
