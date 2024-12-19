/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

// Importar o componente
import UserList from './components/adm/usuarios/UserList.vue';

const app = createApp({});

// Registrar o componente
app.component('user-list', UserList);


// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

// Montar o Vue na página
app.mount('#app');
