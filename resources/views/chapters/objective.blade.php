<form id="edit-objective-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')

    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold"><i class="material-icons small left">track_changes</i>&nbsp;Objective</h5>
    </header>
    <br>
    <textarea name="edit_objective" class="wysiywg validate" id="" cols="30" rows="10" required>{{ $chapter->objective }}</textarea>

    <div class="row">
        <div class="col s12 no-margin-bottom">
            <p class="grey-text"><span class='bold'>Note:&nbsp;</span>Indicate a Motive Question after stating the objective.</p>
            <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
        </div>
    </div>

</form>

<script>
    $(document).ready(function() {
        $('textarea.count-length').characterCounter();
    });
</script>