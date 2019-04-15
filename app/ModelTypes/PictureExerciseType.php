<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 14:24
 */

namespace App\ModelTypes;


class PictureExerciseType
{
    const START = 'start';
    const END = 'end';
    const ICON = 'icon';

    public static function getAll(): array
    {
        return [
            self::ICON,
            self::START,
            self::END
        ];
    }
}