<div class="modal fade" id="social-auth">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <a class="btn btn-block btn-social btn-lg btn-google"
               href="{{ route('oauth::google') }}">
                <i class="fa fa-google"></i>
                Sign in with Google
            </a>
            <a class="btn btn-block btn-social btn-lg btn-github"
               href="{{ route('oauth::github') }}">
                <i class="fa fa-github"></i>
                Sign in with GitHub
            </a>
            <a class="btn btn-block btn-social btn-lg btn-facebook"
               href="{{ route('oauth::facebook') }}">
                <i class="fa fa-facebook"></i>
                Sign in with Facebook
            </a>
        </div>
    </div>
</div>
