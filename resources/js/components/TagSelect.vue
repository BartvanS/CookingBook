<template>
    <div>
        <v-select multiple
                  taggable
                  name="name"
                  :options="options"
                  v-model="selected"
                  v-on:change="onChange"
        />
        <input type="hidden" :value="toString()"/>
    </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
    comments: {vSelect},
    props: ['name', 'options'],
    data() {
        return {
            selected: [],
        }
    },
    methods: {
        onChange() {
            this.selected = this.selected.map(value => value.replaceAll(';', ''));
        },
        toString() {
            return this.selected.join(';');
        }
    }
};
</script>
