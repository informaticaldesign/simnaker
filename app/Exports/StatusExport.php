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
use App\Models\Status;

class StatusExport implements FromCollection, WithHeadings {

    public $listing_cols = ['statuss.code', 'statuss.name', 'jeniss.name AS jenis_kendaraan'];

    //put your code here
    public function collection() {
        return Status::select($this->listing_cols)->leftJoin('jeniss', 'jeniss.id', '=', 'statuss.jenis_id')->get();
    }

    public function headings(): array {
        return ["Kode", "Nama", "Jenis Kendaraan",];
    }

}
