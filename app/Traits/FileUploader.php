<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait FileUploader
{
    public function handleFileUpload(
        Request $request,
        string $fileName,
        ?string $oldPath = null,
        string $dir = 'uploads',
    ): ?string
    {
        /* Delete the existing image */
        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }

        /* Check request has file */
        if (!$request->hasFile($fileName)) {
            return null;
        }

        $file = $request->file($fileName);
        $extension = $file->getClientOriginalExtension();
        $updatedFileName = Str::random(30).'.'.$extension;

        $file->move(public_path($dir), $updatedFileName);

        $filePath = $dir.'/'.$updatedFileName;

        return $filePath;
    }
}
