<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-09
 * Time: 14:01
 */

namespace App\Http\Controllers;


use App\Models\Exercise;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecordController extends Controller
{
    public function weight()
    {
        return Exercise::query()
            ->with([
                'work' => function(HasMany $query) {
                    $query->max('weight')->limit(1);
                }
            ])
            ->get()->toJson();

    }

    public function bulk()
    {
        return Exercise::query()
            ->with([
                'work' => function(HasMany $query) {
                    $query->max(\DB::raw('weight * series * repeat'))->limit(1);
                }
            ])
            ->get()->toJson();
    }
}