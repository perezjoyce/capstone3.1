<form id="edit-questions-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')
    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold"><i class="material-icons small left">help</i>&nbsp;Questions</h5>
    </header>
    <br>
    <textarea name="questions" class="wysiywg" id="" cols="30" rows="10">


    </textarea>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>