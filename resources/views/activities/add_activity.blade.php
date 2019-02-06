
<form method="POST" action="" id="add-activity-form">
    @csrf

    <div class="row">
        <div class="col s12">
            <h3 id='add-activity-modal-question' class="orange-text">Add Task</h3>
        </div>
    </div>
    <div class="row">
        <div class="col m2 s12"><span class='bold'>Subject:</span></div>
        <div class="col m10 s12">{{$topic->level->name}} - {{ $topic->module->subject->name }} </div>
    </div>
    <div class="row">
        <div class="col m2 s12"><span class='bold'>Topic:</span></div>
        <div class="col m10 s12">{{ $topic->name }}</div>
    </div>
    <div class="row">
        <div class="col s12">

                <div class="no-margin-bottom">
                    <input type="hidden" name="presentation" value="1">
                    <br>
                    <div class="input-field col s12">
                        <input type="text" name="name">
                        <label class="active">Name of Task</label>
                    </div>

                    <div class="input-field col s12">
                        <select name="section">
                            <option value="" disabled selected>Select A Class</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->level->name }} - {{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field col s12">
                        <select name="purpose" id="selected-subject">
                            <option value="" disabled selected>Select A Purpose</option>
                            @foreach($purposes as $purpose)
                                <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field col s12" id="module-options">
                        <input type="text" class="datepicker" name="deadline">
                    </div>
                </div>


        </div>
    </div>


    <div class="row">
        <div class="input-field col s12">
            <button type='submit' class="waves-effect waves-light btn orange" id="add-activity-modal-btn">
                <i class="material-icons left">add</i>
                {{ __('Add Task') }}
            </button>

        </div>
    </div>

</form>
