<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageUploadService;
use App\Models\Item;
use App\Http\Requests\UploadImageRequest;

class ImageUploadController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        // $this->middleware('auth.basic');
        $this->imageUploadService = $imageUploadService;
    }

    public function upload(UploadImageRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $itemId = $request->input('item_id');

            try {
                $item = Item::findOrFail($itemId);

                $imageUrl = $this->imageUploadService
                    ->uploadImage($file, "images/$itemId");

                $item->setImgUrl($imageUrl);
                $item->save();

                return response()->json([
                    'message' => 'Image uploaded successfully!',
                    'image_url' => $imageUrl,
                    'item_id' => $itemId
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'error' => 'No image file found'
        ], 400);
    }
}
