<template>
    <div>
      <!-- Filtros -->
      <div class="mb-4">
        
        <div class="row mb-3">
          <div class="col-md-6">
            <input v-model="filterName" type="text" class="form-control" placeholder="Filtrar por nome">
          </div>
          <div class="col-md-6">
            <input v-model="filterEmail" type="text" class="form-control" placeholder="Filtrar por email">
          </div>
        </div>
  
       
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <strong>Total de registros filtrados:</strong> {{ filteredUsers.length }}  
            <span v-if="filteredUsers.length !== users.length">
            (de um total de {{ users.length }} registros)
            </span>
        </div>
        <div>
            <!-- Botão para adicionar novo usuário -->
            <a href="/usuarios/novo" class="btn btn-primary">Cadastrar Novo Usuário</a>
        </div>
    </div>
  
    
    <!-- Tabela de Usuários -->
    <table class="table table-striped table-bordered">
        <thead class="bg-dark text-white">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ativo</th>
            <th class="actions-column">Ações</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="user in paginatedUsers" :key="user.id">
            <tr >
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <span class="badge" :class="user.ativo ? 'bg-success' : 'bg-danger'">
                  {{ user.ativo ? 'Sim' : 'Não' }}
                </span>
              </td>
              <td class="actions-column">
                <!-- Editar com link para rota de edição -->
                <a 
                  :href="`/usuarios/${user.id}/editar`" 
                  class="btn btn-sm btn-warning me-2"
                >
                  Editar
                </a>

                <!-- Gerenciar os papeis do usuário -->
                <!-- <a 
                  :href="`adm/usuarios/${user.id}/papeis`" 
                  class="btn btn-info btn-sm me-2"
                >Papeis
                </a> -->

                <!-- Gerenciar as permissões do usuário -->
                  <!-- <a 
                  :href="`adm/usuarios/${user.id}/permissoes`" 
                  class="btn btn-info btn-sm me-2"
                >
                  Permissões
                </a> -->

                <!-- Exibir papéis e permissões -->
                <a 
                  :href="`adm/usuarios/${user.id}/papeis-permissoes`"
                  class="btn btn-sm btn-info me-2"
                >
                  Papéis e Permissões
                </a>



                <!-- Excluir com link para rota de exclusão -->
                <a 
                  :href="`/usuarios/${user.id}/excluir`"
                  class="btn btn-sm btn-danger"
                  
                >
                  Excluir
                </a>
              </td>
            </tr>
            
          </template>
          
          <tr v-if="paginatedUsers.length === 0">
            <td colspan="4" class="text-center">Nenhum usuário encontrado</td>
          </tr>
        </tbody>
    </table>
  
      <!-- Paginação -->
      <div class="d-flex justify-content-center">
        <button @click="changePage(page - 1)" :disabled="page <= 1" class="btn btn-secondary btn-sm">Anterior</button>
        <span class="mx-3">Página {{ page }} de {{ totalPages }}</span>
        <button @click="changePage(page + 1)" :disabled="page >= totalPages" class="btn btn-secondary btn-sm">Próxima</button>
      </div>
    </div>
  </template>
  
  <script>
export default {
  props: ['users'], // Recebe todos os usuários como propriedade
  data() {
    return {
      filterName: '', // Filtro por nome
      filterEmail: '', // Filtro por email
      page: 1, // Página atual
      usersPerPage: 5 // Quantidade de usuários por página
    };
  },
  computed: {
    // Aplica o filtro sobre TODOS os usuários
    filteredUsers() {
      return this.users.filter(user => {
        return (
          user.name.toLowerCase().includes(this.filterName.toLowerCase()) &&
          user.email.toLowerCase().includes(this.filterEmail.toLowerCase())
        );
      });
    },
    // Aplica a paginação sobre os usuários já filtrados
    paginatedUsers() {
      const startIndex = (this.page - 1) * this.usersPerPage;
      const endIndex = startIndex + this.usersPerPage;
      return this.filteredUsers.slice(startIndex, endIndex);
    },
    // Total de páginas com base nos usuários filtrados
    totalPages() {
      return Math.ceil(this.filteredUsers.length / this.usersPerPage);
    }
  },
  watch: {
    // Reseta para a página 1 sempre que o filtro mudar
    filterName() {
      this.page = 1;
    },
    filterEmail() {
      this.page = 1;
    }
  },
  methods: {
    // Altera a página atual
    changePage(newPage) {
      if (newPage >= 1 && newPage <= this.totalPages) {
        this.page = newPage;
      }
    },
  }
};
</script>
  
  <style scoped>
  /* Estilo para cabeçalho da tabela */
  .table th, .table td {
    text-align: center;
  }
  
  .table {
    margin-top: 20px;
  }
  
  /* Estilo específico para o cabeçalho */
  .bg-dark {
    background-color: #343a40 !important;
  }
  
  .text-white {
    color: #fff !important;
  }
  
  /* Ajusta a largura da coluna de ações */
  .actions-column {
    width: 350px;
    text-align: center;
  }
  
  /* Botões de ação com espaçamento */
  .btn-sm {
    font-size: 0.875rem;
  }
  
  .btn-warning {
    margin-right: 10px;
  }
  
  .d-flex {
    margin-top: 20px;
  }
  
  .mb-4 {
    margin-bottom: 30px;
  }
  </style>
  