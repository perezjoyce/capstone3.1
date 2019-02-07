<form id="add-question-form" method="POST">
    @csrf

    <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">
    <input type="hidden" name="new_order" value="{{$order}}">
    <header>
        <h5 class="orange-text bold" style="display:inline-block;margin-left:10px;">Question&nbsp;#{{$order}}</h5>
    </header>
    <div class="row" style="margin-top:0;">
        <div class="col s12">
            <div class="row">
                <textarea name="new_question" class="wysiywg" id="" cols="30" rows="5">Type your new question here.</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">live_help</i>
                    <textarea id="new_hint" name="new_hint" class="materialize-textarea validate" required></textarea>
                    <label for="new_hint">Hint</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">info</i>
                    <textarea id="new_explanation" name="new_explanation" class="materialize-textarea validate" required></textarea>
                    <label for="new_explanation">Explanation</label>
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

                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">check</i>
                    <textarea name="new_answer_1" class="materialize-textarea validate" required></textarea>
                    <label for="new_answer_1">Correct Answer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea name="new_answer_2" class="materialize-textarea validate" required></textarea>
                    <label for="new_answer_2">Wrong Answer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea name="new_answer_3" class="materialize-textarea validate" required></textarea>
                    <label for="new_answer_3">Wrong Answer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea name="new_answer_4" class="materialize-textarea validate" required></textarea>
                    <label for="new_answer_4">Wrong Answer</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn orange add-question-modal-btn right" data-id="{{ $chapter->id }}">Save New Question</button>
                </div>
            </div>
        </div>
    </div>
</form>