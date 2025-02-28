<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassExport implements FromArray, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function  __construct($value)
    {
        $this->value= $value;
    }

    public function headings(): array
    {
        return [
            "ID" ,
            "Name",
        ];
    }
    public function array(): array
    {
        return $this->value;
    }
//    public function collection()
//    {
//        $c=collect();
//        return $c;
//    }
}
