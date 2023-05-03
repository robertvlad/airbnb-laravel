<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Warning</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure that you want to DELETE this Message? <span id="modal-item-title"></span>
            </div>
            @if(count($messages) > 0)
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-square btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form class="d-inline-block" action="{{route('admin.messages.destroy', $message->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-square btn-danger">
                        Delete
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>