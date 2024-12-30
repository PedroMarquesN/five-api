<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    use AuthorizesRequests;

    public function store(StorePhotoRequest $request)
    {
        $data = $request->validated();

        $filePath = $request->file('image')->store('uploads/photos', 'public');

        $data['caminho'] = $filePath;
        $data['status'] = 'pendente';
        $photo = auth()->user()->photos()->create($data);


        return PhotoResource::make($photo);
    }

    public function index()
    {
        $photos = Photo::with('user', 'aprovadoPor')->paginate();

        return PhotoResource::collection($photos);
    }

    public function approve(Request $request, Photo $photo)
    {
        $this->authorize('update', $photo);

        $photo->update([
            'status' => 'aprovado',
            'aprovado_por' => auth()->id(),
        ]);

        return PhotoResource::make($photo);
    }

    public function reject(Request $request, Photo $photo)
    {
        $this->authorize('update', $photo);

        $photo->update([
            'status' => 'rejeitado',
        ]);

        return PhotoResource::make($photo);
    }

    public function destroy(Photo $photo)
    {
        if ($photo->caminho) {
            Storage::disk('public')->delete($photo->caminho);
        }

        $photo->delete();

        return response()->json(['message' => 'Photo deleted successfully!', 204]);
    }
}
