<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\OrderModel;

class OrderController extends BaseController
{
    public function index()
    {
        //
        $orderModel = new OrderModel();

        $data['order_data'] =  $orderModel->orderBy('id', 'DESC')->paginate(10);
        $data['pagination_link'] = $orderModel->pager;
        return view('orders/index', $data);
    }

    public function create()
    {
        return view('orders/create');
    }

    public function store()
    {
        helper(['form', 'url']);
        $rules = $this->validate([
            'title'    =>    'required',
            'description'    =>    'required',
        ]);

        if ($rules) {
            $orderModel = new OrderModel();

            try {
                $orderModel->save([
                    'title'    =>    $this->request->getVar('title'),
                    'description'    =>    $this->request->getVar('description')
                ]);
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'Item Data Added');

            return $this->response->redirect(site_url('/orders'));
        } else {
            echo view('orders/create', [
                'error'     => $this->validator
            ]);
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
