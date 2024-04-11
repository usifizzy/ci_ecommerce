<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;

class Admin extends BaseController
{
    protected $productModel;
    protected $userModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->orderDetailsModel = new OrderDetailsModel();
    }
    public function index()
    {
        $data = array();
        return view('admin/dashboard', $data);
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


    public function orders()
    {
        $data = array();
        // $data['get_all_orders'] = $this->orderModel->findAll();
        $data['get_all_orders'] = $this->orderModel->select('orders.*, users.name as name, users.email as email')->join('users', 'orders.customer_id = users.id')->findAll();
        return view('admin/orders', $data);
    }


    public function order_details($id)
    {
        $data = array();
        // $data['order_no'] = $this->orderModel->where(['id' => $id])->find()->findColumn('order_no');
        $data['order'] = $this->orderModel->find($id)->order_no;
        $data['get_all_orders'] = $this->orderDetailsModel->findAll($id);
        return view('admin/order-details', $data);
    }


    public function upload()
    {
        $this->validate([
            'userfile' => [
                'uploaded[userfile]',
                'max_size[userfile,100]',
                'mime_in[userfile,image/png,image/jpg,image/gif]',
                'ext_in[userfile,png,jpg,gif]',
                'max_dims[userfile,1024,768]',
            ],
        ]);

        $file = $this->request->getFile('userfile');

        if (! $path = $file->store()) {
            return view('upload_form', ['error' => 'upload failed']);
        }
        $data = ['upload_file_path' => $path];

        var_dump($data);

        // return view('admin/dashboard', $data);
    }
}
