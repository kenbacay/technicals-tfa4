<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $users = $userModel->findAll();

        return view('users/index', [
            'users' => $users
        ]);
    }

    public function newForm(): string
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[3]|max_length[100]'
        ];

        if (! $this->validate($rules)) {
            return view('users/new', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (! $user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'User not found'
            );
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]',
            'full_name' => 'required|min_length[3]|max_length[100]'
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $rules['avatar'] =
                'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]';
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $username = $this->request->getPost('username');

        $existingUser = $userModel
            ->where('username', $username)
            ->where('id !=', $id)
            ->first();

        if ($existingUser) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'username' => 'This username already exists.'
                ]);
        }

        $data = [
            'username'  => $username,
            'full_name' => $this->request->getPost('full_name')
        ];

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/avatars/';
            $newName = $avatar->getRandomName();

            service('image')
                ->withFile($avatar->getTempName())
                ->fit(300, 300, 'center')
                ->save($uploadPath . $newName);

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }
}