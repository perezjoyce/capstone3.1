<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_student')
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

                <div class="col s12 m8 l6 center-align">
                    <blockquote style="border-left:5px solid orange!important;">
                        <h5 class="light grey-text text-darken-2">“Strive for progress, not perfection.” – Unknown</h5>
                    </blockquote>
                    <div class="row">
                        <br>
                        <div class="col s12 no-pad-bot">
                            <div class="container">
                                <div class="row">
                                    <table class="card striped grey-text text-darken-2 background-container-color">
                                        <thead>
                                        <tr>
                                            <th style="padding:40px;">
                                                <div class="center">
                                                    <a href="#!" class="btn-flat orange-text" style="font-size:1.3rem;">
                                                        NOTIFICATIONS</a>
                                                    <div class="light orange-text light">Recently posted tasks</div>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($activities as $activity)

                                            <tr>
                                                <td style="padding:20px;font-size:.9rem;">
                                                    <i class="material-icons left orange-text text-lighten-2">notifications</i>
                                                    <a class="heavy" href="student_lesson/{{$activity->chapter->topic->id}}?activity={{$activity->id}}" target="_blank">{{ $activity->section->subject->name }}
                                                        {{ $activity->purpose->name }}</a>
                                                    <span class="light">due {{ $activity->deadline->diffForHumans() }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4 l6" id="student-dashboard-image">
                </div>

                <a href="#student-modal" class="btn-floating btn-large waves-effect waves-light green modal-trigger right" style="position:fixed;bottom:20px;right:100px;"><i class="material-icons">group_add</i></a>
                <a href="#view-own-profile" class="btn-floating btn-large waves-effect waves-light orange modal-trigger right" style="position:fixed;bottom:20px;right:20px;"><i class="material-icons">edit</i></a>
            </div>
        </div>
    </main>
@endsection

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









