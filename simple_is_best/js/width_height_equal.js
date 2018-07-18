/*画面縮小時に記事一覧のブロックの横と縦の大きさを同じにしてやる*/
function width_height_equal(){
    $(function(){
      /*画面読み込み時と画面サイズ変更時*/
      $(window).on('load resize', function(){
      /*ブロックの横サイズを取得して、縦サイズに設定する。*/
        var block_width = $(".post_list_block").width();
        $(".post_list_block").height(block_width);
      });
    });
}
