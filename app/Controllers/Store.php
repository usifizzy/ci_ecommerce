<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Config\Services;

class Store extends BaseController
{
    // private $products = array(
    //     array(
    //         "id" => 1,
    //         "name" => "Product 1",
    //         "price" => 10.99,
    //         "category" => "Product Category",
    //         "description" => "This is the description for Product 1.",
    //         "image" => "download.jpeg"
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
    protected $session;
    protected $isUserLoggedIn;
    protected $cartItem;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->session = Services::session();
        $this->isUserLoggedIn = $this->session->get('isUserLoggedIn');
        $this->cartItem = $this->session->get('cart_items');
    }


    public function products()
    {
        $data = array();
        // $data['get_all_product'] = $this->products;
        $data['get_all_product'] = $this->productModel->findAll();
        $data['isUserLoggedIn'] = $this->isUserLoggedIn;
        $data['hasCart'] = isset($this->cartItem);
        return view('app/store', $data);
    }


    public function single($id)
    {
        $data = array();
        // $filteredProducts = array_filter($this->products, function($product) use ($id) {
        //     return $product['id'] == $id;
        // });
        // if (!empty($filteredProducts)) {
        //     $data['get_single_product'] = reset($filteredProducts); 
        // } else {
        //     $data['get_single_product'] =  null;
        // }
        $data['get_single_product'] = $this->productModel->find($id);
        $data['isUserLoggedIn'] = $this->isUserLoggedIn;
        $data['hasCart'] = isset($this->cartItem);
        return view('app/single-item', $data);
    }


}
