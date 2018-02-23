<?php
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Support\Facades\DB;

    function present_price($price){
        return "Tshs. " . number_format($price) . "/=";
    }

    function get_valid_cats(){
        return App\Category::with('subcategories', 'products')
            ->get()
            ->filter(function($c){
                return $c->deleted_at == null && count($c->products);
            });
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