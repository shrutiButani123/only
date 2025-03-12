<?php

namespace App\Exports;

use App\Models\Buyer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BuyersExport implements FromCollection,  WithHeadings
{
    protected $buyers;

    public function __construct($buyers)
    {
        $this->buyers = $buyers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $buyers =  $this->buyers;
        $data_array = [];

        foreach ($buyers as $buyer) {
            $data_array[] = [
                'name' => $buyer->name,
                'email' => $buyer->email,
                'address' => $buyer->address,
                'mobile_no' => $buyer->mobile_no,
                'buyer_type' => $buyer->buyer_type,
                'cut_quality' => $buyer->cut_quality,
                'color' => $buyer->color,
                'clarity' => $buyer->clarity,
                'carat_weight' => $buyer->carat_weight,
                'amount' => $buyer->amount,
            ];
        }

        return collect($data_array);
    }

    public function headings(): array
    {
        return [
            'Name', 'Email', 'Address', 'Mobile No', 'Buyer Type', 
            'Cut Quality', 'Color', 'Clarity', 'Carat Weight', 'Amount'
        ];
    }

}
