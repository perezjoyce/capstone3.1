<div class="input-field col s12" id="purpose-options">
    <select name="purpose" id="selected-purpose" required>
        <option value="" disabled selected>Select A Purpose</option>
        @foreach($purposes as $purpose)
            <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
        @endforeach
    </select>
</div>