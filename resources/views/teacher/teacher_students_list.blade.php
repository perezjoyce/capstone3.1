<!DOCTYPE html>
@extends('layouts.app')
@section('main')
<main>
    @include('sidenav_teacher')

        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Students</h4>    
                </div>
                       
                
                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Students</h4>
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
                        @endif

                        @if(Session::has("successmessage"))
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
                   
                                <select class='col s12'>
                                    <option value="" disabled selected>Select Class Name</option>
                                    @foreach($sections as $section)
                                    <option value="{{ $section->id }}" onclick='showSubjects()'>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                       
                            <div class="input-field col s12">
                              <input type="text" class="validate">
                              <label><i class="material-icons left">search</i>Search Students</label>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="col s12">
                    <table class='striped highlight responsive-table'>
                        <thead>
                            <tr>
                                <th style='width:25%;'>Name</th>
                                <th style='width:25%;'>Class</th>
                                <th style='width:25%;'></th>
                                <th style='width:25%;'></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <label>
                                    <input type="checkbox" class='orange lighten-3 filled-in'/>
                                    <span onclick="{{ $student->id }}" class='black-text'> {{ $student->name }} </span>
                                    </label>
                                </td>
                                <td></td>
                                <td>
                                    <a class='grey-text text-lighten-1 dropdown-trigger' data-target='class-settings'><i class="material-icons left grey-text text-lighten-1">settings</i>Settings</a>

                                   

                                      <!-- Dropdown Structure -->
                                      <ul id='class-settings' class='dropdown-content' style='width:fit-content;'>
                                        <li><a href="#login-modal" class='modal-trigger'>Edit Name</a></li>
                                        <li><a href="#!">Change Password</a></li>
                                      </ul>
    
                                </td>
                                <td>
                                    <a href="teacher_student_account" class='btn orange'><i class="material-icons right">chevron_right</i>Details</a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
           
                <div class="col s12 right">
                    <br>
                    <br>
                    <a href="teacher_archived_sections" class='btn grey'>
                        <i class="material-icons left">delete</i>
                        Delete
                    </a>
                </div>
                

            </div>
        </div>
                    

               
   
</main>
@endsection

