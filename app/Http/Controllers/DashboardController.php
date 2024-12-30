<?php

namespace App\Http\Controllers;

use App\Services\PhotoService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
        $this->middleware('auth');
        $this->middleware('admin')->only(['approveUploads', 'approvePhoto', 'rejectPhoto']);
    }

    public function approveUploads()
    {
        $pendingPhotos = $this->photoService->getPendingPhotos();

        return view('dashboard.approve-uploads', compact('pendingPhotos'));
    }

    public function approvePhoto($photoId)
    {
        $this->photoService->approvePhoto($photoId, auth()->user()->id);
        return redirect()->route('dashboard.approve-uploads');
    }

    public function rejectPhoto($photoId)
    {
        $this->photoService->rejectPhoto($photoId);
        return redirect()->route('dashboard.approve-uploads');
    }
}
