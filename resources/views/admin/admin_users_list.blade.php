<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_admin')
        <div class="row no-margin-bottom">
            <div class="col s12">
                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>APPROVAL</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>APPROVAL</h4>
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
                <div class="col s12 center-align">
                    <table class="striped responsive-table" style="font-size:.9rem">
                        <thead>
                        <tr>
                            <th class="grey-text text-darken-2 center-align" style="width:10%;">#</th>
                            <th class="grey-text text-darken-2">Name</th>
                            <th class="grey-text text-darken-2">Role</th>
                            <th class="grey-text text-darken-2">Email</th>
                            <th class="grey-text text-darken-2">Classes</th>
                            <th class="grey-text text-darken-2">Activities</th>
                            <th class="grey-text text-darken-2">Students</th>
                            <th class="grey-text text-darken-2">Activate</th>
                            <th class="grey-text text-darken-2" style="width:5%;"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="grey-text center-align">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if($user->role != null)
                                        {{ ucfirst($user->role) }}
                                        @else
                                        Admin
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->sections->count() }}</td>
                                <td>
                                    @if($user->role == 'student')
                                        {{ $user->activities()->count() }}
                                        @elseif($user->role == 'teacher')
                                                {{--@for($i = 0; $i < $teachers->count(); $i++)--}}
                                        <?php
                                            $count = 0;
                                        ?>
                                                    @foreach($user->sections as $section)
                                                       <?php  $count += $section->activities->count() ?>
                                                    @endforeach
                                                    {{$count}}
                                                {{--@endfor--}}
                                        @else
                                        &#8212;
                                    @endif
                                </td>
                                <td>
                                    @if($user->role == 'student')
                                        &#8212;
                                    @elseif($user->role == 'teacher')
                                        {{--@for($i = 0; $i < $teachers->count(); $i++)--}}
                                        <?php
                                        $count = 0;
                                        ?>
                                        @foreach($user->sections as $section)
                                            <?php  $count += $section->users->count() ?>
                                        @endforeach
                                        {{$count}}
                                        {{--@endfor--}}
                                    @else
                                        &#8212;
                                    @endif
                                </td>
                                <td>
                                    <form action="" method="GET" class="open-question-form_{{ $user->id }}">
                                        @csrf
                                        {{--<button class="btn orange btn-open-question-modal" data-id="{{ $user->id }}">VIEW</button>--}}
                                        <div class="switch">
                                            <label>
                                                @if($user->trashed())
                                                    <input type="checkbox" class="btn-user-status" value="{{$user->id}}">
                                                @else
                                                    <input type="checkbox" checked class="btn-user-status" value="{{$user->id}}">
                                                @endif
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    {{--MODAL TEMPLATE FOR EDITING QUESTION--}}
    <div id="modal-edit-question" class="modal">

        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>


        <div class="modal-content">
            <h4>Modal Header</h4>
            <form method="POST" action="">
                @csrf

                <div class="row">
                    <div class="col s12">
                        <h4>{{ __('Edit Discussion Modal') }}</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn light-blue">
                            <i class="material-icons right"></i>
                            {{ __('Save Changes') }}
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </div>


    {{--MODAL TEMPLATE FOR ADDING QUESTION--}}
    <div id="modal-add-question" class="modal">

        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>


        <div class="modal-content">
            <h4>Modal Header</h4>
            <form method="POST" action="">
                @csrf

                <div class="row">
                    <div class="col s12">
                        <h4>{{ __('Edit Discussion Modal') }}</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn light-blue">
                            <i class="material-icons right"></i>
                            {{ __('Save Changes') }}
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </div>


    {{--MODAL TEMPLATE FOR DELETING STUFF--}}
    <div id="delete-modal" class="modal">
        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>
        <div class="modal-content">
            <form method="POST" id="delete-modal-form">
                @csrf
                @method('delete')

                <div class="row">
                    <div class="col s12">
                        <h6 id='delete-modal-question'></h6>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn grey" id="delete-modal-btn">
                            <i class="material-icons left">delete</i>
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection







