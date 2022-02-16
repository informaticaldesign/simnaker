<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Exports;

/**
 * Description of ProvinsiExport
 *
 * @author heryhandoko
 */
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Brand;

class BrandExport implements FromCollection, WithHeadings {

    public $listing_cols = ['jeniss.name AS jenis_kendaraan', 'brands.code', 'brands.name'];

    //put your code here
    public function collection() {
        return Brand::select($this->listing_cols)->leftJoin('jeniss', 'jeniss.id', '=', 'brands.jenis_id')->get();
    }

    public function headings(): array {
        return ["Jenis Kendaraan", "Kode", "Nama"];
    }

}
