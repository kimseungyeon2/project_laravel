<!--client draw chart-->
<script type="text/javascript">
  $(document).ready(function() {
    client({{$content->id}},"{{$content->content_title}}");
  });
</script>
<section id="buy-tickets" class="section-with-bg wow fadeInUp">
  <div class="container">
    <h2>TITLE:{{$content->content_title}}</h2>
    <div class="row">
      <div class="col-lg-5">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">실시간정보</h5>
            <h6 class="card-price text-center">Chart</h6>
            <hr>
            <div id="{{$content->content_title}}" style="height: 300px; width: 100%;"></div>
            <ul class="fa-ul">
              @if(Auth::id() == $content->usera_id)
                <div class="card-header">
                  투표정보</div>
                <div class="card-body">
                  -미정-
                </div>
              @else
                <div class="card-header">
                  투표버튼</div>
                <div class="card-body">
                  @foreach($content_vote as $vote)
                    <button id="event_button" class="btn btn-outline-success" type="button" name="button" onclick="chart_vote_button({{$content->id}},{{$vote->id}})">
                      {{$vote->vote_content}}
                    </button>
                  @endforeach
                </div>
              @endif
            </ul>
            <hr>
            <div class="text-center">
              <br>
              생성일:{{$content->created_at}}
            </div>
          </div>
        </div>
      </div>
      <!-- Pro Tier -->
      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">소개정보</h5>
            <h6 class="card-price text-center">{{$content->content_title}}</h6>
            <hr>
            <div class="">
              {!!$content->content!!}
            </div>
            <hr>
            <div class="text-center">
              소개URL:<a href="{{$content->content_url}}">{{$content->content_url}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(Auth::id() == $content->user_id)
    <div class="row">
      <div class="col"></div>
      <div class="col">
        <div class="row">
          <div class="col"></div>
            <div class="col">
              <div class="btn-group">
                <button class="btn btn-outline-success" onclick="location.href='/content/{{$content->id}}'">수정</button>
                <button class="btn btn-outline-danger"  onclick="delete_check()">삭제</button>
                <form id="delete-form" action="{{route('content.destroy',$content->id)}}" method="POST" style="display: none;">
                  @csrf
                  @method('delete')
                </form>
              </div>
            </div>
          <div class="col"></div>
        </div>
      </div>
      <div class="col"></div>
    </div>
    @else
    @endif
    <br>
    <div class="">
      @if(Auth::check())
        <button class="btn btn-outline-success" onclick="location.href='{{route('home',['page'=>$page])}}'" type="button" name="button">뒤로가기</button>
      @else
        <button class="btn btn-outline-success" onclick="location.href='{{route('my_index',['page'=>$page])}}'" type="button" name="button">뒤로가기</button>
      @endif
    </div>
  </div>
</section>
