@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_teacher')

        <div class="row no-margin-bottom" id="printThis">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>{{ $user->name }}</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>{{ $user->name }}</h4>
                    </div>
                    <div class="col s6 right">
                        <ul class="right hide-on-large-only">
                            <a href="#" data-target="slide-out" class="sidenav-trigger orange-text"><i class="material-icons white-text"><h5>menu</h5></i></a>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        @if($errors->any())
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>
                                    @foreach ($errors->all() as $error)
                                        <script>

                                            var toastHTML = '<span>{{ $error }}</span>';
                                            M.toast({html: toastHTML, classes: 'rounded'});

                                        </script>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(Session::has("successmessage"))
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>

                                    <script>

                                        var toastHTML = '<span>{{ Session::get('successmessage') }}</span>';
                                        M.toast({html: toastHTML, classes: 'rounded'});

                                    </script>
                                </ul>
                            </div>
                        @elseif(Session::has("deletemessage"))
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>
                                    <script>
                                        var toastHTML = '<span>{{ Session::get('deletemessage') }}</span>';
                                        M.toast({html: toastHTML, classes: 'rounded'});
                                    </script>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <div class="row" style="min-width:700px;">
                        {{--SUBJECT OVERVIEW--}}
                        <div class="col s12">
                            <table class="card orange lighten-4 grey-text text-darken-3 margin-top centered">
                                <thead class="border-bottom-none">
                                <tr class="border-bottom-none">
                                    <th style="width:20%">Level</th>
                                    <th style="width:20%">Subject</th>
                                    <th style="width:40%">
                                        <div class="container">
                                            Progress
                                        </div>
                                    </th>
                                    <th style="width:20%">Average</th>
                                </tr>
                                </thead>
                                <tbody class="border-bottom-none">
                                @foreach($sections as $section)
                                    @if($section->subject->id == $subjectId)
                                        <?php
                                        $done = 0;
                                        $progress = 0;
                                        $combinedAve = 0;

                                        foreach($section->activities as $activity){
                                            //check if user has accomplished task
                                            if($activity->users()->where('user_id', $userId)
                                                ->where('activity_id',$activity->id)->exists()) {

                                                //count accomplished tasks
                                                $done++;

                                                //get total score of activity
                                                $totalScorePerActivity = $activity->users()
                                                    ->where('user_id', $userId)
                                                    ->where('activity_id',$activity->id)
                                                    ->sum('score');

                                                //count total number of attempts of activity
                                                $totalNumberOfAttemptsPerActivity = $activity->users()
                                                    ->where('user_id', $userId)
                                                    ->where('activity_id',$activity->id)
                                                    ->count();

                                                //get total number of items of activity
                                                $totalNumberOfItemsPerActivity = $activity->number_of_items;

                                                //get average score in activity
                                                $avePerActivity = $totalScorePerActivity/($totalNumberOfAttemptsPerActivity*$totalNumberOfItemsPerActivity);

                                            } else{
                                                //set average score in activity to zero
                                                $avePerActivity = 0;
                                            }
                                            //get combined average per activity
                                            $combinedAve += $avePerActivity;
                                        }
                                        //count total number of activities for the class
                                        $totalActivities = $section->activities->count();

                                        if($totalActivities){
                                            $progress = ($done/$totalActivities) * 100;

                                            //get ave score of student in subject or class based on his scores in all activities
                                            $combinedAve = ($combinedAve/ $totalActivities) * 100;
                                            $combinedAve = round($combinedAve);
                                        }
                                        ?>
                                        <tr class="border-bottom-none">
                                            <td>{{ $levelName }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>
                                                <div class="container">
                                                    <div class="row no-margin-bottom">
                                                        <div class="col s12 right-align">
                                                            <small>
                                                                {{ $done }} of
                                                                {{ $totalActivities }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="progress grey lighten-4">
                                                        <div class="determinate orange darken-3" style="width:{{$progress}}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $combinedAve }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{--TOPICS LIST--}}
                        <div class="col s12 grey-text text-darken-2">
                            <br>
                            {{--TEACHER CAN VIEW TOPICS WITH LESSON/CHAPTER ONLY --}}
                            <ul class="collapsible" data-collapsible="accordion">
                                <li>
                                    <div class="collapsible-header padding-0-sm bold">
                                        <div class='col s1'>#</div>
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
                            {{--SHOW PROGRESS PER SUBJECT, REGARDLESS OF TOPIC--}}
                            @foreach($sections as $section)
                                @if($section->subject->id == $subjectId)
                                    @foreach($section->activities as $activity)
                                        @if($activity->users()->where('user_id', $userId)->where('activity_id',$activity->id)->exists())

                                                <ul class="collapsible" data-collapsible="accordion">
                                                    <li>
                                                        <div class="collapsible-header padding-0-sm">
                                                            <?php
                                                                $itemNumber = $loop->iteration - $loop->parent->iteration;
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
                                                                    <th style="width:10%;">Student's Answer</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {{--@foreach($acts as $act)--}}
                                                                        {{--@if($act->id == $activity->id)--}}
                                                                            @foreach($activity->records as $record)
                                                                                <?php
                                                                                    $attempts = $activity->users()
                                                                                        ->where('user_id', $userId)
                                                                                        ->where('activity_id',$activity->id)
                                                                                        ->count();
                                                                                    $lastRecordedAttempt = "";
                                                                                    if($attempts == 1){
                                                                                        $lastRecordedAttempt = $record->where('activity_id', '=', $activity->id)->min('created_at');
                                                                                    }else{
                                                                                        $lastRecordedAttempt = $record->where('activity_id', '=', $activity->id)->max('created_at');
                                                                                    }
                                                                                ?>
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
                                                                                                    <td><i class="material-icons orange-text">check</i></td>
                                                                                                @else
                                                                                                    <td><i class="material-icons gray-text">clear</i></td>
                                                                                                @endif
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                        {{--@endif--}}
                                                                    {{--@endforeach--}}

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </li>
                                                </ul>

                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>

                        <div class="col s12">
                            <button class="btn-large orange btn-print disabled">PRINT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
