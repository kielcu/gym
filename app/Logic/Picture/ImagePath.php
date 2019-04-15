<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 20:11
 */

namespace App\Logic\Picture;


use App\Models\Exercise;
use Illuminate\Contracts\Config\Repository;

class ImagePath
{
    /**
     * @var Repository
     */
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function exercise(Exercise $exercise): string
    {
        return $this->config->get('settings.images.path')
            . '/' . $this->config->get('settings.images.exercise')
            . '/' . $exercise->id;
    }
}