<form id="edit-question-form" method="POST">
    @csrf
    @method('put')

    <input type="hidden" name="chapterId" value="{{ $chapter->id }}">
    <header>
        <h5 class="orange-text bold" style="display:inline-block;margin-left:10px;">Question&nbsp;#{{ $question->order }}</h5>
    </header>
    <div class="row" style="margin-top:0;">
        <div class="col s12">
            <div class="row">
                <textarea name="edit_question" class="wysiywg" id="" cols="30" rows="5">{{ $question->question }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">live_help</i>
                    <textarea id="edit_hint" name="edit_hint" class="materialize-textarea">{{ $question->hint }}</textarea>
                    <label for="edit_hint" class="active">Hint</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">info</i>
                    <textarea id="edit_explanation" name="edit_explanation" class="materialize-textarea">{{ $question->explanation }}</textarea>
                    <label for="edit_explanation" class="active">Explanation</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text left" style="margin-top:7px;">memory</i>
                    <h5 class="orange-text bold" style="display:inline-block;margin-left:40px;">Choices</h5>
                </div>
                @foreach($question -> choices as $choice)
                    @if($choice->is_correct === 1)
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">check</i>
                    <textarea name="edit_answer_{{ $choice->order }}" class="materialize-textarea">{{ $choice->choice }}</textarea>
                </div>
                    @else
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea name="edit_answer_{{ $choice->order }}" class="materialize-textarea">{{ $choice->choice }}</textarea>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <button class="btn orange edit-question-modal-btn" data-id="{{ $chapter->id }}" data-questionid="{{ $question->id }}">Save Changes</button>
</form>