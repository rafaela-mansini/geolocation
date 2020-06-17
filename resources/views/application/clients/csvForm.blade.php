<div class="modal fade" tabindex="-1" role="dialog" id="modalCsv">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Importar CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('clientes/csv') }}" method="POST" enctype="multipart/form-data" name="formCsv" id="formCsv">
        @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Insira seu arquivo .CSV aqui</label>
                    <input type="file" name="csvArchive" class="form-control" />
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="formCsv">Salvar usuários importados</button>
      </div>
    </div>
  </div>
</div>