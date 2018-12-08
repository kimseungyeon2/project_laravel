//log modal to all
function log_modal(name){
  $.ajax({
      async : false,
      type: "get",
      url:name,
      success:function(data) {
        $('#log-modal').html(data);
      }
    });
};
//insert update
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#image_section').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$(function(){
  $('[data-toggle="popover"]').popover();
  $('#add').click(function(){
    if($('#text').val()){
      $('#add_tag').append("<span>"+"<input class='form-control' type='text' name='content_kinds[]' value='"+$('#text').val()+"' required>"+"</span>");
      $('#text').val('');
    }else{
      alert('내용을 입력하세요.');
    }
  });
  $('#minus').click(function(){
    $('#add_tag').children().last().remove();
  });
  $("#imgInput").change(function(){
  readURL(this);
  });
});
//delete
function delete_check(){
  var delete_check = confirm('삭제하시겠습니까?');
  if(delete_check){
    document.getElementById('delete-form').submit();
  }else{
    alert('삭제가 취소 되었습니다.');
  }
}
//chart -relation method
//chart_data_update_ajax
function chart_vote_button(content_id,vote_id){
  $.ajax({
      url:"/chart/"+content_id+"/"+vote_id+"",
      success:function(data){
        alert(data);
      },
      error:function(){
        alert('오류');
      }
  });
}
//chart client server
function client(content_id,title){
  var source = new EventSource("/server/"+content_id);
  source.onmessage = function(event) {
    chart(event.data,title);
  };
}
//chart draw
var animationCheck = true;
function chart(datas,title) {
  var datass = eval(datas);//단순문자열을 json object로 바꿀수 있음
  var chart = new CanvasJS.Chart(title, {
    theme: "white1",
    exportFileName: "Doughnut Chart",
    exportEnabled: true,
    animationEnabled: animationCheck,
    title:{
      text:title
    },
    data: [{
      type: "doughnut",
      innerRadius: 90,
      toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
      indexLabel: "{name} - #percent%",
      dataPoints: datass,
    }]
  });
  chart.render();
  animationCheck = false;
}
//detailview
//update insert modal
function comment_Form(url,id){
  $.ajax({
      async : false,
      type: "get",
      url:url,
      data:{'id':id},
      success:function(data) {
        $('#log-modal').html(data);
      }
  });
}
//comment delete insert update ajax
function comment_ajax(url,type,content_id,content){
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');//meta에서 받은 토큰
  $.ajax({
      async : false,
      type: type,
      url:url,
      data:{'content':content,'content_id':content_id,'_token':CSRF_TOKEN},
      success:function(data) {
        $('#comments').html(data);//data update
        if(type=='post'){
          alert('작성성공');
        }
        else if(type=='delete'){
          alert('삭제 성공');
        }
        else{
          alert('수정성공');
        }
      },
      error:function(){
        alert('오류');
      }
  });
}
//daum address api javaScript code
function openZipSearch() {
  new daum.Postcode({
    oncomplete: function(data) {
      $('[name=addrs0]').val(data.zonecode);
      $('[name=addrs1]').val(data.address);
      $('[name=addrs2]').val(data.buildingName);
    }
  }).open();
}
