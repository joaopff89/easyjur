<template>
    <div>
        <h3 class="text-center mb-0">Dicas de Veículos</h3>
        <div class="mt-5 table-responsive">
            
            <table class="table table-sm table-hover table-striped mt-2">

                <thead class="table-light">
                    <tr>
                        <th scope="col" v-for="title in titles" :key="title.id">{{title}}</th>
                        <th scope="col" v-if="viewAction">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dica in data" :key="dica.id">
                        <td v-if="fields.includes(key)" v-for="value, key in dica" :key="key">
                            <span v-if="key == 'criado_em' || key == 'alterado_em'">{{ value | formatDateTime }}</span>
                            <span v-else>{{ value }}</span>
                        </td>
                        <td v-if="viewAction">
                            <div style="min-width: 60px !important">
                                <i title="Editar" class='far fa-edit pointer btn-edit' data-bs-toggle="modal" data-bs-target="#modalDicaEdit" @click="setStore(dica)"></i>
                                <i title="Remover" class='far fa-trash-alt mx-2 pointer btn-delete' data-bs-toggle="modal" data-bs-target="#modalDicaDelete" @click="setStore(dica)"></i>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="data.length == 0">
                        <td colspan="20" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        filters: {
            formatDateTime(d) {
                d = d.split(" ");
                let date = d[0];
                let time = d[1];
                date = date = date.split("-");
                date = date[2] + "-" + date[1] + "-" + date[0];
                d = date + " " + time;
                return d;
            }   
        },

        props: ['data', "titles", "fields", "viewAction"],

        methods: {
            setStore(dica) {
                this.$store.state.transaction.status = "";
                this.$store.state.transaction.msg = "";
                this.$store.state.item = dica;
            }
        }
    }
</script>
