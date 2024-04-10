<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\UsertModel;

class Admin extends BaseController
{
    protected $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        //
    }


    public function products()
    {
        $data = array();
        $data['get_all_products'] = $this->productModel->findAll();
        return view('admin/products', $data);
    }
}
