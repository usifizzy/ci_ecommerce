<?php

namespace App\Controllers;

use App\Libraries\Cart;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use Config\Services;

class StoreCart extends BaseController
{
    protected $cart;
    protected $session;


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
    protected $orderModel;
    protected $orderDetailsModel;
    protected $userModel;

    public function __construct()
    {
        // Load the Cart library using dependency injection
        $this->cart = new Cart();
        $this->productModel = new ProductModel();
            
        $this->orderModel = new OrderModel();
        $this->orderDetailsModel = new OrderDetailsModel();
        $this->userModel = new UserModel();
        $this->session = Services::session();
    }



    public function index()
    {
        $data = array();
        $data['cart_contents'] = $this->cart->getItems();
        $data['isUserLoggedIn'] = $this->session->get('isUserLoggedIn');
        return view('app/cart', $data);
    }



    public function add_item()
    {

        $post_data = $this->request->getPost(['product_id', 'quantity']);
        $data       = array();
        $product_id = $post_data['product_id'];
        $quantity     = $post_data['quantity'];
        // $results    = $this->singleProduct($product_id);
        $results = $this->productModel->find($product_id); 
        

        $name    = $results->name;
        $price   = $results->price;
        // $data['options'] = array('product_image' => $results['image']);
        $options = $results->image;

        $this->cart->addItem($product_id, $quantity, $name, $price, $options );
        return redirect()->to('cart');
    }

    public function update_item()
    {
        helper('form');
        $product_id = $post_data['product_id'];
        $quantity     = $post_data['quantity'];

        $this->cart->updateItem($productId, $quantity);
        return redirect('cart');
    }

    public function remove_item($productId)
    {
        $this->cart->removeItem($productId);
        return redirect('cart');
    }

    public function empty_cart()
    {
        $this->$cart->clear();
        return redirect('cart');
    }


    public function checkout()
    {
        $cartItems = $this->session->get('cart_items') ?? [];
        if (count($cartItems) <= 0) {
            $this->session->remove('cart_items');
            return redirect('store');
        }
        $data = array();
        $data['message'] = ' ';
        $data['status'] = false;
        $data['cart_contents'] = $this->cart->getItems();
        $data['isUserLoggedIn'] = $this->session->get('isUserLoggedIn');
        $data['userDetails'] = $this->userModel->find($this->session->get('userId'));
        return view('app/checkout', $data);
    }


    public function place_order()
    {

        $data = array();
        $data['status'] = false;
        $cart_contents = $this->cart->getItems();

        $totalAmount = 0;

        try {
            foreach ($cart_contents as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }
    
            $orderId = $this->orderModel->save(['order_no' => random_string('alnum', 10), 'amount' => $totalAmount]);
            foreach ($cart_contents as $cart_items){
                $this->orderDetailsModel->save([
                    'order_id' => $orderId, 
                    'product_name' => $cart_items['name'], 
                    'price' => $cart_items['price'], 
                    'quantity' => $cart_items['quantity'], 
                    'amount' => $cart_items['price'] * $cart_items['quantity'], 
                    'product_id' => $cart_items['product_id']
                ]);
            }
            $data['message'] = 'Order created successfully. Thank you';
            $data['status'] = true;
            $this->session->remove('cart_items');
        } catch (\Throwable $th) {
            //throw $th;
            $data['message'] = 'Unable to place order. Please try later';
        }
        $data['cart_contents'] = $cart_contents;
        $data['isUserLoggedIn'] = $this->session->get('isUserLoggedIn');
        $data['userDetails'] = $this->userModel->find($this->session->get('userId'));
        return view('app/checkout', $data);

        // return redirect ('store');
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
