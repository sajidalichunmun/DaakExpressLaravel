<?php

namespace App\Imports;

use App\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

/*
class ExcelImport implements ToModel, WithBatchInserts, WithChunkReading,
WithValidation, WithHeadingRow {*/

class ExcelImport implements ToModel,WithMultipleSheets,
		SkipsUnknownSheets,ToCollection
{
	use WithConditionalSheets;
	
	public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            User::create([
                'name' => $row[0],
            ]);
        }
    }
	
	public function conditionalSheets(): array
    {
        return [
            'Worksheet 1' => new FirstSheetImport(),
            'Worksheet 2' => new SecondSheetImport(),
            'Worksheet 3' => new ThirdSheetImport(),
        ];
    }
	
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Excel([
           'cont_no'     => $row[0],
           'cont_no1'     => $row[0],
		   'cont_no2'     => $row[0],
        ]);
		/*
			return new Bill([
			'batch_name' => $row['batch_name'],
			'bill_date' => $row['date'],
			'status' => $row['status'],
			'category' => $row['category'],
			'ps_red' => $row['self_red'],
			'ps_normal' => $row['self_normal'],
			'multi' => $row['multi'],
			'greater_than' => $row['greater_than'],
			'credit_note' => $row['credit_note'],
			'micdh' => $row['micdh'],
			'hold' => $row['hold'],
			'hand_delivery' => $row['hand_delivery'],
			'total_issued' => $row['total_issued'],
			'dispatch_date' => $row['disp_date'],
			'user_added' => Auth::id()
		]);*/
    }
	
	public function sheetsIndex(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
        ];
    }
	
	public function sheets(): array
    {
        return [
            'Worksheet 1' => new FirstSheetImport(),
            'Worksheet 2' => new SecondSheetImport(),
        ];
    }
    
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
	
	public function batchSize(): int
	{
		return 1000;
	}

	public function chunkSize(): int
	{
		return 1000;
	}

	public function rules(): array
	{
		return [
			'cont_no' => ['required', 'unique:contno'],
			];
		/*
		return [
			'batch_name' => ['required', 'unique:bills'],
			'date' => ['required', 'date', 'date_format:Y-m-d'],
			'status' => ['required','in:pending,completed'],
			'category' => ['required','in:CDMA,PSTN'],
			'self_red' => ['required', 'numeric', 'min:0'],
			'self_normal' => ['required', 'numeric', 'min:0'],
			'multi' => ['required', 'numeric', 'min:0'],
			'greater_than' => ['required', 'numeric', 'min:0'],
			'credit_note' => ['required', 'numeric', 'min:0'],
			'micdh' => ['required', 'numeric', 'min:0'],
			'hold' => ['required', 'numeric', 'min:0'],
			'hand_delivery' => ['required', 'numeric', 'min:0'],
			'total_issued' => ['required', 'numeric', 'min:0'],
			'disp_date' => ['nullable', 'date', 'date_format:Y-m-d'],

		];
		*/
	} 
}
