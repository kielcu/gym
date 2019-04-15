<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 17:16
 */

return [
    'images' => [
        'path' => env('IMAGE_HOST', storage_path()),
        'exercise' => env('IMAGE_EXERCISE', 'images\exercise')
    ]
];