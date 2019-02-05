<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_teacher')
        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Curriculum</h4>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Curriculum</h4>
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
                        <form action="/teacher_curriculum/showTopics" method="POST" id="topic-filter-form">
                            @csrf

                            <div class="no-margin-bottom">

                                <div class="input-field col s12">
                                    <select name="level">
                                        <option value="" disabled selected>Select Grade Level</option>
                                        @foreach($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="input-field col s12">
                                    <select name="subject" id="selected-subject">
                                        <option value="" disabled selected>Select Subject</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="input-field col s12" id="module-options">
                                    <select name="module">
                                        <option value="" disabled selected>Select Module</option>
                                        @foreach($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="input-field col s12">
                                <button class='btn right orange' type="submit">
                                    LOAD TOPICS
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row" id='topic_container'>


                </div>





                <!--  <div class="row">
                    <div class="col s12">
                        <br>
                        <ul class="tabs tabs-fixed-width tab-demo z-depth-0">
                            <li class="tab"><a href="#grade_levels">Category & Grade Levels</a></li>
                            <li class="tab"><a href="#subject_listing">Subjects</a></li>
                            <li class="tab"><a href="#module_listing">Modules</a></li>
                            <li class="tab"><a href="#topic_listing">Topics</a></li>
                            <li class="tab"><a href="#chapter_content" class='active'>Chapters</a></li>
                        </ul>
                    </div>
                 </div> -->


            <!--  <div class="row" id='grade_levels'>
                    <div class="col s12">

                        <table>
                            <tbody>
                                @foreach($levels as $level)
                <tr>
                    <td class='vertical-align-initial'>{{ $level->name }}</td>
                                    <td>
                                        <div>
                                             <table class='inner'>
                                                <tbody>
                                                    @foreach($subjects as $subject)
                    <tr>
                        <td style='padding:0;' class='vertical-align-initial'>

                            <ul class="collapsible" data-collapsible="accordion">
                                <li>
                                    <div class="collapsible-header vertical-align-initial" style='padding:0;'>
{{ $subject->name }}
                            </div>
                            <div class="collapsible-body custom-padding border-bottom-none">
                                <table>
                                    <tbody>
@foreach($subject->modules as $module)
                        <tr>
                            <td class='vertical-align-initial'>
                                <ul class="collapsible" data-collapsible="accordion">
                                    <li>
                                        <div class="collapsible-header vertical-align-initial" style='padding:0;'>
{{ $module->name }}
                                </div>
                                <div class="collapsible-body custom-padding border-bottom-none">
                                    <table class='inner responsive-table'>
                                        <tbody>

@foreach($module->topics as $topic)
                            @if($level->id == $topic->level_id)
                                <tr class='border-bottom-none'>

                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li>
                                            <div class="collapsible-header vertical-align-initial" style='padding:0;'>
                                                <span class='bold'>Topic:&nbsp;</span>
                                                                                                                             {{ $topic->name }}
                                        </div>
                                        <div class="collapsible-body custom-padding">
                                            <button class='btn orange'>Update</button>
                                            <button class='btn orange lighten-3'>Delete</button>
                                        </div>
                                    </li>
                                </ul>

                            </tr>

@endif
                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </td>
        </tr>
@endforeach
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </td>
    </tr>
@endforeach
                        </tbody>
                    </table>

                </div>
            </td>

            <td>

            </td>

        </tr>
@endforeach
                    </tbody>
                </table>
             </div>
         </div>

         <div class="container" id='subject_listing'>

                         <div class="col s12">
                             <ul class="collapsible" data-collapsible="accordion">

@foreach($levels as $level)
                <li class='active'>
                    <div class="collapsible-header">
                        <span class='bold'>Level:&nbsp;</span>
                                                <span>{{ $level->name }}</span>
                                            </div>
                                            <div class="collapsible-body custom-padding">
                                                <ul class="collapsible" data-collapsible="accordion">
                                                    @foreach($subjects as $subject)
                    <li class='active'>
                        <div class="collapsible-header">
                            <span class='bold'>Subject {{ $subject->id }}:&nbsp;</span>
                                                            <span>{{ $subject->name }}</span>
                                                        </div>
                                                        <div class="collapsible-body custom-padding">
                                                            <ul class="collapsible" data-collapsible="accordion">
                                                                @foreach($subject->modules as $module)
                        <li class='active'>
                            <div class="collapsible-header">
                                <span class='bold'>Module:&nbsp;</span>
                                                                        <span>{{ $module->name }}</span>
                                                                    </div>
                                                                    <div class="collapsible-body border-bottom-none custom-padding">
                                                                            <table class='inner responsive-table'>
                                                                                <tbody>

                                                                                    @foreach($module->topics as $topic)
                            @if($level->id == $topic->level_id)
                                <tr class='border-bottom-none'>

                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li class='active'>
                                            <div class="collapsible-header">
                                                <span class='bold'>Topic:&nbsp;</span>
                                                                                                     {{ $topic->name }}
                                        </div>
                                        <div class="collapsible-body custom-padding">
                                            <button class='btn orange'>Update</button>
                                            <button class='btn orange lighten-3'>Delete</button>
                                        </div>
                                    </li>
                                </ul>

                            </tr>

@endif
                        @endforeach
                                </tbody>

                            </table>



                    </div>
                </li>
@endforeach
                            </ul>
                        </div>
                    </li>
@endforeach
                        </ul>
                    </div>

                </li>
@endforeach
                    </ul>



                </div>

</div>

<div class="container" id='module_listing'>
   <div class="col s12">
                    <ul class="collapsible" data-collapsible="accordion">

@foreach($levels as $level)
                <li class='active'>
                    <div class="collapsible-header">
                        <span class='bold'>Level:&nbsp;</span>
                                                <span>{{ $level->name }}</span>
                                            </div>
                                            <div class="collapsible-body custom-padding">
                                                <ul class="collapsible" data-collapsible="accordion">
                                                    @foreach($subjects as $subject)
                    <li class='active'>
                        <div class="collapsible-header">
                            <span class='bold'>Subject {{ $subject->id }}:&nbsp;</span>
                                                            <span>{{ $subject->name }}</span>
                                                        </div>
                                                        <div class="collapsible-body custom-padding">
                                                            <ul class="collapsible" data-collapsible="accordion">
                                                                @foreach($subject->modules as $module)
                        <li>
                            <div class="collapsible-header">
                                <span class='bold'>Module:&nbsp;</span>
                                                                        <span>{{ $module->name }}</span>
                                                                    </div>
                                                                    <div class="collapsible-body border-bottom-none custom-padding">
                                                                            <table class='inner responsive-table'>
                                                                                <tbody>

                                                                                    @foreach($module->topics as $topic)
                            @if($level->id == $topic->level_id)
                                <tr class='border-bottom-none'>

                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li class='active'>
                                            <div class="collapsible-header">
                                                <span class='bold'>Topic:&nbsp;</span>
                                                                                                     {{ $topic->name }}
                                        </div>
                                        <div class="collapsible-body custom-padding">
                                            <button class='btn orange'>Update</button>
                                            <button class='btn orange lighten-3'>Delete</button>
                                        </div>
                                    </li>
                                </ul>

                            </tr>

@endif
                        @endforeach
                                </tbody>

                            </table>



                    </div>
                </li>
@endforeach
                            </ul>
                        </div>
                    </li>
@endforeach
                        </ul>
                    </div>

                </li>
@endforeach
                    </ul>



                </div>
</div>

 <div class="row" id='topic_listing'>
    <div class="col s4">

        <div class="no-margin-bottom">
            <div class="input-field col l12 m3 s12">
                <select>
                    <option value="" disabled selected>Select Grade Level</option>
@foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                    </select>
                </div>


                <div class="input-field col l12 m3 s12">
                    <select>
                        <option value="" disabled selected>Select Subject</option>
@foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                    </select>
                </div>



                <div class="input-field col l12 m6 s12">
                    <select>
                        <option value="" disabled selected>Select Module</option>
@foreach($modules as $module)
                <option value="{{ $subject->id }}">{{ $module->name }}</option>
                                    @endforeach
                    </select>
                </div>



                 <div class="input-field col l12 m6 s12">
                    <select>
                        <option value="" disabled selected>Select Topic</option>
@foreach($topics as $topic)
                <option value="{{ $subject->id }}">{{ $topic->name }}</option>
                                    @endforeach
                    </select>
                </div>


            </div>

            <ul class="collapsible col l12 m4 s12">
@foreach($modules as $module)
                <li>

                    <div class="collapsible-header" id='{{ $module->name }}'>
                                    <i class="material-icons orange-text text-lighten-2 list_alt_custom">list_alt</i>

                                    <span class='grey-text text-darken-3'> {{ $module->name }}</span>
                                </div>



                                @foreach($module->topics as $topic)
                    <div class="collapsible-body">

                          <label>
                            <input type="checkbox" class='orange lighten-3 filled-in'/>
                            <span onclick="{{ $topic->id }}">{{$topic->name}}xx</span>
                                      </label>

                                </div>
                                @endforeach


                        </li>
@endforeach

                    </ul>




                </div>
            </div> -->

                <div class="row" id='chapter_content'>
                    <div class="col s12">

                        <div class="no-margin-bottom">
                            <div class="input-field col l2 m3 s12">
                                <select>
                                    <option value="" disabled selected>Select Grade Level</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" onclick='showSubjects()'>{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="input-field col l2 m3 s12">
                                <select>
                                    <option value="" disabled selected>Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="input-field col l3 m6 s12">
                                <select>
                                    <option value="" disabled selected>Select Module</option>
                                    @foreach($modules as $module)
                                        <option value="{{ $subject->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="input-field col l5 m6 s12">
                                <select>
                                    <option value="" disabled selected>Select Topic</option>
                                    @foreach($topics as $topic)
                                        <option value="{{ $subject->id }}">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <ul class="collapsible col l3 m4 s12">
                            @foreach($modules as $module)
                                <li>

                                    <div class="collapsible-header" id='{{ $module->name }}'>
                                        <i class="material-icons orange-text text-lighten-2 list_alt_custom">list_alt</i>

                                        <span class='grey-text text-darken-3'> {{ $module->name }}</span>
                                    </div>



                                    @foreach($module->topics as $topic)
                                        <div class="collapsible-body">
                                            <label>
                                                <input type="checkbox" class='orange lighten-3 filled-in'/>
                                                <span onclick="{{ $topic->id }}">{{$topic->name}}xx</span>
                                            </label>
                                        </div>
                                    @endforeach


                                </li>
                            @endforeach

                        </ul>


                        <div class="col l9 m8 s12">

                            <textarea id='display' style="height:50vh;"></textarea>

                        </div>

                    </div>
                </div>


            </div>
        </div>

    </main>
@endsection








