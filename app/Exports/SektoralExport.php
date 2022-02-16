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
use App\Models\Sektoral;

class SektoralExport implements FromCollection, WithHeadings {

    //put your code here
    public function collection() {
        return Sektoral::select([
                            'sektorals.id',
                            'provinsis.name AS provinsi',
                            'sektors.name AS sektor',
                            'bidangs.name AS opd',
                            'urusans.name AS urusan',
                            'suburusans.name AS suburusan',
                            'sektorals.tahun'
                        ])->leftJoin('provinsis', 'provinsis.id', '=', 'sektorals.provinsi_id')
                        ->leftJoin('sektors', 'sektors.id', '=', 'sektorals.sektor_id')
                        ->leftJoin('bidangs', 'bidangs.id', '=', 'sektorals.bidang_id')
                        ->leftJoin('urusans', 'urusans.id', '=', 'sektorals.urusan_id')
                        ->leftJoin('suburusans', 'suburusans.id', '=', 'sektorals.suburusan_id')->get();
    }

    public function headings(): array {
        return ["id", "provinsi", "sektor", "opd", "urusan", "suburusan", "tahun"];
    }

}
