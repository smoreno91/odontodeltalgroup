<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<?php
$theme_options = medix_get_theme_option();
$word_number = !empty($theme_options['gallery_word_number']) ? $theme_options['gallery_word_number'] : 23;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('medix-gallery-loop'); ?>>
    <a href="<?php the_permalink();?>" title="<?php the_title()?>">
	<?php medix_post_thumbnail(); ?>
    </a>
    <div class="item-content text-center">
        <h4 class="item-title highlight">
			<a href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
		</h4>
		<span class="categories-links small-text">
            <?php echo get_the_term_list( get_the_ID(), 'gallery_category', '', ' / ', '' ); ?>
		</span>
		<div class="gal-desc">
    		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
    	</div>  
	</div>
</article><!-- #post-## -->