<div class="offcanvas offcanvas-start" tabindex="-1" id="menuLateralADM" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Manager OnClick</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      
      <div class="adm-mpl d-flex mb-2">
        <div class="me-2 align-self-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
            <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557"/>
          </svg>
        </div>
        <div class="flex-fill adm-mpl-tit align-self-center">Administração</div>
      </div>
      
      <div class="adm-sml d-flex">
        <div class="adm-sml-icon me-2 align-self-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
            <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557"/>
          </svg>
        </div>

        <div class="flex-fill adm-sml-tit align-self-center">
          <a href="{{ route('usuario.consulta') }}">Usuários</a>
        </div>
      </div>


      <div class="adm-sml d-flex">
        <div class="adm-sml-icon me-2 align-self-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
            <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557"/>
          </svg>
        </div>

        <div class="flex-fill adm-sml-tit align-self-center">
          <a href="{{ route('roles.index') }}">Papeis</a>
        </div>
      </div>

      
    </div>
  </div>

<style scoped>
.adm-mpl-tit {
  text-transform: uppercase;
  font-weight: bold;
}
.adm-sml {
  margin-left: 25px;
  padding: 10px 0px;
  border-bottom: 1px dashed #9e9e9e;
}
.adm-sml:hover {
  background-color: #97b9e031
}
.adm-sml-tit a {
  text-decoration: none;
  color: #225188;
}
</style>