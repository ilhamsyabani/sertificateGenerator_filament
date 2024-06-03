<?php

namespace App\Imports;

use App\Models\Sertifikat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SertifikatImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // Get the first array (header row)
        $firstArray = $collection->first();

        // Initialize an array to hold the subsequent data rows
        $datas = [];

        // Iterate over the collection, skipping the first item (header row)
        foreach ($collection->slice(1) as $item) {
            $datas[] = $item;
        }

        // Iterate over each data row and create Sertifikat records
        foreach ($datas as $data) {
            // Ensure that the data array has the expected number of elements
            if (count($firstArray) >= 6 && count($data) >= 6) {
                // Create a new Sertifikat instance
                $sertifikat = Sertifikat::create([
                    $firstArray[0] => $data[0],
                    $firstArray[1] => $data[1],
                    $firstArray[2] => $data[2],
                    $firstArray[3] => $data[3],
                    $firstArray[4] => $data[4],
                    $firstArray[5] => $data[5],
                ]);

                // Set the sertifikat_link attribute
                $sertifikat->sertificate_link = "https://sertifikat.test/serifikat/{$sertifikat->id}";

                // Save the updated Sertifikat instance
                $sertifikat->save();
            }
        }
    }
}
