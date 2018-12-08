<textarea id="comment" name="comment_content" rows="6" cols="50">
  {{$content_comment}}
</textarea>
<button type="button" name="button" onclick="comment_ajax('{{route('comment.update',['id'=>$comment_id])}}','patch',{{$content_id}},$('#comment').val())">댓글수정</button>
