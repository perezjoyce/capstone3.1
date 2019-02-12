<div style="background-image:url('{{ asset("images/thumbs-up.gif") }}');background-size:cover;position:relative;background-position-x:80px!important;" class="center-align">
    <div class='right row'>
        <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
    </div>

    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <div class="grey-text activity-result-text">You got <span class="bold">{{ $score }} out of {{ $numberOfItems }}</span> correct.</div>
                <div class="grey-text activity-result-text">Your average score is</div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <h1 class="orange-text bold">{{ $average }}%</h1>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">

                <button class="waves-effect waves-light btn-large red lighten-1 reload-btn">
                    {{ __('TRY AGAIN') }}
                </button>

            </div>
        </div>
    </div>
</div>
