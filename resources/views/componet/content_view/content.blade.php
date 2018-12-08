<div class="container">
  <div class="card-deck">
    <div class="card-deck">
      <div id="speakers" class="wow fadeInUp">
        <div class="container">
          <div class="row">
            @foreach($contents as $content)
              <div class="col-md-4" style="width:100em;">
                <div class="speaker">
                  <img src="/storage/{{$content->content_image}}" alt="Speaker 1" class="img-fluid" style="height:350px;" >
                  <div class="details">
                    <h3><a href="{{route('detail_page',['content'=>$content->id,'page'=>$page])}}">{{$content->content_title}}</a></h3>
                    <p>조회수:{{$content->content_hists}}</p>
                    <p>{{$content->created_at}}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  @if($contents)
  <div class="row">
    <div class="col"></div>
    <div class="col">
      <div class="row">
        <div class="col"></div>
          <div class="col">
            {!! $contents->appends(Request::except('page'))->links() !!}
            <!--
              appends는 "page"를 제외한 쿼리 문자열 값 ex) url 에 나오는 문자열 값 같은거 들을 유지해줌
            -->
          </div>
        <div class="col"></div>
      </div>
    </div>
    <div class="col"></div>
  </div>
  @endif
</div>
