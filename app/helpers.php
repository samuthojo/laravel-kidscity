<?php
    use Gloudemans\Shoppingcart\Facades\Cart;

    function present_price($price){
        return "Tshs. " . number_format($price) . "/=";
    }

    function in_cart($id){
        return Cart::search(function ($cartItem) use ($id) {
            return $cartItem->model->id === $id;
        })->first() != null;
    }