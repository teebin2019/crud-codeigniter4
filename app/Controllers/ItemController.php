<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ItemModel;

class ItemController extends BaseController
{
    public function index()
    {
        //
        $itemModel = new ItemModel();

        $data['item_data'] =  $itemModel->orderBy('id', 'DESC')->paginate(10);
        $data['pagination_link'] = $itemModel->pager;
        return view('items/index', $data);
    }

    public function create()
    {
        return view('items/create');
    }

    public function store()
    {
        helper(['form', 'url']);
        $rules = $this->validate([
            'title'    =>    'required',
            'description'    =>    'required',
        ]);

        if ($rules) {
            $itemModel = new ItemModel();

            try {
                $itemModel->save([
                    'title'    =>    $this->request->getVar('title'),
                    'description'    =>    $this->request->getVar('description')
                ]);
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'Item Data Added');

            return $this->response->redirect(site_url('/items'));
        } else {
            echo view('items/create', [
                'error'     => $this->validator
            ]);
        }
    }

    public function show($id)
    {
        $itemModel = new ItemModel();
        $data['item'] =  $itemModel->where('id', $id)->first();
        return view('items/show', $data);
    }
    public function edit($id)
    {
        $itemModel = new ItemModel();
        $data['item'] =  $itemModel->where('id', $id)->first();
        return view('items/edit', $data);
    }

    public function update()
    {
        helper(['form', 'url']);
        $rules = $this->validate([
            'title'    =>    'required',
            'description'    =>    'required',
        ]);
        $itemModel = new ItemModel();
        $id = $this->request->getVar('id');

        if ($rules) {
            $itemModel = new ItemModel();

            try {
                $data = [
                    'title'    =>    $this->request->getVar('title'),
                    'description'    =>    $this->request->getVar('description')
                ];
                $itemModel->update($id, $data);
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'Item Data Updated');

            return $this->response->redirect(site_url('/items'));
        } else {
            $data['item'] = $itemModel->where('id', $id)->first();
            $data['error'] = $this->validator;
            echo view('items/edit', $data);
        }
    }

    public function delete($id)
    {
        //
        $itemModel = new ItemModel();

        $itemModel->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Item Data Deleted');

        return $this->response->redirect(site_url('/items'));
    }
}
