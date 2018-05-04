<div id="comment_area">
  <?php if(have_comments()): ?>
    <h3 id="comments">Comments</h3>
    <ol class="commets-list">
      <?php wp_list_comments('avatar_size=48'); ?>
    </ol>
  <?php endif; ?>
  <hr>
  <?php comment_form(); ?>
</div>
