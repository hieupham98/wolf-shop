<?php 

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class ImageUploadService
{
    protected $cloudinary;

    public function uploadImage($file, $folder = 'images')
    {
        try {
            $uploadedFileUrl = cloudinary()
                ->upload($file->getRealPath(), [
                    'folder' => $folder,
                ])
                ->getSecurePath();

            return $uploadedFileUrl;
        } catch (Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            throw new Exception('Image upload failed: ' . $e->getMessage());
        }
    }
}
