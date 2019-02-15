<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_admin')
        <div class="row no-margin-bottom">
            <div class="col s12">
                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>DASHBOARD</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>DASHBOARD</h4>
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
                    <div class="col s12 m12 l6">
                        <blockquote style="border-left:5px solid orange!important;">
                            <h5 class="light grey-text text-darken-2">“There are no shortcuts to any place worth going.” – Beverly Sills</h5>
                        </blockquote>
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col s12 center-align">
                        <div class="row">
                            <br>
                            <div class="col s12 center-align">
                                <div class="row">
                                    <div class="btn-flat red-text text-lighten-2 bold" style="font-size:1.3rem;">
                                        REPORTED ERRORS
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="striped responsive-table" style="font-size:.9rem">
                            <thead>
                                <tr>
                                    <th class="grey-text text-darken-2 center-align" style="width:5%;">#</th>
                                    <th class="grey-text text-darken-2" style="width:35%;">Topic</th>
                                    <th class="grey-text text-darken-2">Subject</th>
                                    <th class="grey-text text-darken-2">Area</th>
                                    <th class="grey-text text-darken-2">Reports</th>
                                    <th class="grey-text text-darken-2">Status</th>
                                    <th class="grey-text text-darken-2" style="width:5%;"></th>

                                </tr>
                            </thead>
                            <tbody>
                            @for($i =0; $i < $pending_reports->count(); $i++)
                                <tr>
                                    <td class="grey-text center-align">{{ $i+1 }}</td>
                                    <td>
                                        <a href="admin_lesson/{{$pending_reports[$i]->chapter_id}}" target="_blank">{{ $pending_reports[$i]->chapter->topic->name }}</a></td>
                                    <td>
                                        <div class="grey-text text-darken-2">
                                            {{ $pending_reports[$i]->chapter->topic->level->name }}
                                        </div>
                                        <span class="grey-text">{{ $pending_reports[$i]->chapter->topic->module->subject->name }}</span>
                                    </td>
                                    <td class="grey-text text-darken-2">{{ ucfirst($pending_reports[$i]->field) }}</td>
                                    <td class="grey-text text-darken-2">{{ $report_count[$i] }}</td>
                                    <td>
                                        <form method="post" action="">
                                            @csrf
                                            <input type="hidden" value="{{ $pending_reports[$i]->chapter_id }}" name="reported_chapter">
                                            <input type="hidden" value="{{ $pending_reports[$i]->field }}" name="reported_field">
                                            <select class="browser-default report-status"
                                                    data-chapterid="{{ $pending_reports[$i]->chapter_id }}"
                                                    data-field="{{ $pending_reports[$i]->field }}"
                                                    data-topic="{{ $pending_reports[$i]->chapter->topic->name }}"
                                                    data-level="{{ $pending_reports[$i]->chapter->topic->level->name }}"
                                                    data-subject="{{ $pending_reports[$i]->chapter->topic->module->subject->name }}"
                                            >
                                                <option value="pending" selected name="report-status">Pending</option>
                                                <option value="completed" name="report-status">Completed</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td></td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>

                    {{--<div class="col s12 m12 l4 center-align">--}}
                        {{--<div class="container z-depth-4 background-container-color">--}}
                            {{--<br>--}}
                            {{--<table class="centered grey-text text-darken-1">--}}
                                {{--<thead>--}}
                                    {{--<tr class="border-bottom-none">--}}
                                        {{--<th style="font-size:1.3rem;" class="orange-text text-lighten-1">STATS</th>--}}
                                    {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody style="font-size:.9rem;">--}}
                                    {{--<tr class="border-bottom-none">--}}
                                        {{--<td>--}}
                                            {{--<i class="fas fa-chalkboard-teacher fa-2x orange-text text-lighten-2"></i>--}}
                                            {{--<p class="no-margin-bottom">23 Teachers</p>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr class="border-bottom-none">--}}
                                        {{--<td>--}}
                                            {{--<i class="small material-icons orange-text text-lighten-2">people</i>--}}
                                            {{--<div>500 Students</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr class="border-bottom-none">--}}
                                        {{--<td>--}}
                                            {{--<i class="fas fa-book-open fa-2x orange-text text-lighten-2"></i>--}}
                                            {{--<p class="no-margin-bottom">1,000 lessons</p>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr class="border-bottom-none">--}}
                                        {{--<td>--}}
                                            {{--<i class="fas fa-list ol fa-2x orange-text text-lighten-2"></i>--}}
                                            {{--<p class="no-margin-bottom">5,000 Tasks Items</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                            {{--<br>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 align-left">
                        {{--values are set to one because i don't use them at the moment--}}
                        <button class="btn green lighten-1" id="btn-view-completed-reports"
                                data-chapterid="1"
                                data-field="1">
                            view completed
                        </button>
                    </div>
                </div>

            <a href="#view-own-profile" class="btn-floating btn-large waves-effect waves-light orange modal-trigger right" style="position:fixed;bottom:30px;right:30px;"><i class="material-icons">edit</i></a>
            </div>
        </div>
    </main>

    {{--VIEW AND EDIT ACCOUNT MODAL--}}
    <div id="view-own-profile" class="modal modal-small">
        <div class="row">
            <div class="modal-content">
                <h5 class="orange-text bold">Your Account Details</h5>
                <br>
                <form action="editProfile/{{$owner->id}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="input-field">
                        <label for="owner_name" class="active">Name</label>
                        <input type="text" value="{{ $owner->name }}" id="owner_name" name="name" required>
                    </div>
                    <div class="input-field">
                        <label for="owner_username" class="active">Username</label>
                        <input type="text" value="{{ $owner->username }}" id="owner_username" name="username" required>
                    </div>
                    <div class="input-field">
                        <label for="owner_email" class="active">Email</label>
                        <input type="email" value="{{ $owner->email }}" id="owner_email" name="email" required>
                    </div>
                    <a href="#edit-own-password" class="btn orange lighten-3 modal-trigger" style="margin-top:15px;">Change Password</a>
                    <button class="btn orange" style="margin-top:15px;">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    {{--VIEW AND EDIT PASSWORD MODAL--}}
    <div id="edit-own-password" class="modal modal-small">
    <div class="row">
        <div class="modal-content">
            <h5 class="red-text bold text-lighten-2">Change Password</h5>
            <br>
            <form action="changePassword/{{$owner->id}}" method="POST">
                @csrf
                @method('put')
                <div class="input-field">
                    <input type="text" id="owner_password" name="password" placeholder="" required>
                </div>
                <button class="btn red lighten-2" style="margin-top:15px;">Save New Password</button>
            </form>
        </div>
    </div>
</div>

@endsection









