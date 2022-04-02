<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StaticCourseGradeExport extends DataExport implements FromCollection
{
    public function __construct($collection, $columns, $title)
    {
        parent::__construct($collection, $columns, $title);
    }

    public function collection()
    {
        return parent::collection();
    }

    public function startCell(): string
    {
        return parent::startCell();
    }

    public function headings(): array
    {
        return parent::headings();
    }

    public function styles(Worksheet $sheet)
    {
        return parent::styles($sheet);
    }

    public function registerEvents(): array
    {
        return parent::registerEvents();
    }

    public function map($data): array
    {
        return [
            $data->email,
            $data->code,
            $data->user_name,
            $data->class_name,
            $data->subject_name,
            $data->semester_name,
            $data->score ? $data->score : " - ",
            is_null($data->status) ? " - " : 
            ($data->status ? "Passed" : "Failed"),
        ];
    }

}
