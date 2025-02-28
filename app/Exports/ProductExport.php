<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            "Name",
            "Description",
            "Price",
            "Additions",
            "Calories",
            "Size",
            "Product_Type(Food,Sauce,Addition)",
            "Has_Alcohol?(yes,no)",
            "Has_Pig?(yes,no)",
            "Type ID",
            "Branch ID",
        ];
    }

    public function collection()
    {
        $c=collect();
        return $c;
    }
}
