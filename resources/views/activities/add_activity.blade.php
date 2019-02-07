
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
                        <input type="text" name="name" class="validate" required>
                        <label>Name of Task</label>
                    </div>

                    <div class="input-field col s12" id="section-options">
                        <select name="section" id="selected-section" class="validate" required>
                            {{--I DID NOT ADD CONDITION TO CLASSES/SECTIONS FOR THE GRADE LEVEL OF THIS CHAPTER TO ALLOW MORE FLEXIBILITY FOR THE TEACHER THROUGH REMEDIAL AND ENHANCEMENT --}}
                            <option value="" disabled selected>Select A Class</option>
                            @foreach($sections as $section)
                                {{--IF ACTIVITY FOR THIS CHAPTER HAS BEEN GIVEN TO A SECTION, INDICATE SO --}}
                                @if($section->activities->count() > 0)
                                    <option value="{{ $section->id }}">{{ $section->level->name }} - {{ $section->name }} ****** Has {{$section->activities->count()}} task/s for this lesson ******</option>
                                   @else
                                    <option value="{{ $section->id }}">{{$section->activities->count()}} - {{ $section->level->name }} - {{ $section->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field col s12" id="purpose-options">
                        <select name="purpose" id="selected-purpose" class="validate">
                            <option value="" disabled selected>Select A Purpose</option>
                        </select>
                    </div>

                    <div class="input-field col s12" id="module-options">
                        <input type="text" class="datepicker" name="deadline" required>
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
