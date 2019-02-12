<div class="row" style="min-width:500px;overflow-x:auto;">
    <div class="col s12 orange" style="padding:10px;">
        <div class="row no-margin-bottom">
            <div class="col l1 m2 s2">
                <i class="material-icons medium white-text">account_box</i>
            </div>
            <div class="col">
                <h4 class="white-text bold no-margin-bottom">{{ $user->name }}</h4>
                <div class="white-text">{{ $user->email }}</div>
            </div>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat right white-text">&#9587</a>
        </div>
    </div>

    </div>

    <div class="col s12 padding-0-sm">
        <ul class="collapsible" data-collapsible="accordion">
            <li class="active">
                <div class="collapsible-header border-bottom-none bold padding-0-sm">
                    <div class="col s3">Subject</div>
                    <div class='col s3'>Progress</div>
                    <div class='col s1 hide-on-small-only'></div>
                    <div class='col s2 tooltipped' data-position="top" data-tooltip="Average Score for Subject">
                        Average
                    </div>

                    <i class="material-icons right white-text">more_vert</i>
                </div>
            </li>
        </ul>
    </div>

    <div class="col s12 padding-0-sm" style='min-height:10em;'>
        {{--TEACHER CAN VIEW TOPICS WITH LESSON/CHAPTER ONLY --}}
        @foreach($sections as $section)
            @if($section->subject->id == $subjectId)
            <ul class="collapsible" data-collapsible="accordion">
                <li class="active">
                    <div class="collapsible-header padding-0-sm">
                        <div class="col s3">
                            {{ $section->subject->name }}
                        </div>
                        {{--TRANSFER THIS TO STUDENT CONTROLLER: showProgress() --}}
                        <?php
                        $done = 0;
                        $progress = 0;
                        $combinedAve = 0;
                        //                                        39/(12*6)*100
                        //                                        39 = total score
                        //                                        12 = total attempts
                        //                                        6 = total items

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
                        {{--END --}}

                        <div class='col s3'>
                            <div class="row no-margin-bottom">
                                <div class="col s12 right-align">
                                    <small>
                                        {{ $done }} of
                                        {{ $totalActivities }}
                                    </small>
                                </div>
                            </div>
                            <div class="progress orange lighten-4">
                                <div class="determinate orange" style="width:{{$progress}}%"></div>
                            </div>
                        </div>
                        <div class='col s1 hide-on-small-only'></div>
                        <div class='col s2'>{{ $combinedAve }}%</div>
                        <i class="material-icons right grey-text">more_vert</i>
                    </div>
                    <div class="collapsible-body custom-padding border-bottom-none">
                        <table class="striped responsive-table grey-text text-darken-1" style="font-size:.8rem;">
                            @if($progress)
                                <thead>
                                <tr>
                                    <th style="width:10%;" class="center-align">#</th>
                                    <th style="width:30%;">Topic</th>
                                    <th style="width:10%;">Purpose</th>
                                    <th style="width:10%;">Attempts</th>
                                    <th style="width:10%;">First Take</th>
                                    <th style="width:10%;">Highest</th>
                                    <th style="width:10%;" class='tooltipped' data-position="top" data-tooltip="Average Score for Topic">
                                        Average
                                    </th>

                                </tr>
                                </thead>
                            @endif
                            <tbody>
                            @foreach($section->activities as $activity)
                                @if($activity->users()->where('user_id', $userId)->where('activity_id',$activity->id)->exists())
                                    <tr>
                                        <td class="center-align">{{ $loop->iteration }}</td>
                                        <td>
                                            <div>{{ $activity->chapter->topic->name }}</div>
                                        </td>
                                        <td>{{ $activity->purpose->name }}</td>


                                        <td>{{  $activity->users()
                                                                ->where('user_id', $userId)
                                                                ->where('activity_id',$activity->id)
                                                                ->count() }}
                                        </td>
                                        <td>
                                            <div>
                                                {{  $activity->users()
                                                   ->where('user_id', $userId)
                                                   ->where('activity_id',$activity->id)
                                                   ->first()
                                                   ->pivot
                                                   ->score }}
                                                out of
                                                {{ $activity->number_of_items }}
                                            </div>
                                            <div class="grey-text">
                                                {{  $activity->users()->where('user_id', $userId)
                                                    ->where('activity_id',$activity->id)
                                                    ->first()
                                                    ->pivot
                                                    ->created_at
                                                    ->format('M d, Y') }}
                                            </div>
                                        </td>
                                        <td>

                                            {{  $activity->users()
                                               ->where('user_id', $userId)
                                               ->where('activity_id',$activity->id)
                                               ->pluck('score')->max() }}
                                            out of
                                            {{ $activity->number_of_items }}
                                        </td>
                                        <td>

                                            {{--39/(12*6)*100--}}
                                            {{ round($activity->users()
                                               ->where('user_id', $userId)
                                               ->where('activity_id',$activity->id)
                                               ->sum('score') / ($activity->users()
                                                    ->where('user_id', $userId)
                                                    ->where('activity_id',$activity->id)
                                                    ->count() *  $activity->number_of_items) * 100) }}%
                                        </td>



                                    </tr>
                                @else
                                    <tr>
                                        <td class="center-align">{{ $loop->iteration }}</td>
                                        <td>
                                            <div>{{ $activity->chapter->topic->name }}</div>
                                        </td>
                                        <td>{{ $activity->purpose->name }}</td>
                                        <td>0</td>
                                        <td>&#8212;</td>
                                        <td>&#8212;
                                        </td>
                                        <td>0%</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
            @endif
        @endforeach
    </div>
</div>
