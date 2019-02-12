<div style="overflow-x: auto;" class="grey-text text-darken-2">
    <div class="center-align" style="min-width:500px;">
            <div class='right row'>
                <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
            </div>

            <div class="modal-content">
                <div class="row">
                    <div class="col s12" style="padding-top:15px;">
                        <div class="col s12 left-align">
                            <h4 class="orange-text text-darken-1">{{ $section->name }} - {{ $section->level->name }}</h4>
                            <p class="orange-text text-darken-1 light">S.Y. {{ $section->school_year }}</p>

                                {{--<div class="row">--}}
                                    {{--<div class="col m2 s3"><span class='bold'>Tasks:</span></div>--}}
                                    {{--<div class="col s9">{{ $numberOfActivities }}</div>--}}
                                {{--</div>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col m2 s3"><span class='bold'>Total Score:</span></div>--}}
                                    {{--<div class="col s9">{{ $totalScore }}</div>--}}
                                {{--</div>--}}

                        </div>
                    </div>
                    <div class="col s12">
                        @if($numberOfActivities > 0)
                        <table class="striped" style="font-size:.9rem;">
                            <thead>
                                <tr>
                                    <th style="width:10%;">#</th>
                                    <th style="width:35%;">Student</th>
                                    <th style="width:10%;">Accomplished</th>
                                    <th style="width:5%;"></th>
                                    <th style="width:25%;">Ave Score</th>
                                    <th style="width:5%;"></th>
                                    <th style="width:5%;"></th>
                                    <th style="width:5%;"></th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <?php

                                    $answered = $user->activities()->where('user_id', $user->id)->distinct()->count('activity_id');
                                    $progress = ($answered / $numberOfActivities) * 100;
                                    $progress = round($progress);
//                                  $studentScore = $user->activities()->where('user_id', $user->id)->sum('score');
                                    $studentScore = $user->activities()->where('user_id', $user->id)->pluck('score')->avg(); // get students ave score
//                                  $average = $studentScore / $totalScore; // divide ave score by the total score and multiply by 100 to get grade
//                                  $average = round($average);

                                ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <div class="row no-margin-bottom">
                                            <div class="col s12 right-align">
                                                <small>
                                                    {{ $answered }} of
                                                    {{ $numberOfActivities }} Tasks
                                                </small>
                                            </div>
                                        </div>
                                        <div class="progress grey lighten-2">
                                            <div class="determinate orange darken-3" style="width:{{$progress}}%"></div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td>{{ $studentScore }} of {{ $totalScore }}</td>
                                    <td>
                                        <a href="#!" class="btn grey lighten-2 grey-text btn-open-remove-student-modal"
                                           data-id="{{ $user->id }}"
                                           data-sectionid="{{ $section->id }}"
                                           data-name="{{ $user->name }}"
                                           data-level="{{ $section->level->name }}"
                                           data-section="{{ $section->name }}"
                                           ><i class="material-icons">delete</i></a>
                                    </td>
                                    <td>
                                        <a href="#!" class="btn green lighten-1 btn-open-edit-student-modal" data-id="{{ $user->id }}"
                                           data-name="{{ $user->name }}" data-level="{{ $section->level->name }}"
                                           data-section="{{ $section->name }}" data-subject="{{ $section->subject->name }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="subject_progress/{{$user->id}}" method="GET">
                                            @csrf
                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                            <input type="hidden" name="subjectId" value="{{$section->subject->id}}">
                                            <input type="hidden" name="sectionId" value="{{$section->id}}">
                                            <button type="submit" class="btn orange" data-id="{{ $user->id }}" data-subjectid="{{ $user->id }}" data-sectionid="{{ $section->id }}"><i class="material-icons">open_in_new</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col s12">
                                <div class="row">
                                    <br>
                                    <div class="col s12">
                                        <div class="left"> There are no tasks for this class.</div>
                                    </div>
                                </div>
                                @if($section->status == 'active')
                                    <div class="row left no-margin-bottom">
                                        <div class="input-field col s12">
                                            <a href="{{ url('teacher_curriculum') }}" class="btn orange"><i class="material-icons left">add</i>ADD TASKS</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
</div>
