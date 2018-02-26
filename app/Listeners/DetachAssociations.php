<?php

namespace App\Listeners;

use App\Events\ProductDeleting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DetachAssociations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductDeleting  $event
     * @return void
     */
    public function handle(ProductDeleting $event)
    {
      //Detach the product from all its relationships
      $this->detachProduct($event->product);
    }

    private function detachProduct($product)
    {
      //Detach from brands
      $product->brands()->detach();

      //Detach from categories
      $product->categories()->detach();

      //Detach from sub_categories
      $product->subCategories()->detach();

      //Detach from price_categories
      $product->priceCategories()->detach();

      //Detach from ages
      $product->ages()->detach();

      //Detach from sizes
      $product->sizes()->detach();
    }
}
