<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div id="blog_content">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			
				<div class="left_part_post">
					<h2 class="post_category"><?php
$category = get_the_category(); 
echo $category[0]->cat_name;
?>
	</h2>				
					

			
					<p class="post_date">Posted on<br /><?php the_time('F jS, Y') ?> </small>
					
										<p class="comment_count"><?php comments_popup_link('Be the first to comment &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
										
										
										
										
						<div class="blog_share">
					share this post:
					<br />
					<br /><?php 
				 $url = urlencode(get_permalink());
				 $title = urlencode(get_the_title());
				 $body = urlencode(get_the_excerpt());
					
					?>
					<a href="http://digg.com/submit?url=<?=$url?>&title=<?=$title?>&media=news&topic=computers" target="_blank"><img src="../images/share_digg.gif" id="share_digg" class="share_link"/></a>
					<a href="http://www.facebook.com/sharer.php?u=<?=$url?>&t=<?=$title?>" target="_blank"><img src="../images/share_facebook.gif" id="share_facebook" class="share_link" /></a>
					<a href="http://twitter.com/home?status=Currently+reading+<?=$url?>" target="_blank"><img src="../images/share_twitter.gif" id="share_twitter" class="share_link" /></a>
					<br/>
					<br/>
					<a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a>
					</div>
				<!--left_part_post--></div>
				
				
				<div class="right_part_post">
<h2 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="entry">
					<?php the_content("(Continue Reading...)"); ?>
					<span class="blog_tags_homepage"><?php the_tags('Tagged with: ',', '); ?></span>
					</div>

				
					<!--right_side_post--></div>
					
					<div style="clear: both;"></div>
				
			

				

			
				
				
				
				
							
				
				
				</div>
			
			
			
			
			
			
			
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft nav_link"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright nav_link"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php //get_search_form(); ?>

	<?php endif; ?>

<!--blog_content--></div>
<?php get_sidebar(); ?>
<div style="clear: both;"></div>
<!--container--></div>
<?php get_footer(); ?>