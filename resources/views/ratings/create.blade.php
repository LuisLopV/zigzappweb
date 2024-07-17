@foreach($travels as $travel)
<div class="modal fade" id="rateModal{{ $travel->id }}" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="rateModalLabel">Calificar Viaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="score" class="form-label">Calificación</label>
                        <input type="number" class="form-control" id="score" name="score" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentario</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
                    </div>
                    <input type="hidden" name="qualified_id" value="{{ $travel->driver_id }}">
                    <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar Calificación</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
