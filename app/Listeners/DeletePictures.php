<?php

namespace App\Listeners;

use App\Events\ProductDeleting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Product;

class DeletePictures
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
        $product = $event->product;

        //Delete the pictures from file system
        $this->deleteProductPictures($product);

        //Delete the database references
        $product->pictures()->forceDelete();
    }

    private function deleteProductPictures($product)
    {
      $base_path = public_path(Product::getImagesLocation());
      $product->pictures()
              ->get()->map(function($picture)
                use ($base_path){
                unlink($base_path . $picture->image_url);
              });
    }
}
