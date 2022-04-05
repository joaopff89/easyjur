<template>
    <div class="container">

        <filter-component>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text label-filter">Tipo</span>
                        <select class="form-select" id="tipo" name="tipo" v-model="filter.tipo">
                                <option value="">Todos</option>
                                <option value="Moto">Moto</option>
                                <option value="Carro">Carro</option>
                                <option value="Caminhão">Caminhão</option>
                            </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text label-filter">Marca</span>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Informe uma marca" v-model="filter.marca">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text label-filter">Modelo</span>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Informe um modelo" v-model="filter.modelo">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text label-filter">Versão</span>
                        <input type="text" class="form-control" id="versao" name="versao" placeholder="Informe uma versão" v-model="filter.versao">
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-sm btn-filter float-start" @click="loadFilter()">Filtrar</button>
            </div>
        </filter-component>

        <div>
            <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalDicaAdd" @click="setStore()">Nova Dica</button>
        </div>
            
            <table-component 
                :data="dicas.data"
                :view-action="true"
                :titles="['Id', 'Usuário', 'Tipo', 'Marca', 'Modelo', 'Versão', 'Descricão', 'Criado em', 'Alterado em']"
                :fields="['id', 'usuario', 'tipo', 'marca', 'modelo', 'versao', 'descricao', 'criado_em', 'alterado_em']"
            >
            </table-component>

        <pagination-component>
            <li v-for="link, key in dicas.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="pagination(link)">
                <a class="page-link pointer">
                    <span v-if="link.label == '&laquo; Previous'">Anterior</span>
                    <span v-else-if="link.label == 'Next &raquo;'">Próximo</span>
                    <span v-else >{{ link.label }}</span>
                </a>
            </li>
        </pagination-component>

        <modal-component id="modalDicaAdd" title="Adicionar Dica">

            <template v-slot:alerts>
                <alert-component type="success" :msg="saveMsg" title="Cadastro realizado com sucesso." v-if="$store.state.transaction.status == 'success'"></alert-component>
                <alert-component type="danger" :msg="saveMsg" title="Erro ao salvar Dica." v-if="$store.state.transaction.status == 'error'"></alert-component>
            </template>

            <template v-slot:content v-if="$store.state.transaction.status != 'success'">
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
                            <span class="input-group-text label-filter">Descrição</span>
                            <input type="text" class="form-control" id="descricao" nome="descricao" v-model="descricao">
                        </div>
                        <small id="dicaHelp" class="form-text text-muted">Descreva a dica do veículo.</small>
                    </div>
                </div>
            </template>

            <template v-slot:footer>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-sm" @click="save()" v-if="$store.state.transaction.status != 'success'">Salvar</button>
            </template>

        </modal-component>

        <modal-component id="modalDicaEdit" title="Editar Dica">

            <template v-slot:alerts>
                <alert-component type="success" :msg="saveMsg" title="Alteração realizada com sucesso." v-if="$store.state.transaction.status == 'success'"></alert-component>
                <alert-component type="danger" :msg="saveMsg" title="Erro ao alterar Dica." v-if="$store.state.transaction.status == 'error'"></alert-component>
            </template>

            <template v-slot:content v-if="$store.state.transaction.status != 'success'">
                <div class="row">

                    <input type="hidden" name="user-id" id="user-id" v-model="userId">
                    
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Tipo</span>
                            <select class="form-select" id="tipoUpdate" name="tipoUpdate" :value="$store.state.item.tipo">
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
                            <input type="text" class="form-control" id="marcaUpdate" nome="marcaUpdate" :value="$store.state.item.marca">
                        </div>
                        <small id="marcaHelp" class="form-text text-muted">Descreva a marca do veículo.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Modelo</span>
                            <input type="text" class="form-control" id="modeloUpdate" nome="modeloUpdate" :value="$store.state.item.modelo">
                        </div>
                        <small id="modeloHelp" class="form-text text-muted">Descreva o modelo do veículo.</small>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Versão</span>
                            <input type="text" class="form-control" id="versaoUpdate" nome="versaoUpdate" :value="$store.state.item.versao">
                        </div>
                        <small id="versaoHelp" class="form-text text-muted">Descreva a versão do veículo. (Campo Opcional)</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Descrição</span>
                            <input type="text" class="form-control" id="descricaoUpdate" nome="descricaoUpdate" :value="$store.state.item.descricao">
                        </div>
                        <small id="dicaHelp" class="form-text text-muted">Descreva a dica do veículo.</small>
                    </div>
                </div>
            </template>

            <template v-slot:footer>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-sm" @click="edit()" v-if="$store.state.transaction.status != 'success'">Salvar</button>
            </template>

        </modal-component>

        <modal-component id="modalDicaDelete" title="Excluir Dica">
            
            <template v-slot:alerts>
                <alert-component type="success" :msg="{}" title="Registro removido com sucesso!" v-if="$store.state.transaction.status == 'success'"></alert-component>
                <alert-component type="danger" :msg="{message: $store.state.transaction.msg}" title="Erro ao remover registro!" v-if="$store.state.transaction.status == 'error'"></alert-component>
            </template>

            <template v-slot:content v-if="$store.state.transaction.status != 'success'">
                <div class="row">

                    <input type="hidden" name="user-id" id="user-id" v-model="userId">
                    
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Tipo</span>
                            <select class="form-select" id="tipo" name="tipo" :value="$store.state.item.tipo" disabled="disabled">
                                <option value="Moto">Moto</option>
                                <option value="Carro">Carro</option>
                                <option value="Caminhão">Caminhão</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Marca</span>
                            <input type="text" class="form-control" id="marca" nome="marca" :value="$store.state.item.marca" disabled="disabled">
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Modelo</span>
                            <input type="text" class="form-control" id="modelo" nome="modelo" :value="$store.state.item.modelo" disabled="disabled">
                        </div>
                        
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Versão</span>
                            <input type="text" class="form-control" id="versao" nome="versao" :value="$store.state.item.tipo" disabled="disabled">
                        </div>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col mb-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text label-filter">Descrição</span>
                            <input type="text" class="form-control" id="descricao" nome="descricao" :value="$store.state.item.descricao" disabled="disabled">
                        </div>
                        
                    </div>
                </div>
            </template>

            <template v-slot:footer>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger btn-sm" v-if="$store.state.transaction.status != 'success'" @click="remove()">Remover</button>
            </template>

        </modal-component>

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

                token = token ? token.split('=')[1] : '';
                token = 'Bearer ' + token;

                return token;
            }
        },

        data() {
            return {
                urlBase: "api/dica",
                url: '',
                tipo: '',
                marca: '',
                modelo: '',
                versao: '',
                descricao: '',
                descricaoUpdate: '',
                saveStatus: '',
                saveMsg: {},
                dicas: {
                    data: []
                },
                filter: {
                    user_id: this.userId,
                    tipo: '',
                    marca: '',
                    modelo: '',
                    versao: '',
                }
            }
        },

        methods: {
            setStore() {
                this.$store.state.transaction.status = "";
                this.$store.state.transaction.msg = "";
                this.tipo = "";
                this.marca = "";
                this.modelo = "";
                this.versao = "";
                this.descricao = "";
            },

            remove() {
                let url = this.urlBase + "/" + this.$store.state.item.id;

                let formData = new FormData();
                formData.append('_method', "delete");
                formData.append('userId', this.userId);
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                
                axios.post(url, formData, config)
                    .then(response =>{
                        this.$store.state.transaction.status = "success";
                        this.loadTable();

                    })
                    .catch(errors => {
                        this.$store.state.transaction.status = "error";
                        this.$store.state.transaction.msg = errors.response.data.msg;
                    })
                    
            },

            loadFilter() {
                this.url = this.urlBase + "?paged=true&" + this.groupFilter();
                this.loadTable();
            },

            groupFilter() {
                let filter = "";

                for(let key in this.filter){
                    if(this.filter[key] != ""){
                        filter += key + "=" + this.filter[key] + "&";
                    }
                }
                return filter;
            },

            pagination(link) {
                if(link.url){
                    this.url = link.url + "&paged=true&" + this.groupFilter();
                    this.loadTable();
                }
            },

            loadTable() {
                axios.get(this.url)
                    .then(response => {
                        this.dicas = response.data;
                    })
                    .catch(errors => {
                        this.dicas.data = [];
                    })
            },

            edit() {
                let url = this.urlBase + "/" + this.$store.state.item.id;

                let formData = new FormData();
                formData.append('_method', 'put');
                formData.append('userId', this.userId);
                formData.append('tipo', document.getElementById("tipoUpdate").value);
                formData.append('marca', document.getElementById("marcaUpdate").value);
                formData.append('modelo', document.getElementById("modeloUpdate").value);
                formData.append('versao', document.getElementById("versaoUpdate").value);
                formData.append('descricao', document.getElementById("descricaoUpdate").value);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.saveMsg = {
                            msg: response.data.msg
                        }
                        this.saveStatus = "success";
                        this.$store.state.transaction.status = "success";
                        this.loadTable();
                    })
                    .catch(errors => {
                        this.saveMsg = {
                            message: errors.response.data.message,
                            errors: errors.response.data.errors
                        }
                        this.saveStatus = "error";
                        this.$store.state.transaction.status = "error";
                        this.$store.state.item.tipo = document.getElementById("tipoUpdate").value;
                        this.$store.state.item.marca = document.getElementById("marcaUpdate").value;
                        this.$store.state.item.modelo = document.getElementById("modeloUpdate").value;
                        this.$store.state.item.versao = document.getElementById("versaoUpdate").value;
                        this.$store.state.item.descricao = document.getElementById("descricaoUpdate").value;
                        
                    })
                    
            },

            save() {
                let url = this.urlBase;

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

                axios.post(url, formData, config)
                    .then(response => {
                        this.saveMsg = {
                            msg: response.data.msg
                        }
                        this.saveStatus = "success";
                        this.$store.state.transaction.status = "success";
                        this.loadTable();
                    })
                    .catch(errors => {
                        this.saveMsg = {
                            message: errors.response.data.message,
                            errors: errors.response.data.errors
                        }
                        this.saveStatus = "error";
                        this.$store.state.transaction.status = "error";
                    })
            }
        },

        mounted() {
            this.loadFilter();
        }
    }
</script>