<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('회원탈퇴') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('logDelete',['id'=>Auth::id()]) }}">
                        @csrf
                        @method('delete')
                        <input class="btn" type="submit" name="" value="탈퇴">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
