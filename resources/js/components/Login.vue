<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Entrar</div>

                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="login($event)"> <!-- o submit.prevent muda o comportamento padrão do formulário -->
                            <input type="hidden" name="_token" :value="csrf_token">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus v-model="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Mantenha-me conectado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Entrar
                                    </button>
                                    <a class="btn btn-link" href="#">
                                        Esqueci a senha
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a href="http://chamams-v0.herokuapp.com/google/login" class="btn btn-danger btn-block mt-3 w-100">
                                        Entrar com Google
                                    </a>
                                    <!-- <button type="button" class="btn btn-danger btn-block mt-3 w-100" data-toggle="modal" data-target="#modalLoginGoogle">Entrar com Google</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para aviso que login com google não está disponível -->
        <!-- <modal-component id="modalLoginGoogle" titulo="OPS!">
            <template v-slot:conteudo>
                Pedimos desculpas, em breve esta opção estará disponível
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </template>
        </modal-component> -->
    </div>
</template>

<script>
    export default {
        props: ['csrf_token'], // Análogas ao atributo data, ou seja, o funcionamento é semlhante
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login(e) {
                let url = 'http://chamams-v0.herokuapp.com/api/login'
                let configuracao = {
                    method: 'post',
                    body: new URLSearchParams({ // Nativo js para usar o formato x-www-form...
                        'email': this.email,
                        'password': this.password
                    })
                }

                fetch(url, configuracao)
                .then(response => response.json()) // Recupera a resposta da requisição
                .then(data => {
                    if (data.token) {
                        document.cookie = 'token=' + data.token + ';SameSite=Lax'
                    }

                    // Dá sequencia no envio do form de autenticação por sessão
                    e.target.submit()
                })
            }
        },
    }
</script>
