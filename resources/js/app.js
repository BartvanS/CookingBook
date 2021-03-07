import './bootstrap';
import './autoResizeTextArea';
import InputList from './components/InputList';
import vSelect from 'vue-select'
import TagSelect from './components/TagSelect';
import 'vue-select/dist/vue-select.css';

window.Vue = require('vue').default;

require('livewire-vue');

Vue.component('input-list', InputList);
Vue.component('tag-select', TagSelect);
Vue.component('v-select', vSelect);

const app = new Vue({
    el: '#app',
});
