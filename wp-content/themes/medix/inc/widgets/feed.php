<?php
/**
 * Twitter Feed Template
 * 
 * @package News Twitter
 * @author FOX
 * @version 1.0.0
 */

 
?>


<?php foreach ($twitter as $index => $item): 
    $strdate = strtotime($item['created_at']);
 
 ?>
	<?php
	/* open row. */
	if ($row_index == 0 ): ?><div class="news-twitter-item"><?php endif; ?>

		<div class="news-tweet-content">
		<?php
			$tweet_content = $item['text'];
			$tweet_content = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a class="author2" href="http://$1" target="_blank">http://$1</a>', $tweet_content);
			$tweet_content = preg_replace('/@([a-z0-9_]+)/i', '<a class="author" href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet_content);
				echo '<div class="tweet-text">'.wp_kses_post($tweet_content).'</div>';		
                
                echo '<div class="tweet-time">'.date("M d, Y",$strdate).'</div>';
		?>
	</div>

	<?php $row_index++; ?>

	<?php
	/* close row. */
	if ($row_index == $row || $items_count == $index ): $row_index = 0; ?></div><?php endif; ?>

<?php endforeach; ?>