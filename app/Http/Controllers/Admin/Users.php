<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersListDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function index(UsersListDataTable $dataTable)
    {
        return $dataTable->render('admin.users.list');
    }
}
