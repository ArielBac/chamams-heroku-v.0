<?php

namespace App\Exports;

use App\Models\Relatorio;
use Maatwebsite\Excel\Concerns\FromCollection;

class RelatoriosExport implements FromCollection
{
    public function __construct($id_relatorio)
    {
        $this->id_relatorio = $id_relatorio;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Relatorio::where('id', $this->id_relatorio)->get();
        // return Relatorio::all();
    }
}
