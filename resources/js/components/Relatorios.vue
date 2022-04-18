<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Inicio card listagem de relatórios -->
                <card-component titulo="Relatórios">
                    <template v-slot:conteudo>
                        <table-component
                            :dados="relatorios.data"

                            :visualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalVisualizarRelatorio' }"
                            :atualizar="{ visivel: false, dataToggle: '#', dataTarget: '#' }"
                            :remover="{ visivel: false, dataToggle: '#', dataTarget: '#' }"

                            :titulos="{
                                id: { titulo: 'ID', tipo: 'texto' },
                                created_at: { titulo: 'Data de criação', tipo: 'data'},
                            }"
                        >
                        </table-component>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-12">
                                <paginate-component>
                                    <li v-for="l, key in relatorios.links" :key="key"
                                        :class="l.active ? 'page-item active' : 'page-item'"
                                        @click="paginacao(l)"
                                    >
                                        <span v-if="l.label == '&laquo; Previous'">
                                            {{l.label = '&laquo; Anterior'}}
                                        </span>
                                        <span v-if="l.label == 'Next &raquo;'">
                                            {{l.label = 'Pŕoximo &raquo;'}}
                                        </span>
                                        <a class="page-link" v-html="l.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <!-- <div class="col">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAdicionarMarca">Adicionar</button>
                            </div> -->
                        </div>
                        <a href="/home" class="btn btn-primary btn-sm float-right" style="height: fit-content;">Voltar</a>
                    </template>
                </card-component>
                <!-- Fim card listagem de relatórios -->


                <!-- Inicio card exportar relatório -->
                <!-- <card-component titulo="Exportar Relatório Mensal">
                    <template v-slot:conteudo>
                        Relatório mensal
                    </template>

                    <template v-slot:rodape>
                        <div>
                            <a class="btn btn-primary btn-sm float-right ml-2" href="relatorios/exportacao/xlsx">XLSX</a>

                            <a class="btn btn-primary btn-sm float-right ml-2" href="relatorios/exportacao/csv">CSV</a>

                            <a class="btn btn-primary btn-sm float-right" href="relatorios/pdf">PDF</a>
                        </div>
                        <a href="/home" class="btn btn-primary btn-sm float-right">Voltar</a>
                    </template>
                </card-component> -->
                <!-- Fim card exportar relatório -->
            </div>
        </div>

        <!-- Inicio do modal de visualização de relatorio  -->
        <modal-component id="modalVisualizarRelatorio" titulo="Visualizar Relatório">
            <template v-slot:alertas>

            </template>

            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>
                <input-container-component titulo="SGBD">
                    <input type="text" class="form-control" :value="$store.state.item.sgbd" disabled>
                </input-container-component>
                <input-container-component titulo="Base de Dados">
                    <input type="text" class="form-control" :value="$store.state.item.database" disabled>
                </input-container-component>
                <input-container-component titulo="Tabela">
                    <input type="text" class="form-control" :value="$store.state.item.tabela" disabled>
                </input-container-component>
                <input-container-component titulo="Descrição">
                    <input type="text" class="form-control" :value="$store.state.item.texto" disabled>
                </input-container-component>
                 <input-container-component titulo="Data de criação">
                    <input type="text" class="form-control" :value="$store.state.item.created_at | formataDataHoraGlobal" disabled>
                </input-container-component>
            </template>

            <template v-slot:rodape>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Exportar
                    </button>
                    <div class="dropdown-menu">
                        <a :href="'relatorios/pdf/' + $store.state.item.id" class="dropdown-item">PDF</a>
                        <div class="dropdown-divider"></div>
                        <a :href="'relatorios/exportacao/' + $store.state.item.id + '/csv'" class="dropdown-item">CSV</a>
                        <div class="dropdown-divider"></div>
                        <a :href="'relatorios/exportacao/' + $store.state.item.id + '/xlsx'"  class="dropdown-item">XLSX</a>
                    </div>
                    <!-- <div class="dropdown-menu">
                        <a href="relatorios/pdf" class="dropdown-item">PDF</a>
                        <div class="dropdown-divider"></div>
                        <a href="relatorios/exportacao/csv" class="dropdown-item">CSV</a>
                        <div class="dropdown-divider"></div>
                        <a href="relatorios/exportacao/xlsx" class="dropdown-item">XLSX</a>
                    </div> -->
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!-- Fim do modal de visualização de relatorio  -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                urlBase: 'http://chamams-v0.herokuapp.com/api/v1/relatorio',
                urlPaginacao: '',
                urlFiltro: '',
                transacaoStatus: '',
                transacaoDetalhes: {},
                relatorios: { data: [] },
            }
        },
        methods: {
            paginacao(l) {
                if (l.url) {
                    this.urlPaginacao = l.url.split('?')[1]

                    this.carregarLista()
                }
            },
            carregarLista() {
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro

                axios.get(url)
                    .then(response => {
                        this.relatorios = response.data
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },
        },
        mounted() {
            this.carregarLista()
        }
    }
</script>
