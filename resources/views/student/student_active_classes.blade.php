<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_student')

        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Active Classes</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Active Classes</h4>
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

                <div class="col s12" id="section-container">
                    <table class='striped responsive-table'>
                        <thead>
                        <tr>
                            <th style='width:5%;'></th>
                            <th style='width:20%;'>Subject</th>
                            <th style='width:20%;'>Teacher</th>
                            <th style='width:15%;'>Class Code</th>
                            {{--<th style='width:15%;'></th>--}}
                            <th style='width:15%;'></th>
                        </tr>
                        </thead>

                        <tbody>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach($sections as $section)
                            @if($section->status != 'archived')
                                <tr>
                                    <td></td>
                                    @foreach($teachers as $teacher)
                                      <td>{{ $teacher->name }}</td>
                                    @endforeach
                                    <td>{{ $section->access_code }}</td>
                                    <td>
                                        <a href="#!" data-id="{{ $section->id }}" class='btn orange btn-view-class-list'>
                                            <i class="material-icons">supervisor_account</i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>



                <div class="col s12 right">
                    <br>
                    <br>
                    <a href="student_archived_classes" class='btn grey'>
                        <i class="material-icons left">chevron_left</i>
                        Archived Classes
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

