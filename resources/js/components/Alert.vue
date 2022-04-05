<template>
    <div :class="style" role="alert">
        {{ title }}
        <hr v-if="msg.message"/>
        <span v-if="msg.message == 'Token not provided'">Token não fornecido. Refaça seu login!</span>
        <span v-else-if="msg.message == 'Token has expired'">O token expirou. Refaça seu login</span>
        <span v-else-if="msg.message == 'The given data was invalid.'"></span>
        
        <span v-else>{{msg.message}}</span>
        
        <ul v-if="msg.errors">
            <li v-for="e, key in msg.errors" :key="key">{{ e[0] }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['type', 'title', 'msg'],

        computed: {
            style() {
                return 'alert alert-' + this.type + ' alert-dismissible fade show'
            }
        }
    }
</script>
