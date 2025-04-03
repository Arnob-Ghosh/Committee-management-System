<?php

namespace App\Imports;


// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\FeaturePhoneDescription;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\FeaturePhone;
use Log;

class FeaurePhoneSpecificationImport implements ToCollection, WithHeadingRow
{
    public function  __construct(string $model_id) {
        $this->model_id= $model_id;
        Log::info($this->model_id);
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     // $model_id = DB::getPdo()->lastInsertId();
    //     return new FeaturePhoneDescription([
    //         'model_id' => $row[0],
    //                     'feature_name' => $row[1],
    //                     'description' =>$row[2],
    //     ]);
    // }



    public function collection(Collection $rows)
    {
        // $model_id = DB::getPdo()->lastInsertId();
        //  Validator::make($rows->toArray(), [

        //      '*.feature_name' => 'required',
        //      '*.description' => 'required',

        //  ])->validate();

        Log::info($this->model_id);
  Log::info(  $rows[0]);

        foreach ($rows as $row) {
            FeaturePhoneDescription::create([
                'model_id' =>$this->model_id,
                'feature_name' => $row['feature_name'],
                'description' =>$row['description'],

            ]);


        }
    }
}
