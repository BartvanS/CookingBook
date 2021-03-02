import './bootstrap';
import './autoResizeTextArea';
import InputList from './components/InputList';

window.confirmDeleteModel = function () {
    return confirm("Weet je zeker of je dit wilt verwijderen?");
}

window.Vue = require('vue').default;

require('livewire-vue');

Vue.component('input-list', InputList);

const app = new Vue({
    el: '#app',
});
