@if ($errors->has('content_kinds'))
<script type="text/javascript">
  alert('항목을 2개이상 만들어 주세요.');
</script>
@elseif($errors->has('content'))
<script type="text/javascript">
  alert('글을 작성해 주세요.');
</script>
@endif
<section id="buy-tickets" class="section-with-bg wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">
              <a href="#" data-toggle="popover" title="작성요령!" data-content="자신이 소개하고 싶은 사이트를 소개해주세요. 그리고 알고싶은 사실을 작성해주세요.">작성요령!</a>
            </h5>
            <h6 class="card-price text-center">글작성</h6>
            <div class="">
              <div class="container">
                <form class="" action="{{route('content.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="">
                    <label for="content_img"><i class="far fa-comment-alt"></i>Title_image</label><br>
                    <input type='file' id="imgInput" multiple accept="image/*" name="content_img"  required/><hr>
                    <img id="image_section" src="{{asset('template/img/about-bg.jpg')}}" alt="my image" width="150" height="150"/>
                  </div>
                  <div class="">
                    <label for="content_title"><i class="far fa-check-square"></i>제목</label>
                    <input type="text" name="content_title" value="" class="form-control" placeholder="title을 적어주세요" required>
                  </div>
                  <div class="">
                    <label for="content_url"><i class="fab fa-buysellads"></i>사이트 주소</label><br>
                    <input type="text" name="content_url" value="" class="form-control" placeholder="url 주소를 적어주세요" required>
                  </div>
                  <div class="">
                    <label for=""><i class="far fa-comments"></i>조사항목</label><br>
                    <span class="btn-group">
                      <input id="text" type="text" name="" value="" class="form-control" placeholder="항목을 적어주세요">
                      <button id="add" class="btn btn-outline-info btn-sm" type="button" name="button">추가</button>
                      <button id="minus" class="btn btn-outline-danger btn-sm" type="button" name="button">삭제</button>
                    </span>
                    <span id="add_tag">
                      <!--항목이 들어가는 button-->
                    </span>
                  </div>
                  <div class="">
                    <label for="content"><i class="fas fa-file-alt"></i>글작성</label><br>
                    <textarea name="content" rows="10" cols="95" placeholder="자신의 사이트를 소개해 주세요."></textarea>
                    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
                    <script>
                    		CKEDITOR.replace('content', {
                    			filebrowserUploadUrl:'/ckUpload?_token={{csrf_token()}}&type=image',
                          height:'500px',
                    		});
                    </script>
                  </div>
                  <div class="text-center">
                    <input class="btn btn-primary btn-sm" type="submit" name="" value="글작성">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</section>
