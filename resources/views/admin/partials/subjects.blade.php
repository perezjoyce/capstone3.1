<div class="col s12">
    <div class="container">
        <table class="grey-text text-darken-3 striped">
            <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Subject</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->name }}</td>
                    <td class="right">
                        <button class="btn red lighten-2 btn-delete-curriculum"
                                data-component="subject"
                                data-id="{{ $subject->id }}"
                                data-name="{{ $subject->name }}"
                                data-color="red"
                        >
                            <i class="material-icons">delete</i>
                        </button>
                        <button class="btn orange lighten-1 btn-edit-curriculum"
                                data-component="subject"
                                data-id="{{ $subject->id }}"
                                data-name="{{ $subject->name }}"
                                data-color="orange"
                        >
                            <i class="material-icons">edit</i>
                        </button>
                    </td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="container">
        <table>
            <thead>
            <tr class="border-bottom-none">
                <th></th>
                <th></th>
                <th>
                    <button class="btn green lighten-1 right btn-add-curriculum"
                            data-component="subject">
                        <i class="material-icons">add</i>
                    </button>
                </th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
</div>