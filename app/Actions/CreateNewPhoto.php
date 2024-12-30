<?php

namespace App\Actions;

use App\Enums\PhotoStatusEnum;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class CreateNewPhoto
{

    public function handler($data): Photo
    {


        //poderia ser o storage S3
        $filePath = Storage::disk('public')->put('uploads/photos', $data['image']);

        $data['caminho'] = $filePath;
        $data['status'] = PhotoStatusEnum::PENDENTE;
        return auth()->user()->photos()->create($data);

    }
}
