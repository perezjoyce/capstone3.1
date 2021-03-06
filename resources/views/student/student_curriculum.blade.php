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
                <div class="row">
                    <div class="col s12">
                        <table class='striped centered responsive-table grey-text text-darken-3'>
                            <thead>
                                <tr>
                                    <th style='width:10%;'></th>
                                    <th style='width:20%;'>Subject</th>
                                    <th style='width:20%;'>Topic</th>
                                    <th style='width:15%;'>Purpose</th>
                                    <th style='width:20%;'>Deadline</th>
                                    <th style='width:20%;'></th>
                                </tr>
                            </thead>
                            <tbody class="light">
                            @foreach($sections as $section)
                                @foreach($section->activities as $activity)

                                    <tr>
                                        <td>
                                            @if($activity->users()->where('user_id', $userId)->where('activity_id',$activity->id)->exists())
                                                <i class="material-icons grey-text">done</i>
                                            @else
                                                @if(strpos($activity->deadline->diffForHumans(), 'week') === TRUE && strpos($activity->deadline->diffForHumans(), 'ago') == FALSE)
                                                    <i class="material-icons grey-text">access_alarm</i>
                                                @elseif(stripos($activity->deadline->diffForHumans(), 'days') == TRUE && strpos($activity->deadline->diffForHumans(), 'ago') == FALSE)
                                                    <i class="material-icons grey-text">access_alarm</i>
                                                @elseif(stripos($activity->deadline->diffForHumans(), 'hours') == TRUE && strpos($activity->deadline->diffForHumans(), 'ago') == FALSE)
                                                    <i class="material-icons grey-text">access_alarm</i>
                                                @elseif(stripos($activity->deadline->diffForHumans(), 'minutes') == TRUE && strpos($activity->deadline->diffForHumans(), 'ago') == FALSE)
                                                    <i class="material-icons grey-text">access_alarm</i>
                                                @elseif(stripos($activity->deadline->diffForHumans(), 'seconds') == TRUE && strpos($activity->deadline->diffForHumans(), 'ago') == FALSE)
                                                    <i class="material-icons grey-text">access_alarm</i>
                                                @elseif(stripos($activity->deadline->diffForHumans(), 'ago') == TRUE)
                                                    <i class="material-icons red-text text-lighten-2">assignment_late</i>
                                                @else
                                                    <i class="material-icons white-text text-lighten-5">access_alarm</i>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                           {{ $section->subject->name }}
                                        </td>
                                        <td>{{ $activity->chapter->topic->name }}</td>
                                        <td>{{ $activity->purpose->name }}</td>

                                        <td>
                                            <div class="check-if-due-asap">{{ $activity->deadline->diffForHumans() }}</div>
                                            <small class="grey-text">{{ $activity->deadline->format('M d, Y') }}</small>
                                        </td>
                                        <td>
                                            <a href="student_lesson/{{ $activity->chapter->topic->id }}?activity={{$activity->id}}" target='_blank' class='btn orange open-activity' data-activityid="{{ $activity->id }}"><i class="material-icons right white-text">open_in_new</i>OPEN</a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection





