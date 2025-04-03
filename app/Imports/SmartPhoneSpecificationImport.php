<?php

namespace App\Imports;

use App\Models\SmartPhoneDescription;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\FeaturePhone;
use Log;

class SmartPhoneSpecificationImport implements  ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  __construct(string $model_id) {
        $this->model_id= $model_id;
        Log::info($this->model_id);
    }
    public function collection(Collection $rows)
    {
        // $model_id = DB::getPdo()->lastInsertId();
        //  Validator::make($rows->toArray(), [

        //      '*.feature_name' => 'required',
        //      '*.description' => 'required',

        //  ])->validate();

        // Log::info($this->model_id);
  Log::info(  $rows[0]);

        foreach ($rows as $row) {
            SmartPhoneDescription::create([
                'model_id' =>$this->model_id,
                'feature_name' => $row['feature_name'],
                'description' =>$row['description'],

            ]);

            Log::info( $row['feature_name']);
            Log::info( $row['description']);
        }
    }

}
