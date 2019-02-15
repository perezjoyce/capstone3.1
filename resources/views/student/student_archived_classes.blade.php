<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_student')
        <div class="row no-margin-bottom">
            <div class="col s12">
                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>ARCHIVED CLASSES</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>ARCHIVED CLASSES</h4>
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
            </div>

            <div class="row">
                <div class="col s12 m5">
                    <div class="no-margin-bottom">
                        <div class="input-field col s12">
                            <input type="text" class="search_classes" placeholder="Search by class name" name="teacher_search" id="teacher_search">
                            <input type="hidden" name="field" value="level_class">
                            {{--<label class="active"><i class="material-icons left">search</i>Search Class Name or Grade Level</label>--}}
                            <button class="btn grey lighten-2 grey-text reload-btn">Clear</button>
                            <button class="btn green btn-teacher-search">Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section-container">
                <div class="col s12 padding-0-sm">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header border-bottom-none bold padding-0-sm">
                                <div class="col s2">Subject</div>
                                <div class="col s2">Teacher</div>
                                <div class='col s2'>Progress</div>
                                <div class='col s1 hide-on-small-only'></div>
                                <div class='col s2 tooltipped' data-position="top" data-tooltip="Average Score for Subject">
                                    Average
                                </div>

                                <i class="material-icons right white-text">timeline</i>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col s12 padding-0-sm" style='min-height:10em;'>
                    {{--TEACHER CAN VIEW TOPICS WITH LESSON/CHAPTER ONLY --}}
                    @foreach($sections as $section)
                        @foreach($teachers as $teacher)
                            {{--@if($topic->chapters->count() == 1)--}}
                            <ul class="collapsible" data-collapsible="accordion">
                                <li>
                                    <div class="collapsible-header padding-0-sm">
                                        <div class="col s2">
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



                                        <div class="col s2">
                                            {{ $teacher->name }}
                                        </div>


                                        <div class='col s2'>
                                            <div class="row no-margin-bottom">
                                                <div class="col s12 right-align">
                                                    <small>
                                                        {{ $done }} of
                                                        {{ $totalActivities }} Tasks
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="progress orange lighten-4">
                                                <div class="determinate orange" style="width:{{$progress}}%"></div>
                                            </div>
                                        </div>
                                        <div class='col s1 hide-on-small-only'></div>
                                        <div class='col s2'>{{ $combinedAve }}%</div>
                                        <i class="material-icons right grey-text">timeline</i>
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
                            {{--@endif--}}
                            @break;
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="col s12 right">
                <br>
                <br>
                <a href="student_progress" class='btn grey'>
                    <i class="material-icons left">chevron_left</i>
                    Active Classes
                </a>
            </div>
        </div>

    </main>
@endsection





