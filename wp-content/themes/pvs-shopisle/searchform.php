
<form role="search" method="get" class="search-form" action="<?php echo (site_url( ) );?>/">
    <label>
        <span class="screen-reader-text"></span>
        <input type="search" class="search-field" placeholder="<?php echo(pvs_word_lang("search")); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    </label>
    <input type="submit" class="search-submit" value="OK">
</form>
