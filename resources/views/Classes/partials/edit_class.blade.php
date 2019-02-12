{{--EDIT A CLASS--}}


            <form method="POST" method="" name="edit-class-form">
                @csrf

                <div class="row">
                    <div class="col s12">
                        @if($section->status == 'active')
                            <h5 class="orange-text bold">Edit A Class</h5>
                            @else
                            <h5 class="orange-text bold">Unarchive A Class</h5>
                            <br>
                            <p>Do you want to set {{ $section->level->name }} - {{ $section->name }} as active?</p>
                        @endif
                    </div>
                </div>
                @if($section->status == 'active')
                    <div class="row">
                        <div class="col s12 input-group">
                            <label>Grade Level</label>
                            <select class="browser-default" required="required" name="edit_grade_level" id="edit_grade_level">
                                <option value="{{ $section->level->id }}" selected>{{ $section->level->name }}</option>
                                @foreach($levels as $level)
                                    @if($level->id != $section->level->id)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 input-group">
                            <label>Subject</label>
                            <select class="browser-default" required="required" class="validate" name="edit_subject">
                                <option value="{{ $section->subject->id }}" selected>{{ $section->subject->name }}</option>
                                @foreach($subjects as $subject)
                                    @if($subject->id != $section->subject->id)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 input-group">
                            <label for="edit_class_name" class="active">Class Name</label>
                            <input type="text" required class="validate" id="edit_class_name" name="edit_class_name" value="{{ $section->name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 input-group">
                            <label for="edit_school_year" class="active">School Year</label>
                            <input type="text" required class="validate" id="edit_school_year" name="edit_school_year" value="{{ $schoolYear }}">
                        </div>
                    </div>
                @else
                    <input type="hidden" name="edit_grade_level" value="{{ $section->level->id }}">
                    <input type="hidden" name="edit_subject" value="{{ $section->subject->id }}">
                    <input type="hidden" name="edit_class_name" value="{{ $section->name }}">
                    <input type="hidden" name="edit_school_year" value="{{ $schoolYear }}">
                @endif
                <div class="row">
                    <div class="col s12 input-group">
                        <label>Status</label>
                        <select class="browser-default" required="required" class="validate" name="edit_status">
                            @if($section->status == 'active')
                                <option value="active" selected>Active</option>
                                <option value="archived">Archive</option>
                            @else
                                <option value="active" selected>Active</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="section_id" value="{{$section->id}}">
                        <button class="waves-effect waves-light btn orange btn-edit-class" data-id="{{ $section->id }}" data-name="{{ $section->name }}">
                            <i class="material-icons left">edit</i>
                            {{ __('Apply Changes') }}
                        </button>
                    </div>
                </div>
            </form>


