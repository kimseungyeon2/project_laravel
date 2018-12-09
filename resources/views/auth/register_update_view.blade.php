<br><br><br>
<script type="text/javascript">
  $(function(){
    $("#imgInput").change(function(){
    readURL(this);
    });
  })//Image Preview
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('회원수정') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('logUpdate',['id'=>Auth::id()]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('사진') }}</label>

                            <div class="col-md-6">
                                <input type='file' id="imgInput" multiple accept="image/*" name="my_image" required autofocus/><hr>
                                <img id="image_section" src="/storage/{{$user->my_image}}" alt="my image" width="150" height="150"/>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('이름') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('비밀번호') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value='{{$password}}' required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('비밀번호확인') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">우편주소</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" name="addrs0" value="{{$addrs[0]}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">주소</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" name="addrs1" value="{{$addrs[1]}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">상세주소</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" name="addrs2" value="{{$addrs[2]}}" required>
                              <button class="btn btn-primary" type="button" onclick="openZipSearch()">검색</button><br>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button onclick="check_msg()" type="submit" class="btn btn-primary">
                                    {{ __('회원수정') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
