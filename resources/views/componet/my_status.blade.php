<!--client draw chart-->
<script type="text/javascript">
  $(function(){
    var myContents = new Array();
    myContents = <?=json_encode($myContents);?>;
    for (var i =0; i < myContents.length; i++) {
      client(myContents[i]['id'],myContents[i]['content_title']);
    }
  });
</script>
<section id="buy-tickets" class="section-with-bg wow fadeInUp">
  <div class="container">
    <div class="row">
      @for ($i = 0; $i < count($myContents); $i++)
        <div class="col-lg-4">
          <div class="card mb-5 mb-lg-0">
            <div class="card-body">
              <h5 class="card-title text-muted text-uppercase text-center">
                {{$myContents[$i]['content_title']}}정보
              </h5>
              <div class="">
                <div class="container">
                  <div id="{{$myContents[$i]['content_title']}}" style="height: 300px; width: 100%;"></div>
                </div>
                <hr>
                <div class="card-footer small text-muted">작성일{{$myContents[$i]['created_at']}}</div>
              </div>
            </div>
          </div>
        </div>
      @endfor
    </div>
    <br>
  </div>
</section>
