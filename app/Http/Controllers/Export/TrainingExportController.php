<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-09
 * Time: 14:27
 */

namespace App\Http\Controllers\Export;


use App\Exports\TrainingExportExcel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Exporter;

class TrainingExportController extends Controller
{
    /**
     * @var Excel
     */
    private $excel;

    public function __construct(Exporter $excel)
    {
        $this->excel = $excel;
    }

    public function index(TrainingExportExcel $trainingExportExcel)
    {
        return $this->excel->download($trainingExportExcel, 'training.xlsx');
    }
}