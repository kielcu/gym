<?php

namespace App\Exports;

use App\Models\Training;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrainingExportExcel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Training::with('works')->get();
    }
}
