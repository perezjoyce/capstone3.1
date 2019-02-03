<div class="input-field col s12" id="module-options">
    <select name="module">
        <option value="" disabled selected>Select Module</option>
        @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->name }}</option>
        @endforeach
    </select>
</div>