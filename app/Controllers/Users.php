<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            [
                'username' => 'admin',
                'full_name' => 'Admin User',
                'role' => 'Administrator'
            ],
            [
                'username' => 'cashier1',
                'full_name' => 'John Rivera',
                'role' => 'Cashier'
            ],
            [
                'username' => 'cashier2',
                'full_name' => 'Liza Torres',
                'role' => 'Cashier'
            ],
            [
                'username' => 'manager1',
                'full_name' => 'Robert Cruz',
                'role' => 'Manager'
            ],
            [
                'username' => 'staff1',
                'full_name' => 'Sofia Lim',
                'role' => 'Staff'
            ]
        ];

        return view('users/index', [
            'users' => $users
        ]);
    }
}