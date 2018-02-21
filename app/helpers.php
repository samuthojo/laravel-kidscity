<?php
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Support\Facades\DB;

    function present_price($price){
        return "Tshs. " . number_format($price) . "/=";
    }

    function get_valid_cats(){
        $cats = DB::table('categories')
            ->leftJoin('product_categories', 'categories.id', '=', 'product_categories.category_id')
            ->leftJoin('products', 'products.id', '=', 'product_categories.product_id')
            ->select(DB::raw('categories.*, count(products.id) as product_count'))
            ->groupBy('categories.id')
            ->orderBy('categories.id', 'asc')
            ->get()
            ->filter(function($cat){
                return $cat->product_count > 0;
            })
            ->pluck('id');

        return App\Category::with('subCategories')->whereIn('id', $cats)->get();
    }

    function in_cart($id){
        return Cart::search(function ($cartItem) use ($id) {
            return $cartItem->model->id === $id;
        })->first() != null;
    }

    function format_cart($cart_items){
        $items = [];
        foreach($cart_items as $item){
            $cart_item = new \stdClass();
            $cart_item->name = $item->model->name;
            $cart_item->image = $item->model->image();

            $cart_item->price = $item->model->present_price();
            $cart_item->qty = $item->qty;
            $cart_item->id = $item->rowId;

            $items[] = $cart_item;
        }

        $obj = new \stdClass();
        $obj->items = $items;

        return json_encode($obj);
    }


    function format_products($products){
        $data = new stdClass();
        $formated_products = $products->map(function($p){
            $product = $p;
            $product->in_cart = in_cart($p->id);
            $product->image = $p->image();
            $product->price_str = $p->present_price();
            $product->url = url('products/' . $product->id);
            $product->time = strtotime($p->created_at);
            $product->day = date('d, m', strtotime($p->created_at));

            return $product;
        });

        $data->products = $formated_products;
        return json_encode($data);
    }