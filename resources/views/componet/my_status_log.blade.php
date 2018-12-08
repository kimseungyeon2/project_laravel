<section id="buy-tickets" class="section-with-bg wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">
              <a href="#" data-toggle="popover" title="my Status" data-content="my Status.">my Status</a>
            </h5>
            <h6 class="card-price text-center">myLogStatus</h6>
            <div class="">
              <div class="container">
                <div class="text-center">
                  <img class="text-center" src="/storage/{{$my_user->my_image}}" alt="">
                  <hr>
                  <br>
                  <span>email:{{$my_user->email}}</span>
                  <br>
                  <span>name:{{$my_user->name}}</span>
                  <br>
                  <span>addrs:{{$my_user->addrs}}</span>
                  <hr>
                  <button class="btn btn-primary" type="button" name="button" onclick="">회원탈퇴</button>
                  <button class="btn btn-danger" type="button" name="button" onclick="'">회원정보수정</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</section>
