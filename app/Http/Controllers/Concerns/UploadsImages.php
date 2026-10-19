<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Uploads images to the public "uploads" disk (public/uploads) and removes
 * replaced files.
 *
 * The stored path in the database is prefixed with "uploads/" so that the
 * front-end can render it with asset(), e.g. "uploads/hero/abc123.png"
 * resolves to /uploads/hero/abc123.png.
 */
trait UploadsImages
{
    /**
     * Store an uploaded file (if present) and return its disk path.
     * When no file is uploaded the current path is returned unchanged.
     */
    protected function uploadImage(Request $request, string $field, string $directory, ?string $current = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $current;
        }

        $path = $request->file($field)->store($directory, 'uploads');

        if ($path === false) {
            return $current;
        }

        if (filled($current)) {
            $this->deleteImage($current);
        }

        return 'uploads/'.$path;
    }

    /**
     * Delete an image from the uploads disk. Files shipped with the
     * application (which live in public/images, i.e. no "uploads/" prefix)
     * are never touched.
     */
    protected function deleteImage(?string $path): void
    {
        if (filled($path) && str_starts_with($path, 'uploads/')) {
            Storage::disk('uploads')->delete(substr($path, strlen('uploads/')));
        }
    }
}
