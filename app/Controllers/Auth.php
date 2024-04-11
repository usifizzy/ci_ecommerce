<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use Config\Services;

class Auth extends BaseController
{

    protected $userModel;
    protected $session;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->session = Services::session();
    }

    public function index()
    {
        return view('auth/login');
    }

       
    public function login(){
        $data = array();
        if($this->session->get('success_msg') != null){
            $data['success_msg'] = $this->session->get('success_msg');
            $this->session->unset('success_msg');
        }
        if($this->session->get('error_msg') != null){
            $data['error_msg'] = $this->session->get('error_msg');
            $this->session->unset('error_msg');
        }
        $post_data = $this->request->getPost(['email', 'password']);
        // echo 'pre login check';
        // var_dump($post_data);

        if ($this->validateData($post_data, [
            'email' => 'required|max_length[255]|min_length[4]|valid_email',
            'password'  => 'required|max_length[5000]|min_length[8]',
        ])) {
            
            $user = new User();
            $user->email = $post_data['email'];
            $user->setPassword($post_data['password']);

            // var_dump($user);

            $checkLogin = $this->userModel->where(['email' => $post_data['email']])->first();
            if($checkLogin){
                if (password_verify($post_data['password'], $checkLogin->password)) {
                    $cartItems = $this->session->get('cart_items');
                    // echo 'Password is correct';
                    // echo $checkLogin->role;
                    $this->session->set('isUserLoggedIn',TRUE);
                    $this->session->set('userId',$checkLogin->id);
                    $this->session->set('userRole',$checkLogin->role);
                    return $checkLogin->role == 'Admin' ? redirect('admin') : (isset($cartItems) ? redirect('cart') : redirect('store'));
                    // if ($checkLogin->role == 'Admin') {
                    //     redirect('admin');
                    // } else {
                    //     if (isset($cartItems[$productId])) {
                    //         redirect('cart');
                    //     } else {
                    //         redirect('store');
                    //     }
                    // }
                    
                }else {
                    $data['error_msg'] = 'Password is incorrect';
                }
            }else{
                $data['error_msg'] = 'Wrong email or password, please try again.';
                return view('auth/login', $data);
            }
        }else{
            $data['error_msg'] = 'Wrong email or password, please try again.';
            return view('auth/login', $data);
        }
    }
    

    
    public function logout(){
        $checkLogin = $this->session->get('userRole');
        $this->session->remove('isUserLoggedIn');
        $this->session->remove('userId');
        $this->session->regenerate();
        return $checkLogin == 'Admin' ? redirect('auth/login') : redirect('store');
    }
    
}
