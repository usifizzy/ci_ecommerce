<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $productModel;
    protected $userModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        return view('admin/dashboard');
    }


    public function products()
    {
        $data = array();
        $data['get_all_products'] = $this->productModel->findAll();
        return view('admin/products', $data);
    }


    public function customers()
    {
        $data = array();
        $data['get_all_customers'] = $this->userModel->where(['role' => 'User'])->findAll();
        return view('admin/customers', $data);
    }
}
