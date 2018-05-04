/*
文字の色が移動しているように見せるプラグイン。
仕様
・指定したブロック(１階層)の縦横サイズと文字色を取得する。
・１階層のブロックの文字の色を透過にする。100%で
・取得した縦横サイズと同じブロック要素２つ作成する。
・一枚めのブロックの背景色を１階層のブロック要素で取得した文字色と同じとする。
・３枚めのブロックの親が２階層のブロック、その親が３階層のブロックとなるようにする。
・２階層のブロックだけ１階層のブロック、１枚分ずらして表示する。
・２階層のブロックを横にずらしていく。繰り返し。
*/

$(function(){
  $.CharColorMove = function(elem,options){

    this.$el = elem;

    this._init(options);
  }

  $.CharColorMove.defaults = {
    moveDirection: 'left',   //移動する方向
    charColor:      'blue',   //移動する色
    moveSpeed:      '1000ms', //移動するスピード
    moveInterval:   '1000ms'  //移動し終わった後に再移動する時の間隔
  };

  $.CharColorMove.prototype = {
    //初期化する関数
    _init: function(options){

      //オプションを取得する。
      var settings = $.extend($.CharColorMove.defaults, options);

      //指定した要素の縦横サイズを取得する。
      var block_width = this.$el.width();
      var block_height = this.$el.height();

      //指定した要素の文字色を取得する。一番下となるブロックの背景色とする。
      var base_color = this.$el.css('color');

      //２枚めのブロックを作成する。
      var div2 = this.$el.wrap("<div></div>");


      //一枚めのブロックを作成する
      var div1 = div2.wrap("<div></div>");

      //作成したブロックのサイズを指定したブロックと同じサイズにする。
      //２枚目
      div2.width(block_width);
      div2.height(block_height);
      //１枚目
      div1.width(block_width);
      div1.height(block_height);

      //１枚目のブロックの背景色を取得した文字色と同じにする。
      div1.css({'background-color': base_color});

      //２枚目のブロックの背景色をオプションで指定した色にする。
      div2.css({'background-color': settings['charColor']});


      //文字の色を移動開始。
      setInterval(_moveStart, settings['moveInterval']);
    },
    //文字色の移動させる関数
    _moveStart: function(){
      if('left' == settings['charColor'] ){
        this.$el.parent('div').animate(
        {
          //文字色を左に移動する
          'left': -100,
          'duration': settings['moveSpeed']
        });
      } else {
        this.$el.parent('div').animate(
        {
          //文字色を右に移動する。
          'left': 100,
          'duration': settings['moveSpeed']
        });
      }

    }
  };

  $.fn.charColorMove = function( options ) {

    this.each(function(){
      //文字色移動開始
      var char_color_move = new $.CharColorMove(this,options);
    });

    return this;
  };
});
