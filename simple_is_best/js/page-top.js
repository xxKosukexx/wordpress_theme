
//画面読み込み時
function page_top_fixed_width(){
  $(document).ready( function(){
    /*画面読み込み時に画面上部に固定するための要素の幅をウィンドウの幅にする。*/
    var windowWidth = window.innerWidth + 'px';
    $('.page_top_fixed').css('width',windowWidth);

    /*ウィンドウサイズをリサイズした時に画面上部に固定するための要素の幅をウィンドウの幅にする。*/
    $(window).on('load resize', function(){
      var windowWidth = window.innerWidth + 'px';
      $('.page_top_fixed').css('width',windowWidth);
    });
  });
}
