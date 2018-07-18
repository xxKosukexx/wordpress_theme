/*wordpressで取得したul(class=menu_list_sumaho)は参照用のメニューとし、
そこから必要なメニューを切り取って表示領域(id=show_icon_menu)にメニューを表示する*/

/*戻ると進むを区別するために使う。*/
const BACK = 'back';
const NEXT = 'next';　

function menu_icon(){
  $(function(){

    /*aタグの情報を変更する。*/
    $("#menu_list_sumaho a").each(function(index,elem){
      //要素ないのテキストをブロック要素に変更する。ブロックにすることでwidthプロパティが使用できるので、
      //テキストと＞マークの表示する領域を分ける。
      //領域を分けることでテキストと＞マークを左右に分けて表示する。
      var a_elem = $(elem);
      a_elem.wrapInner("<div class=a_text><div>");
      a_elem.css('display','flex');

      /*サブメニューがあるメニューに >要素を追加する*/
      if (!(a_elem.next('ul').prop("tagName") === undefined)) {
        a_elem.append("<div class='next_menu'> ＞ </div>");
      }
    });

    //メニューアイコンを押下した時の動作
    $('#menu_icon_image img').on('click',function(){
        //既にメニューが表示されていないか？
        if ($('#menu_icon .sumaho_show').length <= 0) {
          console.log('メニューを開きました。');

          window.returnIndex = 0; //戻るボタン用インデックス
          window.retuenStackLiClassName = {};//戻るボタン用のliのクラス名

          //topメニューを取得する
          var top_menu = $('#menu_list_sumaho').children('ul').clone();

          //先頭のul以外のdisplayをnoneにする。
          top_menu.find('ul').addClass('none');

          //追加する要素にイベントを追加する。
          $(top_menu).find('.back_menu').on('click', back_event);
          $(top_menu).find('a').on('click', a_event);

          //既存のメニューであることを示すクラスを追加。要素をスライドする時に使用する。
          $(top_menu).addClass('old_menu');

          //メニューを表示領域に表示する。
          $('#show_icon_menu').append(top_menu);

          show_menu_css();

          $('#show_icon_menu').slideToggle(500);

          //メニューを表示していることを示すクラスを追加する。
          $('#menu_list_sumaho').addClass('sumaho_show');
        } else {
          console.log('メニューを閉じました。');


          delete　window.returnIndex;
          delete　window.retuenStackLiClassName;

          $('#show_icon_menu').slideToggle(500);

          //表示領域の要素を削除する。要素を削除する処理は遅れて実行させないと、スライドしている間に要素が消されてしまうため、
          //スライドしてるように見えなくなる。完全にメニューが非表示になってから要素を消しましょうってこと。
          setTimeout(function(){
            $('#show_icon_menu').empty();
          },500);

          //メニューを表示しているかどうかを表すクラスを削除する
          $('#menu_list_sumaho').removeClass('sumaho_show');
        }
    });

  });
}


/*戻るボタンが押下された時のイベント。
１つ前のメニューを表示する。*/
function back_event(){

  console.log('戻るボタンが押下されました。')

  //現在表示しているメニューの親メニューを取得する。
  window.returnIndex--;
  var liClassName = window.retuenStackLiClassName[window.returnIndex];
  console.log(window.returnIndex + 'スタック');
  console.log('クラス名：'　+ window.retuenStackLiClassName[window.returnIndex]);

  var liPosition = $('#menu_list_sumaho').find(liClassName);
  var showMenu = liPosition.closest('ul').clone();

  //親メニューに親メニューが存在するか？
  if(window.returnIndex != 0){
   console.log('親メニュー有り');

   //サブメニューなので、親メニューを取得する。クローンを先頭に追加
   var liClassName = window.retuenStackLiClassName[window.returnIndex - 1];
   var liParentPosition = $('#menu_list_sumaho').find(liClassName);
   showMenu.prepend(liParentPosition.clone().addClass('parent'));

   //親メニューの項目の'>'を削除する。
   showMenu.find('.parent .next_menu').remove();

   //取得した親メニューはリンクへ飛ぶようにする
   //既にaタグにクリックイベントが設定されているので、それを削除する。
   $('.parent').off('click');

   //戻るメニューを先頭に追加する。
   showMenu.prepend("<li class='back_menu width100'> ＜ </li>");


  }

  //追加する要素にイベントを追加する。
  $(showMenu).find('a').on('click', a_event);
  $(showMenu).find('.back_menu').on('click', back_event);


  //先頭のul以外を非表示にする。
  showMenu.find('ul').addClass('none');

  slide_show(BACK, showMenu);

  show_menu_css();
}

