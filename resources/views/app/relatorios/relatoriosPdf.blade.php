<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            .page-break {
                page-break-after: always;
            }

            .titulo {
                border: 1px;
                background-color: #c2c2c2;
                text-align: center;
                width: 100%;
                text-transform: uppercase;
                font-weight: bold;
                margin-bottom: 25px;
            }

            table {
                width: 100%;
            }

            table th{
                text-align: left;
            }
        </style>
    </head>

    <body>
        <div class="titulo">Relatório</div>

        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SGBD</th>
                        <th>Base de Dados</th>
                        <th>Tabela</th>
                        <th>Descrição</th>
                        <th>Data de criação</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($relatorios as $key => $relatorio)
                        <tr>
                            <td>{{$relatorio->id}}</td>
                            <td>{{$relatorio->sgbd}}</td>
                            <td>{{$relatorio->database}}</td>
                            <td>{{$relatorio->tabela}}</td>
                            <td>{{$relatorio->texto}}</td>
                            <td>{{ date('d/m/Y', strtotime($relatorio->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Quebra de página --}}
        {{-- <div class="page-break"><h1>teste</h1></div> --}}
    </body>
</html>

