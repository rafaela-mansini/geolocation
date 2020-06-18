<div class="modal fade" tabindex="-1" role="dialog" id="gerarRotaModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">CEP</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Cidade/UF</th>
                    <th scope="col">Distância</th>
                </tr>
            </thead>
            <tbody id="bodyRoute"></tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Exportar rota</button>
      </div>
    </div>
  </div>
</div>