<div class="col s12">
    <div class="container">
        <table class="grey-text text-darken-3 striped">
            <thead>
            <tr>
                <th></th>
                <th>Level</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($levels as $level)
                <tr>
                    <td></td>
                    <td>{{ $level->name }}</td>
                    <td class="right">
                        <button class="btn red lighten-2 btn-delete-curriculum"
                                data-component="level"
                                data-id="{{ $level->id }}"
                                data-name="{{ $level->name }}"
                                data-color="orange"
                        >
                            <i class="material-icons">delete</i>
                        </button>
                        <button class="btn orange lighten-1 btn-edit-curriculum"
                                data-component="level"
                                data-id="{{ $level->id }}"
                                data-name="{{ $level->name }}"
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
                            data-component="level">
                        <i class="material-icons">add</i>
                    </button>
                </th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
</div>