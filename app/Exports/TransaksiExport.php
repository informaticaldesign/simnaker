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
use App\Models\Transaksi;

class TransaksiExport implements FromCollection, WithHeadings {

    //put your code here
    public function collection() {
        return Transaksi::select([
                            'transaksis.id',
                            'transaksis.no_registrasi',
                            'transaksis.name',
                            'transaksis.address',
                            'provinsis.name AS kecamatan_name',
                            'jeniss.name AS jenis_kendaraan',
                            'brands.name AS merk_kendaraan',
                            'transaksis.tahun AS tahun_kendaraan',
                            'statuss.name AS status_kendaraan',
                            'status'
                        ])
                        ->leftJoin('jeniss', 'jeniss.id', '=', 'transaksis.jenis_id')
                        ->leftJoin('brands', 'brands.id', '=', 'transaksis.brand_id')
                        ->leftJoin('statuss', 'statuss.id', '=', 'transaksis.status_id')
                        ->leftJoin('provinsis', 'provinsis.id', '=', 'transaksis.kec_id')
                        ->leftJoin('stnks', function ($join) {
                            $join->on('stnks.transaksi_id', '=', 'transaksis.id')
                            ->where('stnks.jenis_file', '=', 'STNK');
                        })->get();
    }

    public function headings(): array {
        return ["id", "no_registrasi", "nama", "alamat", "kecamatan", "jenis_kendaraan", "merk_kendaraan","tahun_kendaraan","status_kendaraan","status"];
    }

}
