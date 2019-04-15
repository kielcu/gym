<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 15:02
 */

namespace App\Mapper\Exercise;


use App\Logic\Picture\UploadPictureLogic;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\PictureExercise;

class FromExerciseMapper
{
    /** @var Exercise */
    private $exercise;
    /**
     * @var array
     */
    private $values;
    /**
     * @var UploadPictureLogic
     */
    private $uploadPictureLogic;

    public function __construct(UploadPictureLogic $uploadPictureExerciseLogic)
    {
        $this->uploadPictureLogic = $uploadPictureExerciseLogic;
    }

    public function map(Exercise $exercise, array $values): Exercise
    {
        $this->exercise = $exercise;
        $this->values = $values;

        $this->exercise->fill($this->values);

        $this->mapMuscles();
        $this->mapPictures();

        return $this->exercise;
    }

    private function mapMuscles()
    {
        if (! $this->values['muscles'] ?? null) {
           return;
        }

        $muscles = collect([]);
        foreach ($this->values['muscles'] as $value) {
            $muscle = new Muscle();
            $muscle->id = $value;

            $muscles->push($muscle);
        }

        $this->exercise->setRelation('muscles', $muscles);
    }

    private function mapPictures()
    {
        if (! $this->values['pictures'] ?? null) {
            return;
        }

        $pictures = collect([]);

        foreach ($this->values['pictures'] as $pictureType => $pictureUpload) {
            $image = $this->uploadPictureLogic->uploadExercise($pictureUpload, $pictureType);
dd($image);
            $picture = new PictureExercise([
                'name' => $image->filename,
                'path' => $image->dirname,
                'extension' => $image->extension,
                'type' => $pictureType,
            ]);

            $pictures->push($picture);
        }

        $this->exercise->setRelation('pictures', $pictures);
    }
}