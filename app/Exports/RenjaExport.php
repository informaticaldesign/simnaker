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
use App\Models\Renja;
use Auth;

class RenjaExport implements FromCollection, WithHeadings {

    protected $request;

    function __construct($request) {
        $this->request = $request;
    }

    //put your code here
    public function collection() {
        $users = Auth::user();
        return Renja::select([
                            'sim_renja.jenis_kegiatan',
                            'm_company.name AS perusahaan',
                            'm_company.address AS alamat',
                            'sim_renja.tgl_pelaksanaan',
                            'sim_renja.keterangan'
                        ])
                        ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                        ->where('sim_renja.created_by', $users->id)
                        ->whereYear('sim_renja.tgl_pelaksanaan', $this->request->y)
                        ->whereMonth('sim_renja.tgl_pelaksanaan', $this->request->m)
                        ->get();
    }

    public function headings(): array {
        return ["Jenis Kegiatan", "Nama Perusahaan", "Alamat Perusahaan", "Tanggal Pelaksanaan", "Keterangan"];
    }

}
