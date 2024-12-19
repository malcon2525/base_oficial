<template>
    <div class="container mt-5">
      <!-- Filtros -->
      <div class="row mb-3">
        <div class="col-md-6">
          <input 
            v-model="filters.name"
            type="text" 
            class="form-control" 
            placeholder="Filtrar por nome" 
          />
        </div>
        <div class="col-md-6">
          <input 
            v-model="filters.email"
            type="text" 
            class="form-control" 
            placeholder="Filtrar por email" 
          />
        </div>
      </div>
  
      <!-- Botão de Cadastro -->
      <div class="row mb-3">
        <div class="col text-end">
          <a href="/usuarios/novo" class="btn btn-primary">Cadastrar Novo Usuário</a>
        </div>
      </div>
  
      <!-- Tabela -->
      <table class="table table-striped">
        <thead class="table-dark">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ativo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in filteredUsers" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <span class="badge" :class="user.ativo ? 'bg-success' : 'bg-danger'">
                {{ user.ativo ? 'Sim' : 'Não' }}
              </span>
            </td>
            <td>
              <a 
                :href="`/usuarios/${user.id}/editar`" 
                class="btn btn-sm btn-warning me-2"
              >
                Editar
              </a>
  
              <!-- Excluir com link para rota de exclusão -->
              <a 
                :href="`/usuarios/${user.id}/excluir`"
                class="btn btn-sm btn-danger"
                @click.prevent="confirmDelete(user.id)"
              >
                Excluir
              </a>
            </td>
          </tr>
          <tr v-if="filteredUsers.length === 0">
            <td colspan="4" class="text-center">Nenhum usuário encontrado</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      users: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        filters: {
          name: '',
          email: '',
        },
      };
    },
    computed: {
      filteredUsers() {
        return this.users.filter((user) => {
          const nameMatch = user.name.toLowerCase().includes(this.filters.name.toLowerCase());
          const emailMatch = user.email.toLowerCase().includes(this.filters.email.toLowerCase());
          return nameMatch && emailMatch;
        });
      },
    },
    methods: {
      confirmDelete(userId) {
        if (confirm("Tem certeza que deseja excluir este usuário?")) {
          window.location.href = `/usuarios/${userId}/excluir`;  // Redireciona para a rota de exclusão
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .table {
    margin-top: 20px;
  }
  </style>
  