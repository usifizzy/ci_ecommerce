<?php

namespace App\Controllers;

class Store extends BaseController
{
    private $products = array(
        array(
            "id" => 1,
            "name" => "Product 1",
            "price" => 10.99,
            "category" => "Product Category",
            "description" => "This is the description for Product 1.",
            "image" => "download.jpeg"
        ),
        array(
            "id" => 2,
            "name" => "Product 2",
            "price" => 15.49,
            "category" => "Product Category",
            "description" => "This is the description for Product 2.",
            "image" => "product2.jpg"
        ),
        array(
            "id" => 3,
            "name" => "Product 3",
            "price" => 22.99,
            "category" => "Product Category",
            "description" => "This is the description for Product 3.",
            "image" => "product3.jpg"
        ),
        // Add more products as needed
    );


    public function products()
    {
        $data = array();
        $data['get_all_product'] = $this->products;
        return view('app/store', $data);
    }
    

    public function single($id)
    {
        $data = array();
        $filteredProducts = array_filter($this->products, function($product) use ($id) {
            return $product['id'] == $id;
        });
        if (!empty($filteredProducts)) {
            $data['get_single_product'] = reset($filteredProducts); 
        } else {
            $data['get_single_product'] =  null;
        }
        return view('app/single-item', $data);
    }


}
