<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class CampaignProductExport implements FromCollection,WithHeadings,WithMapping,WithTitle 
{
    public function __construct($camp_product) 
    {
        $this->camp_product = $camp_product;
    }

    public function map($row): array
    {
        return [
            @$row->product->id,
            @$row->product->name,
            @$row->product->price,
            @$row->product->code,
            @$row->product->description
        ];
    }


    public function headings(): array
    {
        return [
            'S.No',
            'Product Name',
            'Price',
            'Code',
            'Description'
            
        ];
    }
     public function collection()
    {
         return $this->camp_product;
    }
   

    public function title(): string
    {
        return 'Product';
    }
	   
}
