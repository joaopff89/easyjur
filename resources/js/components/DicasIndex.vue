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

        <table-component 
            :data="dicas.data"
            :titles="['Id', 'Usuário', 'Tipo', 'Marca', 'Modelo', 'Versão', 'Descricão', 'Criado em', 'Alterado em']"
            :fields="['id', 'usuario', 'tipo', 'marca', 'modelo', 'versao', 'descricao', 'criado_em', 'alterado_em']"
        ></table-component>

        <pagination-component>
            <li v-for="link, key in dicas.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="pagination(link)">
                <a class="page-link pointer">
                    <span v-if="link.label == '&laquo; Previous'">Anterior</span>
                    <span v-else-if="link.label == 'Next &raquo;'">Próximo</span>
                    <span v-else >{{ link.label }}</span>
                </a>
            </li>
        </pagination-component>

    </div>
</template>

<script>
    export default {

        props: [],

        data() {
            return {
                urlBase: "api/dica",
                url: '',
                tipo: '',
                marca: '',
                modelo: '',
                versao: '',
                descricao: '',
                dicas: {
                    data: []
                },
                filter: {
                    tipo: '',
                    marca: '',
                    modelo: '',
                    versao: '',
                }
            }
        },

        methods: {
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
        },

        mounted() {
            this.loadFilter();
        }
    }
</script>
