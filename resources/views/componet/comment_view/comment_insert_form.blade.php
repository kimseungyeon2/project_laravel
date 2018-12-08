<textarea id="comment" name="comment_content" rows="6" cols="50">
</textarea>
<button type="button" name="button" onclick="comment_ajax('{{route('comment.store')}}','post',{{$content_id}},$('#comment').val())">댓글작성</button>
