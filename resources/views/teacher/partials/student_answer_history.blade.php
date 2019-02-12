<div style="overflow-x: auto;">
    <div class="row" style="min-width:500px;">
    <div class="col s12 orange" style="padding:10px;">
        <div class="row no-margin-bottom">
            <div class="col s2">
                <i class="material-icons medium white-text">account_box</i>
            </div>
            <div class="col">
                <h4 class="white-text bold no-margin-bottom">{{ $user->name }}</h4>
                <div class="white-text">{{ $user->email }}</div>
            </div>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat right white-text">&#9587</a>
        </div>
    </div>

    {{--SUBJECT OVERVIEW--}}
    <div class="row center">
        <div class="col s12" style="padding:0;font-size:.9rem;">
            <br>
            @foreach($sections as $section)
                @if($section->subject->id == $subjectId)
                    <h5 class="orange-text text-darken-1">{{ $section->level->name }} - {{ $section->subject->name }}</h5>
                    <p class="orange-text text-darken-1 light">S.Y. {{ $section->school_year }}</p>
                @endif
            @endforeach
        </div>
    </div>

    {{--TOPICS LIST--}}
    <div class="col s12" style='min-height:10em;font-size:.9rem;padding:0;'>
        {{--TEACHER CAN VIEW TOPICS WITH LESSON/CHAPTER ONLY --}}
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header padding-0-sm bold grey-text text-darken-2">
                    <div class='col s1'>Item#</div>
                    <div class='col s2'>Topic</div>
                    <div class='col s2'>Purpose</div>
                    <div class='col s2'>Attempts</div>
                    <div class='col s2'>1st Take</div>
                    <div class="col s2">Highest</div>
                    <div class="col s1">Ave</div>
                    <i class="material-icons right white-text">more_vert</i>
                </div>
            </li>
        </ul>

        @foreach($sections as $section)
            @if($section->subject->id == $subjectId)
                @foreach($section->activities as $activity)
                    @if($activity->users()->where('user_id', $userId)->where('activity_id',$activity->id)->exists())
                        {{--SHOW PROGRESS OF SELECTED TOPIC IN SUBJECT--}}
                        @if($activity->id == $activityId)
                            <ul class="collapsible" data-collapsible="accordion">
                            <li class="active">
                                <div class="collapsible-header padding-0-sm">
                                    <?php
                                        $itemNumber = $loop->iteration - $loop->parent->iteration;
                                        $itemNumber = substr($itemNumber, 0, 1);
                                    ?>
                                    <div class='col s1'>{{ $itemNumber }}</div>
                                    <div class='col s2'>{{ $activity->chapter->topic->name }}</div>
                                    <div class='col s2'>{{ $activity->purpose->name }}</div>
                                    <div class='col s2'>{{  $activity->users()
                                                            ->where('user_id', $userId)
                                                            ->where('activity_id',$activity->id)
                                                            ->count() }}</div>
                                    <div class='col s2'>
                                        <div>
                                            {{  $activity->users()
                                              ->where('user_id', $userId)
                                              ->where('activity_id',$activity->id)
                                              ->first()
                                              ->pivot
                                              ->score }}
                                                /
                                            {{ $activity->number_of_items }}
                                        </div>
                                        <small>
                                            {{  $activity->users()->where('user_id', $userId)
                                            ->where('activity_id',$activity->id)
                                            ->first()
                                            ->pivot
                                            ->created_at
                                            ->format('M d, Y') }}
                                        </small>
                                    </div>
                                    <div class="col s2">
                                        {{  $activity->users()
                                               ->where('user_id', $userId)
                                               ->where('activity_id',$activity->id)
                                               ->pluck('score')->max() }}
                                        /
                                        {{ $activity->number_of_items }}
                                    </div>
                                    <div class="col s1">
                                        {{ round($activity->users()
                                           ->where('user_id', $userId)
                                           ->where('activity_id',$activity->id)
                                           ->sum('score') / ($activity->users()
                                                ->where('user_id', $userId)
                                                ->where('activity_id',$activity->id)
                                                ->count() *  $activity->number_of_items) * 100) }}%
                                    </div>
                                    <i class="material-icons right grey-text">more_vert</i>
                                </div>
                                <div class="collapsible-body custom-padding border-bottom-none">
                                    <table class="striped grey-text text-darken-1" style="font-size:.9rem;">

                                        <thead>
                                            <tr>
                                                <th style="width:10%;" class="center-align">#</th>
                                                <th style="width:50%;">Question</th>
                                                <th style="width:20%;">Correct Answer</th>
                                                <th style="width:10%;" class="center-align">Student's Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($activity->records as $record)
                                            @if($record->user_id == $userId && $record->created_at == $lastRecordedAttempt)
                                                @foreach($questions as $question)
                                                    @if($record->question_id == $question->id)
                                                        <tr>
                                                            <?php
                                                                $x = $loop->parent->iteration; //1.1, 1.2
                                                            ?>
                                                            <td class="center-align">{{ $itemNumber }}.{{$x}}</td>
                                                            <td>{!! $question->question !!}</td>
                                                            @foreach($question->choices as $choice)
                                                                @if($choice->is_correct ==1 )
                                                                    <td>{{ $choice->choice }}</td>
                                                                @endif
                                                            @endforeach
                                                            @if($record->is_correct == 1)
                                                                <td class="center-align"><i class="material-icons orange-text">check</i></td>
                                                                @else
                                                                <td class="center-align"><i class="material-icons grey-text">clear</i></td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>


    <div class="col s4" style="padding:0;">
        <br>
        <form action="student_subject_progress/{{$userId}}" method="GET">
            @csrf
            <input type="hidden" name="userId" value="{{$userId}}">
            <input type="hidden" name="subjectId" value="{{$subjectId}}">
            <input type="hidden" name="activityId" value="{{$activityId}}">
            <button type="submit"
               class="btn orange"
               data-id="{{ $userId }}"
               data-subjectid="{{ $subjectId }}"
               data-activityid="{{ $activityId }}">
                <i class="material-icons right">open_in_new</i>DETAILED ANALYSIS
            </button>
        </form>
    </div>
</div>
</div>