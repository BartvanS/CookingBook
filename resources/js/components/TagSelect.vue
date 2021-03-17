<template>
    <div>
        <v-select
            class="mt-1 block bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            multiple
            taggable
            :id="id"
            :options="options"
            v-model="selected"/>
        <input type="hidden"
               :name="name"
               :value="toString()"/>
    </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
    comments: {vSelect},
    props: ['id', 'name', 'options', 'value'],
    data() {
        return {
            selected: this.value ? this.value.split('\n') : [],
        }
    },
    methods: {
        toString() {
            return this.selected.join('\n');
        }
    }
};
</script>
