<?php
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return UserResource::collection($users);
    }

    public function activate(User $user)
    {
        $user->is_admin = true;
        $user->save();
        return response()->json(['message' => 'Usuário ativado como administrador']);
    }

    public function deactivate(User $user)
    {
        $user->is_admin = false;
        $user->save();
        return response()->json(['message' => 'Usuário desativado como administrador']);
    }
}
