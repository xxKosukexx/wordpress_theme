<div id="comment_area">
  <?php if(have_comments()): ?>
    <h3 id="comments">Comments</h3>
    <ol class="commets-list">
      <?php
        $args = array(
          'style'             => 'ul',
          'avatar_size'       => 48,
          'reverse_top_level' => true
        );
      wp_list_comments($args); ?>
    </ol>
    <?php
      if(get_comment_pages_count() > 1):
        //ページネーションを表示する?>
        <div id="comment_pagenation">
          <?php paginate_comments_links(array(
            'prev_text' => '<<',
             'next_text' => '>>',
             'mid_size' => 2
           )); ?>
        </div>


    <?php endif; ?>
  <?php endif; ?>
  <hr>

  <?php
    /*コメントフォームのメールアドレスとwebサイトの項目は削除。
    　復元したい場合は、function.phpのコメントフォームの不要なデザインを削除する
    　内に記述してある処理を削除する
    またメールアドレスと名前を入力必須項目から排除する設定にしてあるので、
    function.phpの「update_option('require_name_email',0);//メールアドレスと名前を必須ではない設定にする。」
    の記述を削除するとメールアドレスと名前が必須になる。*/
    comment_form();

  ?>

</div>
