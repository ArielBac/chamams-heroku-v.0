<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                    <th v-if="visualizar.visivel || atualizar.visivel || remover.visivel"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>

                        <span v-if="titulos[chaveValor].tipo == 'data'">{{ valor | formataDataHoraGlobal }}</span> <!-- lógica de formatação feita na aula 385 -->
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/' + valor" width="30" height="30">
                        </span>
                    </td>
                    <td v-if="visualizar.visivel || atualizar.visivel || remover.visivel">
                        <button v-if="remover.visivel" class="btn btn-outline-danger btn-sm float-right" :data-toggle="remover.dataToggle" :data-target="remover.dataTarget" @click="setStore(dados[chave])">Remover</button>
                        <button v-if="atualizar.visivel" class="btn btn-outline-primary btn-sm float-right mr-1" :data-toggle="atualizar.dataToggle" :data-target="atualizar.dataTarget" @click="setStore(dados[chave])">Atualizar</button>
                        <button v-if="visualizar.visivel" class="btn btn-outline-primary btn-sm float-right mr-1" :data-toggle="visualizar.dataToggle" :data-target="visualizar.dataTarget" @click="setStore(dados[chave])">Visualizar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'titulos', 'atualizar', 'visualizar', 'remover'],
        methods: {
            setStore(obj) {
                this.$store.state.transacao.status = ''
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
            },
        },
        computed: {
            dadosFiltrados() {
                let campos = Object.keys(this.titulos) // Recupera todas as chaves desse objeto
                let dadosFiltrados = []

                this.dados.map((item, chave) => {
                    let intemFiltrado = {}

                    campos.forEach(campo => {
                        intemFiltrado[campo] = item[campo] // Utilizar sintaxe de array para atribuir valores a objetos
                    })
                    dadosFiltrados.push(intemFiltrado)
                })
                return dadosFiltrados // Retorna um array de objetos
            },
        },
    }
</script>



