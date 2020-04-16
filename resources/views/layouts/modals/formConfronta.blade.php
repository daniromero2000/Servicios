<div id="confrontaCustomer" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog"
    aria-labelledby="confrontaCustomer-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confrontaCustomer-title">Preguntas de Seguridad</h5>
                <div id="timer" style="position: absolute;right: 4%;top: 0.7%;"></div>
            </div>
            <div class="modal-body text-center" id="response">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <br>
                <span>Cargando...</span>
            </div>
            <div class="modal-footer">
                <div class="row ">
                    <div class="col-4">
                        <button id="confrontaForm" class="btn btn-primary text-white button-confronta"
                            type="submit">Enviar</button>
                        <button id="updateData" class="btn btn-primary text-white button-confronta"
                            type="submit">Actualizar</button>
                        <a id="updateDataFailed" href=" javascript:location.reload()"
                            class="btn btn-secondary text-white button-confronta">Reitentar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>