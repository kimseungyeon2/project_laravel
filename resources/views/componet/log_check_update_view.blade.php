<div class="modal fade" id="mylogcheck_update" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <span>비밀번호확인</span>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="subscribe">
           <div class="container wow fadeInUp">
             <form action="{{route('logCheck')}}" method="post">
               @csrf
               <input type="hidden" name="log_kind" value="update">
               <div class="form-row justify-content-center">
                 <div class="col-auto">
                   <input type="password" class="form-control" name="password" class="form-control" placeholder="your password">
                 </div>
                 <div class="col-auto">
                   <button type="submit">go Update</button>
                 </div>
               </div>
             </form>
           </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div>
  </div>
</div>
