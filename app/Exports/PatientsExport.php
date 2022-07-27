<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Modules\Hospital\Entities\Patient;

class PatientsExport implements FromCollection, WithProperties
{
    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'lastModifiedBy' => auth()->user()->name,
            'title'          => 'Patients Export',
            'description'    => 'List of all patients',
            'subject'        => '',
            'keywords'       => ']',
            'category'       => '',
            'manager'        => '',
            'company'        => config('app.name'),
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Patient::all();
    }
}
