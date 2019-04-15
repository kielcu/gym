<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 15:55
 */

namespace App\Logic\Picture;


use App\Models\Exercise;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class UploadPictureLogic
{
    /**
     * @var ImageManager
     */
    private $imageManager;
    /**
     * @var ImagePath
     */
    private $imagePath;

    public function __construct(ImageManager $imageManager, ImagePath $imagePath)
    {
        $this->imageManager = $imageManager;
        $this->imagePath = $imagePath;
    }

    public function uploadExercise(UploadedFile $uploadedFile, Exercise $exercise, string $name): Image
    {
        $path = $this->imagePath->exercise($exercise);

        if (!file_exists($path)) {
            mkdir($path, 0664, true);
        }

        return $this->imageManager->make($uploadedFile)->save("{$path}/{$name}.jpg");
    }
}