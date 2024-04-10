<?php

namespace App\Controllers;

use App\Libraries\Cart;
use App\Models\ProductModel;

class StoreCart extends BaseController
{
    protected $cart;


    // private $products = array(
    //     array(
    //         "id" => 1,
    //         "name" => "Product 1",
    //         "price" => 10.99,
    //         "category" => "Product Category",
    //         "description" => "This is the description for Product 1.",
    //         "image" => "product1.jpg"
    //     ),
    //     array(
    //         "id" => 2,
    //         "name" => "Product 2",
    //         "price" => 15.49,
    //         "category" => "Product Category",
    //         "description" => "This is the description for Product 2.",
    //         "image" => "product2.jpg"
    //     ),
    //     array(
    //         "id" => 3,
    //         "name" => "Product 3",
    //         "price" => 22.99,
    //         "category" => "Product Category",
    //         "description" => "This is the description for Product 3.",
    //         "image" => "product3.jpg"
    //     ),
    //     // Add more products as needed
    // );

    protected $productModel;

    public function __construct()
    {
        // Load the Cart library using dependency injection
        $this->cart = new Cart();
        $this->productModel = new ProductModel();
    }



    public function index()
    {
        $data = array();
        $data['cart_contents'] = $this->cart->getItems();
        return view('app/cart', $data);
    }



    public function add_item()
    {

        $post_data = $this->request->getPost(['product_id', 'quantity']);
        $data       = array();
        $product_id = $post_data['product_id'];
        $quantity     = $post_data['quantity'];
        // $results    = $this->singleProduct($product_id);
        $results = $this->productModel->find($id); 
        

        $name    = $results['name'];
        $price   = $results['price'];
        // $data['options'] = array('product_image' => $results['image']);
        $options = $results['image'];

        $this->cart->addItem($product_id, $quantity, $name, $price, $options );
        return redirect()->to('cart');
    }

    public function update_item()
    {
        helper('form');
        $product_id = $post_data['product_id'];
        $quantity     = $post_data['quantity'];

        $this->cart->updateItem($productId, $quantity);
        redirect('cart');
    }

    public function remove_item()
    {
        helper('form');

        $product_id = $post_data['product_id'];
        $this->cart->removeItem($productId);
        redirect('cart');
    }

    public function empty_cart()
    {
        $this->$cart->clear();
        redirect('cart');
    }


    // private function singleProduct($id) {
        
    //     $filteredProducts = array_filter($this->products, function($product) use ($id) {
    //         return $product['id'] == $id;
    //     });
    //     if (!empty($filteredProducts)) {
    //         // Product found
            
    //         return reset($filteredProducts); 
    //     } else {
    //         // Product not found

    //         return null;
    //     }
    // }

}
