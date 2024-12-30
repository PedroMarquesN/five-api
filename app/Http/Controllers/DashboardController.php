<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $photosUploaded = Photo::count();
        $pendingApprovals = Photo::where('status', 'pendente')->count();
        $registeredUsers = User::count();


        //implementar a logica para o grafico

        return response()->json([
            'photosUploaded' => $photosUploaded,
            'pendingApprovals' => $pendingApprovals,
            'registeredUsers' => $registeredUsers,
        ]);
    }


}
