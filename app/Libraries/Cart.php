<?php

namespace App\Libraries;

class Cart
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function addItem($productId, $quantity = 1, $name, $price, $image)
    {
        $cartItems = $this->session->get('cart_items') ?? [];

        // Add the item to the cart
        // $cartItems[$productId] = isset($cartItems[$productId]) ? $cartItems[$productId] + $quantity : $quantity;
        if (isset($cartItems[$productId])) {
            // If the product already exists in the cart, update the quantity
            $cartItems[$productId]['quantity'] += $quantity;
        } else {
            // If the product is not in the cart, add it
            $cartItems[$productId] = [
                'product_id' => $productId,
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
                'image' => $image
            ];
        }

        // Update the cart items in session
        $this->session->set('cart_items', $cartItems);
    }

    public function removeItem($productId)
    {
        $cartItems = $this->session->get('cart_items') ?? [];

        // Remove the item from the cart
        unset($cartItems[$productId]);

        // Update the cart items in session
        $this->session->set('cart_items', $cartItems);
    }

    public function updateItem($productId, $quantity)
    {
        $cartItems = $this->session->get('cart_items') ?? [];

        // Update the quantity of the item in the cart
        if (isset($cartItems[$productId])) {
            $cartItems[$productId]['quantity'] += $quantity;
        }

        // Update the cart items in session
        $this->session->set('cart_items', $cartItems);
    }

    public function getItems()
    {
        return $this->session->get('cart_items') ?? [];
    }

    public function clear()
    {
        $this->session->remove('cart_items');
    }
    
	public function format_number($n = '')
	{
		return ($n === '') ? '' : number_format( (float) $n, 2, '.', ',');
	}
}
