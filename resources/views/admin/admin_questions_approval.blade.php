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
                            <th class="grey-text text-darken-2 center-align" style="width:5%;">#</th>
                            <th class="grey-text text-darken-2">Level</th>
                            <th class="grey-text text-darken-2">Subject</th>
                            <th class="grey-text text-darken-2">Module</th>
                            <th class="grey-text text-darken-2">Topic</th>
                            <th class="grey-text text-darken-2">Contributor</th>
                            <th class="grey-text text-darken-2"></th>
                            <th class="grey-text text-darken-2" style="width:5%;"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td class="grey-text center-align">{{ $loop->iteration }}</td>
                                <td>{{ $question->chapter->topic->level->name }}</td>
                                <td>{{ $question->chapter->topic->module->subject->name }}</td>
                                <td>{{ $question->chapter->topic->module->name }}</td>
                                <td>
                                    <a href="admin_lesson/{{ $question->chapter->id }}" target="_blank">
                                        {{ $question->chapter->topic->name }}
                                    </a>
                                </td>
                                <td class="grey-text text-darken-2"> {{ $question->user->name }}</td>
                                <td>
                                    <form action="" method="GET" class="open-question-form_{{ $question->id }}">
                                        @csrf
                                        <button class="btn orange btn-open-question-modal" data-id="{{ $question->id }}">VIEW</button>
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col s12 align-left">
                    {{--values are set to one because i don't use them at the moment--}}
                    <button class="btn green lighten-1" id="btn-view-approved_questions"
                            data-chapterid="1"
                            data-field="1">
                        <i class="material-icons left">undo</i>
                        undo approve
                    </button>
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







