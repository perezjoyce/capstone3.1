<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_teacher')
        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Archived Classes</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Archived Classes</h4>
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

                {{--<div class="row">--}}
                    {{--<div class="col s12 m5">--}}
                        {{--<div class="no-margin-bottom">--}}
                            {{--<div class="input-field col s12">--}}
                                {{--<input type="text" class="validate">--}}
                                {{--<label><i class="material-icons left">search</i>Search Archived Classes</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="col s12">
                    <table class='striped highlight responsive-table'>
                        <thead>
                        <tr>
                            <th style='width:3%;'></th>
                            <th style='width:20%;'>Class</th>
                            <th style='width:15%;'>Subject</th>
                            <th style='width:15%;'>School Year</th>
                            <th style='width:15%;'>Class Code</th>
                            <th style='width:15%;'></th>
                            <th style='width:17%;'></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($sections as $section)
                            {{--@if($section->status == 'archived')--}}
                                <tr>
                                    <td></td>
                                    <td id='{{ $section->id }}'>{{ $section->level->name }} - {{ $section->name }}</td>
                                    <td>{{ $section->subject->name }}</td>
                                    <td>{{ $section->school_year }}</td>
                                    <td>{{ $section->access_code }}</td>
                                    <td>
                                            <a class='grey-text text-lighten-1 dropdown-trigger tooltipped' data-target='class-settings{{$section->id}}' data-position="left" data-tooltip="Settings">
                                            <i class="material-icons left grey-text text-lighten-1">settings</i>
                                            </a>

                                            <ul id='class-settings{{$section->id}}' class='dropdown-content' style='width:fit-content;'>
                                                <li>
                                                <a href="#!" class='btn-open-edit-class-modal'
                                                    data-id="{{ $section->id }}"
                                                    data-name="{{ $section->name }}">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#!" class='btn-open-delete-class-modal'
                                                        data-id="{{ $section->id }}"
                                                        data-name="{{ $section->name }}"
                                                        data-level="{{ $section->level->name }}"
                                                    >Delete</a>
                                                </li>
                                            </ul>
                                    </td>
                                    <td>
                                        <a href="#!" data-id="{{ $section->id }}" class='btn orange btn-view-class-list'><i class="material-icons">supervisor_account</i></a>
                                    </td>
                                </tr>
                            {{--@endif--}}
                        @endforeach

                        </tbody>
                    </table>
                </div>



                <div class="col s12 right">
                    <br>
                    <br>
                    <a href="teacher_sections" class='btn grey'>
                        <i class="material-icons left">archive</i>
                       Active Classes
                    </a>
                </div>


            </div>
        </div>
    </main>


    {{--CLASS LIST--}}
    <div id="class-list-modal" class="modal">
        <div class="row">
            <div class="modal-content">
                <h4></h4>
                <p></p>
            </div>
        </div>
    </div>

    {{--MODAL TEMPLATE FOR DELETING STUFF--}}
    <div id="delete-class-modal" class="modal modal-small">
        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>
        <div class="modal-content">
            <form method="POST" id="delete-class-modal-form">
                @csrf
                @method('delete')

                <div class="row">
                    <div class="col s12">
                        <h5 class="red-text">Delete A Class</h5>
                        <br>
                        <p id='delete-class-modal-question'></p>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn grey" id="delete-class-modal-btn">
                            <i class="material-icons left">delete</i>
                            {{ __('Delete Class') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

