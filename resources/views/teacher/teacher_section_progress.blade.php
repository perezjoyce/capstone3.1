<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_teacher')
        <div class="row no-margin-bottom">
            <div class="col s12">
                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Lesson</h4>
                </div>

                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Lesson</h4>
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


                <div class="scroll-on-small" style="overflow-y:scroll;cursor:pointer;">
                <div class="col s12 padding-0-sm">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header border-bottom-none bold padding-0-sm grey lighten-3">
                                <div class="col s2">Level</div>
                                <div class='col s3'>Subject</div>
                                <div class='col s3'>Class</div>
                                <div class='col s2'>Students</div>
                                <div class='col s2'>Activities</div>
                                <i class="material-icons right grey-text text-lighten-3">more_vert</i>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col s12 padding-0-sm" style='min-height:10em;'>
                    @foreach($sections as $section)
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header padding-0-sm">
                                    <div class="col s2">{{ $section->level->name }}</div>
                                    <div class='col s3'>{{ $section->subject->name }}</div>
                                    <div class='col s3'>{{ $section->name }}</div>
                                    <div class='col s2'>{{ $section->users->count() }}</div>
                                    <div class='col s2'>{{ $section->activities->count() }}</div>
                                    <i class="material-icons right grey-text">more_vert</i>
                                </div>
                                <div class="collapsible-body border-bottom-none">
                                    @if($section->activities->count() > 0)
                                        <div class="collapsible-header padding-0-sm center-align border-bottom-none grey lighten-2 bold" style="font-size:.9rem;">
                                            <div class="col s1">Activity #</div>
                                            <div class="col s3">Topic</div>
                                            <div class="col s2">Purpose</div>
                                            <div class="col s2">Takers</div>
                                            {{--<div class="col s1">Attempts</div>--}}
                                            <div class="col s1">Highest</div>
                                            <div class="col s1">Lowest</div>
                                            <div class="col s2">Average</div>
                                            <i class="material-icons right grey-text text-lighten-2">more_vert</i>
                                        </div>
                                    @else
                                        <div class="collapsible-header padding-0-sm center-align border-bottom-none" style="font-size:.9rem;">
                                            <div class="col s12">
                                                <p>You have no assigned tasks for this class.</p>
                                                <a href="{{ url('teacher_curriculum') }}" class="btn orange margin-top">Go To Curriculum</a>

                                            </div>

                                        </div>
                                    @endif
                                    <ul class="collapsible" data-collapsible="accordion" style="font-size:.9rem;">
                                        @foreach($section->activities as $activity)
                                            @if($activity->users()->where('activity_id',$activity->id)->distinct()->count('user_id') > 0)
                                                <li>
                                                    <div class="collapsible-header padding-0-sm border-bottom-none">
                                                        <div class="col s1 center-align">{{ $loop->iteration }}</div>
                                                        <div class="col s3 center-align">{{ $activity->chapter->topic->name }}</div>
                                                        <div class="col s2 center-align">{{ $activity->purpose->name }}</div>
                                                        <div class="col s2 center-align">{{  $activity->users()->where('activity_id',$activity->id)->distinct()->count('user_id') }}</div>
                                                        {{--<div class="col s1 center-align">{{  $activity->users()->where('activity_id',$activity->id)->count() }}</div>--}}
                                                        <div class="col s1 center-align">{{ $activity->users()->where('activity_id',$activity->id)->pluck('score')->max() }} of {{ $activity->number_of_items }}</div>
                                                        <div class="col s1 center-align">{{ $activity->users()->where('activity_id',$activity->id)->pluck('score')->min() }} of {{ $activity->number_of_items }}</div>
                                                        <div class="col s2 center-align">{{ round($activity->users()->where('activity_id',$activity->id)->sum('score') / ($activity->users()->where('activity_id',$activity->id)->count() *  $activity->number_of_items) * 100) }}%</div>
                                                        <i class="material-icons right grey-text">more_vert</i>
                                                    </div>
                                                    <div class="collapsible-body border-bottom-none">
                                                        <table class="responsive-table highlight grey-text text-darken-3">
                                                            <thead class="grey lighten-1">
                                                            <tr>
                                                                <th style="width:5%"></th>
                                                                <th style="width:20%">Student</th>
                                                                <th style="width:20%">Attempts</th>
                                                                <th style="width:20%">Average Score</th>
                                                                <th style="width:10%"><i class="material-icons right grey-text text-lighten-1">more_vert</i></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($activity->users->unique() as $user)
                                                                <tr>
                                                                    <td></td>
                                                                    <td>{{ $user->name }}</td>
                                                                    <td>{{ $activity->users()
                                                                        ->where('user_id', $user->id)
                                                                        ->where('activity_id',$activity->id)
                                                                        ->count() }} of
                                                                        {{ $activity->users()->where('activity_id',$activity->id)->count() }}
                                                                    </td>
                                                                    <td>
                                                                        {{ round($activity->users()
                                                                            ->where('user_id', $user->id)
                                                                            ->where('activity_id',$activity->id)
                                                                            ->sum('score') / ($activity->users()
                                                                            ->where('user_id', $user->id)
                                                                            ->where('activity_id',$activity->id)
                                                                            ->count() *  $activity->number_of_items) * 100) }}%
                                                                    </td>
                                                                    <td><a href="#!" class="orange waves-effect waves-light btn btn-view-progress" data-id="{{ $user->id }}" data-subjectid="{{ $section->subject->id }}">VIEW</a></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>

            </div>
        </div>
    </main>
@endsection


{{--STUDENT'S PROGRESS--}}
<div id="progress-modal" class="modal">
    <div class="row">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
    </div>
</div>



