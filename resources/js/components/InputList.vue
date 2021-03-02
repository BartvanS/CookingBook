<template>
    <div>
        <ul class="divide-y divide-gray-200 py-1">
            <draggable v-model="items">
                <transition-group>
                    <li class="py-1 flex justify-between" v-for="(item, index) in items" :key="item.id">
                        <div class="text-sm text-gray-500 cursor-move">
                            {{ item.value }}
                        </div>
                        <div class="text-gray-200 hover:text-red-500 cursor-pointer"
                             v-on:click="$delete(items, index)">
                            <Times/>
                        </div>
                    </li>
                </transition-group>
            </draggable>
        </ul>
        <form v-on:submit="add" class="mt-1 flex rounded-md shadow-sm">
            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                <input type="text"
                       class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300"
                       aria-label="Add new item"
                       placeholder="Add an item"
                       v-model="input">
            </div>
            <button
                type="submit"
                class="relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                Add
            </button>
        </form>
        <input type="hidden"
               :value="toValue()"
               :name="name">
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import Times from "./Icons/Times";

export default {
    components: {draggable, Times},
    props: ['label', 'name', 'value'],
    data() {
        let counter = 1;
        let items = this.value ? this.value.split('\n') : [];

        return {
            input: '',
            items: items.map(item => ({value: item, id: counter++})),
            counter: counter,
        }
    },
    methods: {
        add(e) {
            e.preventDefault();

            let value = this.input.trim();

            if (value.length === 0) {
                return;
            }

            this.items.push({
                value: value,
                id: this.counter++,
            });
            this.input = '';
        },
        toValue() {
            return this.items.map(item => item.value).join('\n');
        }
    }
};
</script>
