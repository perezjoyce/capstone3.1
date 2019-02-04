<form id="edit-practice-form" method="POST">
    @csrf
    @method('patch')

    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold"><i class="material-icons small left">supervisor_account</i>&nbsp;Practice</h5>
    </header>
    <br>
    <textarea name="edit_practice" class="wysiywg" id="" cols="30" rows="10">{{ $chapter->guided_practice }}</textarea>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>