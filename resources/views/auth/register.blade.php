<!-- <script type="text/javascript">
  var check_num;
  function mail_check(){
  var mail = $('#email').val();
  $.ajax({
    async :true,
    url: "mail_send/"+mail,
    type:'get',
        success:function(data) {
          cehck_num = data;
          if(check_num == data){
            alert("인증성공");
            $('#check_key').val('ok');
          }
          else{
            alert("인증실패");
            $('#email').val('');
            $('#check_key').val('');
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('이메일을 다시 입력해 주세요.');
        }
    });
  }//메일 인증은 다음에 구현
</script> -->
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
                <div class="card-header">{{ __('회원가입') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('사진') }}</label>

                            <div class="col-md-6">
                                <input type='file' id="imgInput" multiple accept="image/*" name="my_image" required autofocus/><hr>
                                <img id="image_section" src="{{asset('template/img/about-bg.jpg')}}" alt="my image" width="150" height="150"/>

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
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('이메일') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('비밀번호') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                              <input type="text" class="form-control" name="addrs0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">주소</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" name="addrs1" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">상세주소</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" name="addrs2" required>
                              <button class="btn btn-primary" type="button" onclick="openZipSearch()">검색</button><br>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button onclick="check_msg()" type="submit" class="btn btn-primary">
                                    {{ __('회원가입') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
