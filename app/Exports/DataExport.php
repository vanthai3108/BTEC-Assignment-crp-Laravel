<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataExport implements FromCollection, WithHeadings, WithEvents, WithMapping, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    use RegistersEventListeners;
    public $collection;
    public $columns;
    public $title;

    public function __construct($collection, $columns, $title)
    {
        $this->collection = $collection;
        $this->columns = $columns;
        $this->title = $title;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->collection;
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function headings(): array
    {
        $columns = [];
        foreach($this->columns as $column) {
            $columns[] = $column;
        }
        return $columns;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:'.$sheet->getHighestColumn().'3');
        $sheet->setCellValue('A1', $this->title);
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => 'center', 'vertical' => 'center')
        );
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // $cellRange = 'A8:W8';
                $event->sheet->getDelegate()
                                ->getStyle('A1')
                                ->getFont()
                                ->setSize(12)
                                ->getColor()
                                ->setRGB('0000ff');
            }
        ];
    }

    public function map($data): array
    {
        return [
            $data->email,
            $data->code,
            $data->name,
            // $data->score ? $data->score : "-",
            // is_null($data->course_user_status) ? "- " : 
            // ($data->course_user_status ? "Passed" : "Failed"),
        ];
    }
}
