<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Config\Services;
use CodeIgniter\Pager\PagerRenderer;

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
    protected $pager;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->session = Services::session();
        $this->pager = Services::pager();
        $this->isUserLoggedIn = $this->session->get('isUserLoggedIn');
        $this->cartItem = $this->session->get('cart_items');
    }


    public function products($page=1)
    {
        $data = array();

        $page -= 1; 

        $paginationConfig = [
            'pageCount' => 2,
            'currentPage' => $page,
            'total' => $this->productModel->countAllResults(),
            'uri' => base_url('store'),
            'segment' => 2, // URI segment containing the page number
        ];
        $offset = $page > 0 ? $paginationConfig['pageCount'] * $page : 0;
        
        // $data['get_all_product'] = $this->products;
        $data['get_all_product'] = $this->productModel->limit($paginationConfig['pageCount'], (int)$offset)->findAll();
        $data['isUserLoggedIn'] = $this->isUserLoggedIn;
        $data['hasCart'] = isset($this->cartItem);
        // $renderer = new PagerRenderer($paginationConfig);
        // $renderer->setSurroundCount(3);
        $data['pagination'] = $this->pager->makeLinks($paginationConfig['currentPage'], $paginationConfig['pageCount'], $paginationConfig['total'], 'default_full', $paginationConfig['segment'], 'default');
        // $data['pagination'] = $this->pager->makeLinks(int $page, ?int $perPage, int $total, string $template = 'default_full', int $segment = 0, ?string $group = 'default')
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
