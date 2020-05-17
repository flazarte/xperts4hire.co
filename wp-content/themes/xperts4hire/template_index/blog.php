<?php 
$args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
];
$blog_post = get_posts($args);
?>
<?php if(count($blog_post) > 0) : ?>
<div class="section padding-top-65 padding-bottom-50">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-45">
					<h3>From The Blog</h3>
					<a href="pages-blog.html" class="headline-link">View Blog</a>
				</div>

				<div class="row">
                <?php foreach($blog_post as $key => $post):
                 $post_description  = get_field('post-description', $post->ID);
                 $category          = get_the_category($post->ID);
                 $url_mage          = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
                 $date              = get_the_date('j F Y',$post->ID);
                ?>
                    
					<!-- Blog Post Item -->
					<div class="col-xl-4">
						<a href="pages-blog-post.html" class="blog-compact-item-container">
							<div class="blog-compact-item">
								<img src="<?php echo $url_mage;?>" alt="<?php echo htmlspecialchars_decode($post->post_title);?>">
								<span class="blog-item-tag"><?php echo htmlspecialchars_decode($category[0]->name); ?></span>
								<div class="blog-compact-item-content">
									<ul class="blog-post-tags">
										<li><?php echo $date;?></li>
									</ul>
									<h3><?php echo htmlspecialchars_decode($post->post_title); ?></h3>
									<p><?php echo htmlspecialchars_decode($post_description); ?></p>
								</div>
							</div>
						</a>
					</div>
                <?php endforeach;wp_reset_query();?>
					<!-- Blog post Item / End -->
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;?>