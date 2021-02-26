<template>
    <div>
        <ul class="divide-y divide-gray-200 py-1">
            <li class="py-1 flex justify-between" v-for="(item, index) in items" :key="index">
                <div class="text-sm text-gray-500 cursor-move">
                    {{ item }}
                </div>
                <div class="text-gray-200 hover:text-red-500 cursor-pointer"
                     v-on:click="$delete(items, index)">
                    <Times/>
                </div>
            </li>
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
import Times from "./Icons/Times";

export default {
    components: {Times},
    props: ['label', 'name', 'value'],
    data() {
        return {
            input: '',
            items: this.value ? this.value.split('\n') : [],
        }
    },
    methods: {
        add(e) {
            e.preventDefault();

            let value = this.input.trim();

            if (value.length === 0) {
                return;
            }

            this.items.push(value);
            this.input = '';
        },
        toValue() {
            return this.items.join('\n');
        }
    }
};
</script>
