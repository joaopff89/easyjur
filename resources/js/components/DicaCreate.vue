<template>
    <div class="container">
        <div :class="alert" role="alert">
            {{msgAlert}}
        </div>
        <div>
            <div class="row">
                <input type="hidden" name="user-id" id="user-id" v-model="userId">
                <div class="form-group col-md-6 mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text label-filter">Tipo</span>
                        <select class="form-select" id="tipo" name="tipo" v-model="tipo">
                            <option value="Moto">Moto</option>
                            <option value="Carro">Carro</option>
                            <option value="Caminhão">Caminhão</option>
                        </select>
                    </div>
                    <small id="tipoHelp" class="form-text text-muted">Selecione o tipo do veículo.</small>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text label-filter">Marca</span>
                        <input type="text" class="form-control" id="marca" nome="marca" v-model="marca">
                    </div>
                    <small id="marcaHelp" class="form-text text-muted">Descreva a marca do veículo.</small>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text label-filter">Modelo</span>
                        <input type="text" class="form-control" id="modelo" nome="modelo" v-model="modelo">
                    </div>
                    <small id="modeloHelp" class="form-text text-muted">Descreva o modelo do veículo.</small>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text label-filter">Versão</span>
                        <input type="text" class="form-control" id="versao" nome="versao" v-model="versao">
                    </div>
                    <small id="versaoHelp" class="form-text text-muted">Descreva a versão do veículo. (Campo Opcional)</small>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text label-filter">Dica</span>
                        <input type="text" class="form-control" id="descricao" nome="descricao" v-model="descricao">
                    </div>
                    <small id="dicaHelp" class="form-text text-muted">Descreva a dica do versão.</small>
                </div>
            </div>

            <div>
                <slot name="btn-back"></slot>
                <button type="submit" class="btn btn-success btn-sm btn-filter float-start mx-3" @click="save()">Gravar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['userId'],

        computed: {
            token() {
                let token = document.cookie.split(';').find(indice => {
                    return indice, indice.includes('token=');
                })

                token = token.split('=')[1];
                token = 'Bearer ' + token;

                return token;
            }
        },

        data() {
            return {
                url: "http://localhost:8000/api/dica",
                userId: null,
                tipo: null,
                marca: null,
                modelo: null,
                versao: null,
                descricao: null,
                alert: 'd-none',
                msgAlert: ''
            }
        },

        methods: {

            save() {
                let formData = new FormData();
                formData.append('userId', this.userId);
                formData.append('tipo', this.tipo);
                formData.append('marca', this.marca);
                formData.append('modelo', this.modelo);
                formData.append('versao', this.versao);
                formData.append('descricao', this.descricao);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.url, formData, config)
                    .then(response => {
                        this.alert = "alert alert-success";
                        this.msgAlert = "Dica salva com sucesso!"
                    })
                    .catch(erros => {
                        this.alert = "alert alert-danger";
                        this.msgAlert = "erro"
                    })
            }
        }
    }
</script>