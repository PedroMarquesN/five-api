<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    use AuthorizesRequests;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'image' => 'required|image|max:2048',
        ]);

        $filePath = $request->file('image')->store('uploads/photos', 'public');

        $validated['caminho'] = $filePath;
        $validated['status'] = 'pendente';
        $photo = auth()->user()->photos()->create($validated);


        return response()->json(['message' => 'Photo uploaded successfully!', 'data' => $photo], 201);
    }

    public function index()
    {
        $photos = Photo::with('user:name,id', 'aprovadoPor:name')->get();

        return response()->json($photos);
    }

    public function approve(Request $request, Photo $photo)
    {
        $this->authorize('update', $photo);

        $photo->update([
            'status' => 'aprovado',
            'aprovado_por' => auth()->id(),
        ]);

        return response()->json(['message' => 'Photo approved successfully!', 'data' => $photo]);
    }

    public function reject(Request $request, Photo $photo)
    {
        $this->authorize('update', $photo);

        $photo->update([
            'status' => 'rejeitado',
        ]);

        return response()->json(['message' => 'Photo rejected successfully!', 'data' => $photo]);
    }

    public function destroy(Photo $photo)
    {
        if ($photo->caminho) {
            Storage::disk('public')->delete($photo->caminho);
        }

        $photo->delete();

        return response()->json(['message' => 'Photo deleted successfully!']);
    }
}
