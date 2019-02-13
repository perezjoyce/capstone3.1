
@if($sections->isNotEmpty())
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
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach($sections as $section)
                <tr>
                    <td></td>
                    <td id='{{ $section->id }}'>{{ $section->level->name }} - {{ $section->name }}</td>
                    <td>{{ $section->subject->name }}</td>
                    <td>{{ $section->school_year }}</td>
                    <td>{{ $section->access_code }}</td>
                    <td>
                        <a href="#!" class='grey-text text-lighten-1 tooltipped btn-open-edit-class-modal'
                           data-id="{{ $section->id }}"
                           data-name="{{ $section->name }}"
                           data-position="left"
                           data-tooltip="Edit Settings">
                            <i class="material-icons left grey-text text-lighten-1">settings</i>
                        </a>
                    </td>
                    <td>
                        <a href="#!" data-id="{{ $section->id }}" class='btn orange btn-view-class-list'><i class="material-icons right">open_in_browser</i>DETAILS</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="container">
        <div class="row">
            <div class="col s12 center" style="margin-top:4em;margin-bottom:4em;">
                None of your classes match your given search key.
            </div>
        </div>
    </div>
@endif