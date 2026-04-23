<form action="{{ route('member.productions.destroy', $production->uuid) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-light rounded-circle mx-1 text-danger delete-btn" title="Supprimer">
        <i class="fa fa-trash"></i>
    </button>
</form>
