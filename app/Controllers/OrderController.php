<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\ItemModel;

class OrderController extends BaseController
{
    public function index()
    {
        //
        $orderModel = new OrderModel();

        $data['order_data'] =  $orderModel->orderBy('id_user', 'DESC')->paginate(10);
        $data['pagination_link'] = $orderModel->pager;
        return view('orders/index', $data);
    }

    public function create()
    {
        $userModel = new UserModel();
        $itemModel = new ItemModel();
        $data['user_data'] =  $userModel->orderBy('id', 'ASC')->findAll();
        $data['item_data'] =  $itemModel->orderBy('id', 'ASC')->findAll();
        return view('orders/create', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $rules = $this->validate([
            'id_user'    =>    'required',
        ]);

        if ($rules) {
            $orderModel = new OrderModel();

            try {

                $items = $this->request->getVar('items');


                foreach ($items as $item) {
                    $orderModel->insert([
                        'id_user'    =>    $this->request->getVar('id_user'),
                        'id_item'    =>    $item
                    ]);
                }
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'Item Data Added');

            return $this->response->redirect(site_url('/orders'));
        } else {
            $userModel = new UserModel();
            $itemModel = new ItemModel();
            $data['error'] =   $this->validator;
            $data['user_data'] =  $userModel->orderBy('id', 'ASC')->findAll();
            $data['item_data'] =  $itemModel->orderBy('id', 'ASC')->findAll();
            echo view('orders/create', $data);
        }
    }

    public function show($id)
    {
        $orderModel = new OrderModel();
        $data['item'] =  $orderModel->where('id', $id)->first();
        return view('orders/show', $data);
    }
    public function edit($id)
    {
        $orderModel = new OrderModel();
        $data['item'] =  $orderModel->where('id', $id)->first();
        return view('orders/edit', $data);
    }

    public function update()
    {
        helper(['form', 'url']);
        $rules = $this->validate([
            'title'    =>    'required',
            'description'    =>    'required',
        ]);
        $orderModel = new OrderModel();
        $id = $this->request->getVar('id');

        if ($rules) {
            $orderModel = new OrderModel();

            try {
                $data = [
                    'title'    =>    $this->request->getVar('title'),
                    'description'    =>    $this->request->getVar('description')
                ];
                $orderModel->update($id, $data);
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'Item Data Updated');

            return $this->response->redirect(site_url('/orders'));
        } else {
            $data['item'] = $orderModel->where('id', $id)->first();
            $data['error'] = $this->validator;
            echo view('orders/edit', $data);
        }
    }

    public function delete($id)
    {
        //
        $orderModel = new OrderModel();

        $orderModel->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Item Data Deleted');

        return $this->response->redirect(site_url('/orders'));
    }
}
