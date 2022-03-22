<?php

namespace App\Repositories;
use App\Interfaces\IDownload;
use App\Interfaces\IReportData;

class ReportRepository implements IDownload,IReportData
{
    public function GetData()
    {
        return [
            'name' => 'sajid',
            'age' => 28
        ];
    }
    public function Download($format)
    {
        return response()->download('report_file.'.$format);
    }
}