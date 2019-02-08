<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_student')
        <div class="row no-margin-bottom">
            <div class="col s12">


                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>TASKS</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>TASKS</h4>
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


        <div>
            <p>
                next task: teacher class progress.
            </p>
            <p>
                then, individual student progress. THIS WILL BE THE STUDENTS PROFILE WHEN VIEWED BY TEACHER. BUT LIMITED TO TEACHER'S SUBJECT and with two tabs- active and archived
            </p>
            <p>
                then, THIS WILL BE THE STUDENTS PROFILE AS IS WHEN VIEWED BY ADMIN with additional column for status - active and archived
            </p>

        </div>

        <div class="col s12 padding-0-sm">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
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
                {{--@if($topic->chapters->count() == 1)--}}
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header padding-0-sm">
                                <div class="col s3">
                                    {{ $section->subject->name }}
                                </div>
                                {{--TRANSFER THIS TO STUDENT CONTROLLER: showProgress() --}}
                                    <?php
                                        $done = 0;
                                        $progress = 0;
                                        $combinedAve = 0;
                                        foreach($section->activities as $activity){
                                            if($activity->users()->where('user_id', $userId)
                                                ->where('activity_id',$activity->id)->exists()) {
                                                $done++;

                                                $combinedAve += $activity->users()
                                                   ->where('user_id', $userId)
                                                   ->where('activity_id',$activity->id)
                                                   ->pluck('score')->avg();
                                            }
                                        }

                                        $totalActivities = $section->activities->count();
                                        if($totalActivities){
                                            $progress = ($done/$totalActivities) * 100;
                                            $combinedAve = ($combinedAve/ $totalActivities) * 100;
                                        }



//                                        dd($combinedAve);
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
                                                    {{  $activity->users()
                                                       ->where('user_id', $userId)
                                                       ->where('activity_id',$activity->id)
                                                       ->pluck('score')->avg()*100 }}%
                                                </td>



                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                {{--@endif--}}
            @endforeach
        </div>





    </main>
@endsection





