<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use Config\Services;
use CodeIgniter\Pager\PagerRenderer;

class Admin extends BaseController
{
    protected $productModel;
    protected $userModel;
    protected $pager;
    protected $session;
    protected $isUserLoggedIn;
    protected $role;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->orderDetailsModel = new OrderDetailsModel();
        $this->pager = Services::pager();
        $this->session = Services::session();
        $this->isUserLoggedIn = $this->session->get('isUserLoggedIn');
        $this->role = $this->session->get('userRole');
    }
    public function index()
    {
        // var_dump($this->session);
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }
        $data = array();
        $data['userName'] = $this->session->get('userName');
        $data['last_orders'] = $this->orderModel->select('orders.*, users.name as name, users.email as email')->join('users', 'orders.customer_id = users.id')->orderBy('created_at', 'desc')->limit(5)->findAll(); 
        $data['totalOrderAmount'] = $this->orderModel->selectSum('amount');
        // var_dump($this->orderModel->selectSum('amount')->find()->amount);
        $data['orderCount'] = $this->orderModel->countAllResults();
        $data['customers'] = $this->userModel->where(['role' => 'User'])->countAllResults();

        return view('admin/dashboard', $data);
    }


    public function products($page=1)
    {
        $data = array();
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }


        $page -= 1; 

        $paginationConfig = [
            'pageCount' => 10,
            'currentPage' => $page,
            'total' => $this->productModel->countAllResults(),
            'uri' => base_url('admin/products'),
            'segment' => 3,
        ];
        $offset = $page > 0 ? $paginationConfig['pageCount'] * $page : 0;

        $data['userName'] = $this->session->get('userName');
        $data['get_all_products'] = $this->productModel->limit($paginationConfig['pageCount'], (int)$offset)->findAll();
        $data['pagination'] = $this->pager->makeLinks($paginationConfig['currentPage'], $paginationConfig['pageCount'], $paginationConfig['total'], 'default_full', $paginationConfig['segment'], 'default');
        return view('admin/products', $data);
    }


    public function customers($page=1)
    {
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }
        $data = array();
        

        $page -= 1; 

        $paginationConfig = [
            'pageCount' => 10,
            'currentPage' => $page,
            'total' => $this->productModel->countAllResults(),
            'uri' => base_url('admin/customers'),
            'segment' => 3,
        ];
        $offset = $page > 0 ? $paginationConfig['pageCount'] * $page : 0;

        $data['userName'] = $this->session->get('userName');
        $data['get_all_customers'] = $this->userModel->where(['role' => 'User'])->limit($paginationConfig['pageCount'], (int)$offset)->findAll();
        $data['pagination'] = $this->pager->makeLinks($paginationConfig['currentPage'], $paginationConfig['pageCount'], $paginationConfig['total'], 'default_full', $paginationConfig['segment'], 'default');
        return view('admin/customers', $data);
    }


    public function orders($page=1)
    {
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }
        $data = array();


        $page -= 1; 

        $paginationConfig = [
            'pageCount' => 10,
            'currentPage' => $page,
            'total' => $this->productModel->countAllResults(),
            'uri' => base_url('admin/orders'),
            'segment' => 3,
        ];
        $offset = $page > 0 ? $paginationConfig['pageCount'] * $page : 0;

        $data['userName'] = $this->session->get('userName');
        // $data['get_all_orders'] = $this->orderModel->findAll();
        $data['get_all_orders'] = $this->orderModel->select('orders.*, users.name as name, users.email as email')->join('users', 'orders.customer_id = users.id')->limit($paginationConfig['pageCount'], (int)$offset)->findAll();
        $data['pagination'] = $this->pager->makeLinks($paginationConfig['currentPage'], $paginationConfig['pageCount'], $paginationConfig['total'], 'default_full', $paginationConfig['segment'], 'default');
        return view('admin/orders', $data);
    }


    public function order_details($id)
    {
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }
        $data = array();
        // $data['order_no'] = $this->orderModel->where(['id' => $id])->find()->findColumn('order_no');
        $data['order'] = $this->orderModel->find($id)->order_no;
        $data['get_all_orders'] = $this->orderDetailsModel->findAll($id);
        $data['userName'] = $this->session->get('userName');
        return view('admin/order-details', $data);
    }

    public function new_product()
    {
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }
        $data = array();
        return view('admin/new-product', $data);
    }

    public function upload()
    {
        if (!$this->isUserLoggedIn || $this->role != 'Admin') {
            return redirect('store');
        }
        $post_data = $this->request->getPost(['name', 'price', 'category', 'description']);

        var_dump($post_data);
        var_dump($this->validateData($post_data, [
            'description' => 'required|max_length[5000]|min_length[4]',
            'category' => 'required|max_length[256]|min_length[8]',
            'price' => 'required|numeric|decimal|greater_than[0]',
            'name' => 'required|max_length[32]|min_length[8]',
        ]));
        // var_dump($this->validateData->getErrors());
        if ($this->validateData($post_data, [
            'description' => 'required|max_length[5000]|min_length[4]',
            'category' => 'required|max_length[256]|min_length[8]',
            'price' => 'required|numeric|decimal|greater_than[0]',
            'name' => 'required|max_length[32]|min_length[8]',
        ])){
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
            // $file = $post_data['userfile'];
            // var_dump($file);

    
            if (! $path = $file->store()) {
                return view('upload_form', ['error' => 'upload failed']);
            }
            $imageData = ['upload_file_path' => $path];
    
            // var_dump($imageData);
    
            $newProduct = $this->productModel->save(
                [
                    'name' => $post_data['name'], 
                    'price' => $post_data['price'], 
                    'category' => $post_data['category'], 
                    'description' => $post_data['description'], 
                    'image' => $imageData
                ]
            );
            if ($newProduct) {
                return redirect('admin/products');
            } else {
                return view('admin/new-product', $data);
            }
            

        }else {
            return view('admin/new-product', $data);
//
            // var_dump($this->validateData->getErrors());
        }

    }


    public function xupload()
    {
        // $this->validate([
        //     'userfile' => [
        //         'uploaded[userfile]',
        //         'max_size[userfile,100]',
        //         'mime_in[userfile,image/png,image/jpg,image/gif]',
        //         'ext_in[userfile,png,jpg,gif]',
        //         'max_dims[userfile,1024,768]',
        //     ],
        // ]);


        $post_data = $this->request->getPost(['name', 'price', 'category', 'description', 'userfile']);

        if ($this->validateData($post_data, [
            'description' => 'required|max_length[515]|min_length[4]',
            'category' => 'required|max_length[5000]|min_length[8]',
            'price' => 'required|max_length[16]|min_length[8]',
            'name' => 'required|max_length[32]|min_length[8]',
            'userfile' => [
                'uploaded[userfile]',
                'max_size[userfile,100]',
                'mime_in[userfile,image/png,image/jpg,image/gif]',
                'ext_in[userfile,png,jpg,gif]',
                'max_dims[userfile,1024,768]',
            ]
        ]))

        // $file = $this->request->getFile('userfile');
        $file = $post_data['userfile'];

        if (! $path = $file->store()) {
            return view('upload_form', ['error' => 'upload failed']);
        }
        $imageData = ['upload_file_path' => $path];

        // var_dump($data);

        $newProduct = $this->productModel->save(
            [
                'name' => $post_data['name'], 
                'price' => $post_data['name'], 
                'category' => $post_data['name'], 
                'description' => $post_data['name'], 
                'image' => $imageData
            ]
        );
        if ($newProduct) {
            return redirect('admin/products');
        } else {
            return view('admin/new-product', $data);
        }

    }
}
