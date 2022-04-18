<template>
<div class="form-group">
    <label :for="id" class="form-label">{{ titulo }}</label>
    <slot></slot> <!-- Pega o conteúdo interno deste componente e imprime a aqui -->
    <div :id="idHelp" class="form-text text-muted">{{ textoAjuda }}</div>
</div>
</template>

<script>
    export default {
        props: ['id', 'titulo', 'idHelp', 'textoAjuda']
    }
</script>
