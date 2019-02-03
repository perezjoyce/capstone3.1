@extends('layouts.app')
@section('main')
<main>
    @include('sidenav')
        <div class="row no-margin-bottom">
            <div class="col s12">
                
                <div class="col s12 hide-on-large-only">
                    <h5>CURRICULUM</h5>
                </div>
        
                <div class="col s12">
                    <div class="row no-margin-bottom">
                        <div class="input-field col s3">
                            <select>
                                <option value="" disabled selected>Select Grade Level</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        </div>


                        <div class="input-field col s3">
                            <select>
                                <option value="" disabled selected>Select Subject</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        </div>

                        <div class="input-field col s4 offset-s2">
                            <input id="search" placeholder="Search Course Name" class='col s8'>
                            <a class='btn orange col s4'>Search</a>  
                        </div>
                    </div>
                </div>


        
                <div class="col s12">
                    <div class="row">
                        <ul class="collapsible col s3">
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons orange-text">list_alt</i>
                                    Module
                                </div>
                              <div class="collapsible-body"><span>Topic</span></div>
                            </li>
                            
                             <li>
                                <div class="collapsible-header">
                                    <i class="material-icons orange-text">list_alt</i>
                                    Module
                                </div>
                              <div class="collapsible-body"><span>Topic</span></div>
                            </li>

                             <li>
                                <div class="collapsible-header">
                                    <i class="material-icons orange-text">list_alt</i>
                                    Module
                                </div>
                              <div class="collapsible-body"><span>Topic</span></div>
                            </li>
                        </ul>


                        <div class="col s9">
                            Chapters
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>
   
</main>
@endsection
