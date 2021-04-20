<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <div class="input-group">
      <input name="s" type="search" class="form-control" placeholder="<?php if(get_search_query()) echo 'Search result for ' . get_search_query(); else echo 'Search for...' ?>">
      <span class="input-group-btn">
        <button name="submit" class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div>
</form>