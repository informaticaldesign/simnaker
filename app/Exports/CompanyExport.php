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

class CompanyExport implements FromCollection, WithHeadings {

    //put your code here
    public function collection() {
        return \App\Models\Company::select('id', 'name', 'address', 'phone', 'email')->get();
    }

    public function headings(): array {
        return ['id', 'name', 'address', 'phone', 'email'];
    }

}
