<section>
<div id="schedule" class="section-with-bg">
<div class="tab-content row justify-content-center">
  <!-- comment-->
  <div role="tabpanel" class="col-lg-9 tab-pane fade show active" style="overflow:scroll; width:300px; height:500px; padding:10px;">
  @foreach($comments as $c)
    <div class="row schedule-item">
      <div class="col-md-2">
        <span>작성자:{{$c->user_id}}</span><br>
        <span>작성시간:{{$c->created_at}}</span>
      </div>
      <div class="col-md-10">
        <h6>{{$c->content_comment}}</h6>
        @if(Auth::check())
        <button class="btn btn-outline-primary" onclick="comment_Form('{{route('comment.edit',['id'=>$c->id,'content'=>$c->content_comment])}}','{{$content->id}}')" data-toggle="modal" data-target="#exampleModal">수정</button>
        <button class="btn btn-outline-danger" onclick="comment_ajax('{{route('comment.destroy',['id'=>$c->id])}}','delete',{{$content->id}})">삭제</button>
      </div>
      @endif
    </div>
  @endforeach
  </div>
  <!--comment-->
</div>
</div>
</section>
<!--comment insert_form button-->
<div class="fixed-bottom">
@if(Auth::check())
<button class="btn btn-outline-primary" onclick="comment_Form('/comment/create',{{$content->id}})" data-toggle="modal" data-target="#exampleModal">
  <i class="fa fa-stack-exchange" style="font-size:300%" ></i>
</button>
@endif
</div>
<!--comment Form Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="log-modal" class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
