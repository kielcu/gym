<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-05
 * Time: 15:04
 */

namespace App\Logic\Muscle;


use App\Models\Muscle;
use App\Repositories\MuscleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class MuscleLogic
{
    /**
     * @var MuscleRepository
     */
    private $muscleRepository;

    /**
     * MuscleLogic constructor.
     * @param MuscleRepository $muscleRepository
     */
    public function __construct(MuscleRepository $muscleRepository)
    {
        $this->muscleRepository = $muscleRepository;
    }

    public function findById(int $id): Muscle
    {
        try {
            return $this->muscleRepository->findById($id);
        } catch (QueryException $exception) {
            dd('aa');
        }
    }

    public function create(Muscle $muscle)
    {
        try {
            $this->muscleRepository->create($muscle);
        } catch (QueryException $exception) {
//            throw
        }
    }

    public function update(int $id, Muscle $muscle)
    {
        try {
            $this->muscleRepository->updateById($id, $muscle);
        } catch (QueryException $exception) {
            dd($exception->getCode());
        }
    }
}