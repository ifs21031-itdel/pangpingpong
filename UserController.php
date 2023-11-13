<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsersRoleAdmin(){
        $auth = Auth::user();
        $users = User::select('id', 'name', 'email', 'role')
            ->selectRaw('(SELECT COUNT(*) FROM todos WHERE todos.user_id = users.id) as total_todo')
            ->orderBy("role", "desc")
            ->orderBy("name", "asc")
            ->get();

        $data = [
            'auth' => $auth,
            'users' => $users
        ];
        
        return view('app.admin.users', $data);
    }
}
