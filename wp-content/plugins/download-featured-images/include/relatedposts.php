<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 150px; overflow: hidden; visibility: hidden;">

    <!-- Loading Screen -->
    <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
        <div style="position:absolute;display:block;background:url('<?php echo plugins_url("img/loading.gif", __DIR__); ?>') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    </div>

    <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">

        <?php
        if ($related)
            foreach ($related as $post) {
                setup_postdata($post);
                if (has_post_thumbnail($post->ID)) {
                    ?>
                    <div style="display: none;">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"> <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'thumbnail'); ?>"></a>                    
                    </div>
                <?php }
            }
        wp_reset_postdata();
        ?>

    </div>

    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
</div>
<script>
    jssor_1_slider_init();
</script>
