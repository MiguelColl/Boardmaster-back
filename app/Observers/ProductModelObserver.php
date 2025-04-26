<?php

namespace App\Observers;

use App\Models\ProductModel;
use App\Services\Elasticsearch;

class ProductModelObserver
{
    /**
     * Handle the ProductModel "created" event.
     */
    public function created(ProductModel $productModel): void
    {
        $elastic = new Elasticsearch();
        $elastic->insert($productModel);
    }

    /**
     * Handle the ProductModel "updated" event.
     */
    public function updated(ProductModel $productModel): void
    {
        if ($productModel->isDirty(['name', 'brand'])) {
            $elastic = new Elasticsearch();
            $elastic->insert($productModel);
        }
    }

    /**
     * Handle the ProductModel "deleted" event.
     */
    public function deleted(ProductModel $productModel): void
    {
        $elastic = new Elasticsearch();
        $elastic->delete($productModel);
    }

    /**
     * Handle the ProductModel "restored" event.
     */
    public function restored(ProductModel $productModel): void
    {
        //
    }

    /**
     * Handle the ProductModel "force deleted" event.
     */
    public function forceDeleted(ProductModel $productModel): void
    {
        //
    }
}
