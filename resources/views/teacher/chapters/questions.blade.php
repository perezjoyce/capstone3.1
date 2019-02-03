<form id="edit-questions-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')
    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold" style="display:inline-block;margin-left:10px;">#&nbsp;Question</h5>
    </header>
    <div class="row" style="margin-top:0;">
        <div class="col s12">
            <div class="row">

                <textarea name="create_question" class="wysiywg" id="" cols="30" rows="5"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">live_help</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Hint</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix orange-text">info</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Explanation</label>
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
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Correct Answer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Wrong Answer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Wrong Answer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text">clear</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Wrong Answer</label>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>