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
use App\Models\Bbn;

class BbnExport implements FromCollection, WithHeadings {

    //put your code here
    public function collection() {
        return Bbn::select([
                            'bbns.id',
                            'bbns.no_registrasi',
                            'bbns.name',
                            'bbns.address',
                            'provinsis.name AS kecamatan_name',
                            'jeniss.name AS jenis_kendaraan',
                            'brands.name AS merk_kendaraan',
                            'bbns.tahun AS tahun_kendaraan',
                            'bbns.status'
                        ])
                        ->leftJoin('jeniss', 'jeniss.id', '=', 'bbns.jenis_id')
                        ->leftJoin('brands', 'brands.id', '=', 'bbns.brand_id')
                        ->leftJoin('provinsis', 'provinsis.id', '=', 'bbns.kec_id')
                        ->leftJoin('stnks', function ($join) {
                            $join->on('stnks.transaksi_id', '=', 'bbns.id')
                            ->where('stnks.jenis_file', '=', 'BERKAS');
                        })->get();
    }

    public function headings(): array {
        return ["id", "no_registrasi", "nama", "alamat", "kecamatan", "jenis_kendaraan", "merk_kendaraan", "tahun_kendaraan", "status"];
    }

}
