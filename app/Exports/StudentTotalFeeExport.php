<?php
  
namespace App\Exports;
  
use App\StudentTotalFee;
use Maatwebsite\Excel\Concerns\withHeadings;
//use Excel;
  
class StudentTotalFeeExport implements withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentTotalFee::all();
    }
}

