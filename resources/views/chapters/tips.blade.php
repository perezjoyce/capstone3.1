<form id="edit-tips-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')
    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold"><i class="material-icons small left">bookmark</i>&nbsp;Tips</h5>
    </header>
    <br>
    <textarea name="edit_tips" class="wysiywg validate" id="" cols="30" rows="10" required>{{ $chapter->tip }}</textarea>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>