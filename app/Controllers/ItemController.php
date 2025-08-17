<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        //
        $userModel = new UserModel();

        $data['user_data'] =  $userModel->orderBy('id', 'DESC')->paginate(10);
        $data['pagination_link'] = $userModel->pager;
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        helper(['form', 'url']);
        $rules = $this->validate([
            'name'    =>    'required',
            'email'    =>    'required|valid_email',
            'password' => 'required|min_length[6]'
        ]);

        if ($rules) {
            $userModel = new UserModel();

            try {
                $userModel->save([
                    'name'    =>    $this->request->getVar('name'),
                    'email'    =>    $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                ]);
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'User Data Added');

            return $this->response->redirect(site_url('/users'));
        } else {
            echo view('users/create', [
                'error'     => $this->validator
            ]);
        }
    }

    public function show($id)
    {
        $userModel = new UserModel();
        $data['user'] =  $userModel->where('id', $id)->first();
        return view('users/show', $data);
    }
    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] =  $userModel->where('id', $id)->first();
        return view('users/edit', $data);
    }

    public function update()
    {
        helper(['form', 'url']);
        $rules = $this->validate([
            'name'    =>    'required',
            'email'    =>    'required|valid_email',
        ]);
        $userModel = new UserModel();
        $id = $this->request->getVar('id');

        if ($rules) {
            $userModel = new UserModel();

            try {
                $data = [
                    'name' => $this->request->getVar('name'),
                    'email'  => $this->request->getVar('email'),
                ];
                $userModel->update($id, $data);
            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'User Data Updated');

            return $this->response->redirect(site_url('/users'));
        } else {
            $data['user'] = $userModel->where('id', $id)->first();
            $data['error'] = $this->validator;
            echo view('edit_data', $data);
        }
    }

    public function delete($id)
    {
        //
        $userModel = new UserModel();

        $userModel->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'User Data Deleted');

        return $this->response->redirect(site_url('/users'));
    }
}
