<div class="row" style="max-width:750px;max-height:500px;">
    <div class="col s12 center-align" style="overflow:auto;">
        <div class="row">
            <br>
            <div class="col s12 center-align">
                <div class="row">
                    <div class="btn-flat green-text text-lighten-2 bold" style="font-size:1.3rem;">
                        COMPLETED REPORTS
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
                                <option value="completed" selected name="report-status">Completed</option>
                                <option value="pending" name="report-status">Pending</option>
                            </select>
                        </form>
                    </td>
                    <td></td>
                </tr>
            @endfor
            </tbody>
        </table>

    </div>
</div>