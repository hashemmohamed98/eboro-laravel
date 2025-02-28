<?php

namespace App\Imports;

use App\Models\BranchProduct;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ProductImport implements ToCollection,WithStartRow
{
    /**
    * @param Collection $collection
    */
//    public function  __construct($branch_id,$type)
//    {
//        $this->branch_id= $branch_id;
//        $this->type= $type;
//    }

    public function collection(Collection $collection)
    {
        $arr = [];

        foreach ($collection as $item) {
            // Check for necessary conditions before processing
            if (!$item[0] || $item[0] == null || !$item[2] || $item[2] == null) {
                continue;
            }

            $data['branch_id'] = $item[10];
            $data['type'] = $item[9];
            $data['name'] = $item[0];
            $data['description'] = $item[1];

            // Replace commas with dots in the price string and convert to integer
            $data['price'] = floatval(str_replace(',', '.', $item[2]));

            // Example string with commas
            $data['additions'] = $item[3];
            $data['size'] = $item[5];
            $data['calories'] = $item[4];
            $data['product_type'] = $item[6];
            $data['has_alcohol'] = $item[7] == 'yes' ? 1 : 0;
            $data['has_pig'] = $item[8] == 'yes' ? 1 : 0;
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();

            // Push the processed data to the array
            array_push($arr, $data);
        }

        // Insert the processed data into the BranchProduct table
        BranchProduct::insert($arr);
    }



    public function startRow(): int
    {
        return 2;
    }


}
