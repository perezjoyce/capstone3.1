<form id="edit-discussion-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')
    <input type="hidden" data-id="{{$chapter->id}}">
    <header><h5 class="orange-text bold"><i class="material-icons small left">local_library</i>&nbsp;Discussion</h5></header>
    <br>
    <textarea name="edit_discussion" class="wysiywg" id="" cols="30" rows="10">{{ $chapter->discussion }}</textarea>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>