<form id="edit-example-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')
    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold"><i class="material-icons small left">lightbulb_outline</i>&nbsp;Example</h5>
    </header>
    <br>
    <textarea name="edit_example" class="wysiywg validate" id="" cols="30" rows="10" required>{{ $chapter->example }}</textarea>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>