<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Log;
use Mockery;

class ImageUploadControllerTest extends TestCase
{
    protected $imageUploadServiceMock;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->imageUploadServiceMock = Mockery::mock(ImageUploadService::class);
        $this->app->instance(ImageUploadService::class, $this->imageUploadServiceMock);
    }

    /** @test */
    public function it_can_upload_an_image_and_update_item()
    {
        $item = Mockery::mock(Item::class)->makePartial();
        $item->shouldReceive('findOrFail')->with(1)->andReturn($item);
        $item->shouldReceive('setImgUrl')->once()->with('https://cloudinary.com/mock-image-url');
        $item->shouldReceive('save')->once();


        $this->imageUploadServiceMock->shouldReceive('uploadImage')
            ->once()
            ->with(Mockery::on(function ($file) {
                return $file instanceof UploadedFile;
            }), 'images/1') 
            ->andReturn('https://cloudinary.com/mock-image-url');

        $response = $this->json('POST', 'api/upload-images', [
            'image' => UploadedFile::fake()->image('image.jpg'),
            'item_id' => 1
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Image uploaded successfully!',
            'image_url' => 'https://cloudinary.com/mock-image-url',
            'item_id' => 1,
        ]);
    }

    /** @test */
    public function it_returns_an_error_when_image_upload_fails()
    {
        $this->imageUploadServiceMock->shouldReceive('uploadImage')
            ->once()
            ->with(Mockery::on(function ($file) {
                return $file instanceof UploadedFile;
            }), 'images/1')
            ->andThrow(new \Exception('Image upload failed'));

        $response = $this->json('POST', 'api/upload-images', [
            'image' => UploadedFile::fake()->image('image.jpg'),
            'item_id' => 1
        ]);

        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Image upload failed'
        ]);
    }

    /** @test */
    public function it_returns_an_error_when_no_image_is_provided()
    {
        $response = $this->json('POST', 'api/upload-images', [
            'item_id' => 1
        ]);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'No image file found'
        ]);
    }

    public function it_returns_an_error_when_item_does_not_exist()
    {
        $this->imageUploadServiceMock->shouldReceive('uploadImage')->never();

        $response = $this->json('POST', 'api/upload-images', [
            'image' => UploadedFile::fake()->image('image.jpg'),
            'item_id' => 999
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'No query results for model [App\\Models\\Item] 999'
        ]);
    }
}