//aタグをクリックした時のイベント
//サブメニューがある場合はサブメニューを表示し、ない場合はリンクへ飛ぶ。
function a_event(){
  console.log('メニューがクリックされました。');
  //サブメニューが存在するか？
  if ($(this).nextAll('ul').length > 0) {

    /*liの場所を特定するためにクラス名からmanu-item-数字　となっているクラス名を取得する。*/
    var classNameStr = $(this).closest('li').attr('class');
    var liClassName = '.' + classNameStr.match(/menu-item-[0-9]+/);
    //取得したクラス名からli要素を取得する。
    var liPosition = $('#menu_list_sumaho').find(liClassName);

    //戻るボタン用にクラス名をスタックに保管しておく。
    window.retuenStackLiClassName[window.returnIndex] = liClassName;
    window.returnIndex++;
    console.log(window.returnIndex + 'スタック');

    var showMenu = liPosition.children('ul').clone();

    //サブメニューなので、親メニューを取得する。
    showMenu.prepend(liPosition.clone().addClass('parent'));

    //取得したサブメニューの親に>が表示されてしまうので削除する。
    showMenu.find('.parent .next_menu').remove();

    //戻るメニューを先頭に追加する。
    showMenu.prepend("<li class='back_menu width100' style=''> ＜ </li>");

    //取得したメニューのul要素が全て表示状態になっているので、先頭以外のulを全て非表示にする
    showMenu.find('ul').css('display', 'none');

    //追加する要素にイベントを追加する。
    $(showMenu).find('a').on('click', a_event);
    $(showMenu).find('.back_menu').on('click', back_event);

    //取得した親メニューはリンクへ飛ぶようにする
    //aタグのクリックイベントを削除する。
    showMenu.find('.parent > a').off('click');

    //全てが非表示になっているので、先頭にulだけ表示にする。
    showMenu.removeClass('none');

    slide_show(NEXT, showMenu);

    show_menu_css();

    return false;
  }
  //リンクへ飛ぶ前に不要なものを削除する
  delete　window.returnIndex;
  delete　window.retuenStackLiClassName;
  return true; //リンクへ飛ぶ。
}

//表示領域に表示するメニューのcssの共通変更
function show_menu_css(){

  $('#show_icon_menu li').hover(function(){
    $(this).css({backgroundColor:'#01DF3A'});
  },function(){
    $(this).css({backgroundColor:'#000'});
  });

  //テキストのデザインを設定する
  $('#show_icon_menu a').css({
    textDecoration: 'none',
    //fontSize: '3em',
    color: '#F7FE2E',
    paddingRight: '8px',
    paddingLeft: '8px'
  });

  //戻るメニューテキスト
  $('#show_icon_menu .back_menu').css({
    //fontSize: '3em',
    color: '#F7FE2E',
    paddingRight: '8px',
    paddingLeft: '8px'
  });

  $('#show_icon_menu a, #show_icon_menu .back_menu').addClass('font_Rounded');

  //各要素
  $('#show_icon_menu li').css({
    backgroundColor: '#000',
    borderBottom: 'solid 2px #F7FE2E',
    paddingTop: '5px',
    paddingBottom: '5px',
    listStyle: 'none',
  });

  $('#show_icon_menu > ul').css({
    padding: '0',
    margin: '0'
  });

  $('#show_icon_menu > ul > li:first-child').css({
    borderTop: 'solid 2px #F7FE2E'
  });
}

function slide_show(type,menu){
  //新規のメニューであることを表すメニューを追加する。
  menu.addClass('new_menu');

  var width = $('#show_icon_menu').width();

  //typeによって表示させる位置の値を変更する。
  if(type == BACK){
    var position = -width;
  } else if (type == NEXT){
    var position = width;
  }
  menu.css({
    left: position,
  });

  //新たに表示領域にメニューを追加する。
  $('#show_icon_menu').append(menu);

  $('.new_menu').animate(
  {
    'left': 0
  });


  //表示領域の要素を削除する。
  setTimeout(function(){
    $('.old_menu').remove();
    //新規のメニューを既存のメニューとする。
    $('.new_menu').addClass('old_menu');
    $('.new_menu').removeClass('new_menu');
  },500);
}
