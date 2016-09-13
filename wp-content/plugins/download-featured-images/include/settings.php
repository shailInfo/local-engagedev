<div class="wrap featured">
    <div class="featured-title">        
        <a href="http://www.mazekro.com/" target="_blanck">
            <img src="<?php echo plugins_url('img/mazeKro_big.png', __DIR__); ?>" >
        </a>
        <h1>Featured Download Settings</h1>
    </div>

    <div class="clear"></div>
    <div class="content-type-listing">
        <div>
            <h2>Select post type where you want to apply download featured images.</h2>
            <p>
                Using below check boxes you will able to add " Show Download Icon " 
                for selected post type.
            </p>
        </div>

        <form id="save-featured-options" name="save-featured-options" action="<?php echo $action; ?>&settings=post_type" method="post">
            <ul>
                <?php foreach ($post_types as $key => $val) { ?>
                    <li>
                        <label for="name"><?php echo strtoupper($key); ?>:</label>
                        <input  type="checkbox" name="<?php echo $key; ?>"  value="<?php echo $val; ?>" <?php if (!empty($get_options->$key) && ($get_options->$key == $key)) echo "checked" ?>/>
                    </li>
                <?php } ?>
            </ul>
            <div class="line">
                <div>
                    <h2>Select check box to display thumb slider.</h2>
                    <p>
                        Using below check boxes you can set thumb slider positions.
                    </p>
                </div> 
                <div>
                    <label for="name"><?php _e('Enable Slider'); ?>:</label>
                    <input onclick="validate()" id="dfi_enable_slider" type="checkbox" name="dfi_enable_slider"  value="dfi_enable" <?php if ($get_options->dfi_enable_slider == 'dfi_enable') echo "checked" ?>/>
                </div>
                <ul id="slider-pos" class="hidden">

                    <li>
                        <label for="name"><?php _e('Before Content'); ?>:</label>
                        <input type="radio" name="dfi_slider"  value="before" <?php if ($get_options->dfi_slider == 'before') echo "checked" ?>/>
                    </li>
                    <li>
                        <label for="name"><?php _e('After Content'); ?>&nbsp;&nbsp;&nbsp;:</label>
                        <input type="radio" name="dfi_slider"  value="after" <?php if ($get_options->dfi_slider == 'after') echo "checked" ?>/>
                    </li>
                </ul>
                
            </div>
            <div class="line">
                <div>
                    <h2>Select check box to display download icon for all posts.</h2>
                    <p>
                        Using below check boxes you can set download icon for all posts.
                    </p>
                </div>
                <div>
                    <label for="name"><?php _e('Enable Download for all'); ?>:</label>
                    <input  id="dfi_enable_download" type="checkbox" name="dfi_enable_download"  value="enable_download" <?php if ($get_options->dfi_enable_download == 'enable_download') echo "checked" ?>/>
                </div>
                
                <div class="featured-submit">
                    <input type="submit" value="<?php _e('save'); ?>" class="button button-primary button-large" name="save">
                </div>
                
            </div>

        </form>
    </div>

</div>
<script>
        validate();
        function validate() {
            if (document.getElementById('dfi_enable_slider').checked) {
                document.getElementById("slider-pos").className = "";
            } else {
                document.getElementById("slider-pos").className = "hidden";
            }
        }
</script>


