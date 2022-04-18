<?php

namespace App\Http\Controllers;

use App\Exports\RelatoriosExport;
use App\Models\Relatorio;
use App\Repositories\RelatorioRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RelatorioController extends Controller
{
    public function __construct(Relatorio $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    public function index(Request $request)
    {
        //Inicio Aula 318
        $relatorioRepository = new RelatorioRepository($this->relatorio);

        // if ($request->has('atributos_modelos')) {
        //     $atributos_modelos = 'modelos:id,'.$request->atributos_modelos;
        //     $relatorioRepository->selectAtributosRegistrosRelacionados($atributos_modelos);
        // } else {
        //     $relatorioRepository->selectAtributosRegistrosRelacionados('modelos');
        // }

        if ($request->has('filtro')) {
            $relatorioRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $relatorioRepository->selectAtributos($request->atributos);
        }

        return response()->json($relatorioRepository->getResultadoPaginado(3), 200);
    }

    public function exportacao($id_relatorio, $extensao) {
        $nome_arquivo = 'relatorio';

        if ($extensao == 'xlsx' || $extensao == 'csv') {
            $nome_arquivo .= '.'.$extensao;

            //Passo apenas um relatorio para o download
            return Excel::download(new RelatoriosExport($id_relatorio), $nome_arquivo);
        } else {
            return redirect('relatorios');
        }
    }

    public function exportacaoPdf($id_relatorio) {

        // $relatorios = Relatorio::all();
        $relatorio = Relatorio::where('id', $id_relatorio)->get();

        $pdf = PDF::loadView('app.relatorios.relatoriosPdf', ['relatorios' => $relatorio]);
        return $pdf->download('relatorio.pdf');
    }
}
