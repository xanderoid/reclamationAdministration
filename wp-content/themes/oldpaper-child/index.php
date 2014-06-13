<?php get_header() ?>
	

	
	<section id="content" class="container">
		<div class="wrapper">
		
			<div class="row">
			<div id="main" class="col-lg-9 col-sm-8">
				
				<?php if($paged==1 and $iw_opt['showfeatured']) : ?>
				<div id="featured" class="wrapper">
				
					<h2><?php echo($iw_opt['titlefeatured']) ?></h2>
					
					<div class="row">
					
					<?php get_template_part('part', 'featured') ?>
					
					</div>
					
				</div>
				<?php endif; ?>
				
				<div id="articlelist">
				<?php
				
					/*
				
					standard article list
				
					*/
					
					$args = array(
						'paged' => $paged,
						'ignore_sticky_posts' => 1,
						//commented out so all posts appear in blogroll
						//'offset' => 4 + ( get_option('posts_per_page') * ($paged-1) ),
						'posts_per_page' => get_option('posts_per_page')
					);
							
					$query = new WP_Query( $args );
								
				if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
					
						get_template_part('loop', 'archive');
					
					endwhile;
				
				?>
				
				</div>
				
				<div class="row">
					<div class="col-xs-6">
						<?php next_posts_link( '<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-long-arrow-left fa-stack-1x fa-inverse"></i>
						</span>', $query->max_num_pages ); ?>
					</div>
					<div class="col-xs-6 text-right">
						<?php previous_posts_link( '<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-long-arrow-right fa-stack-1x fa-inverse"></i>
						</span>' ); ?>
					</div>
				</div>
				
				<?php
					
				endif;
					
				wp_reset_postdata();
					
				?>
			
			</div>
			
			<aside class="col-lg-3 col-sm-4">
			
				<?php if($paged==1){ get_template_part('part', 'editorial'); } ?>
				
				<?php get_sidebar() ?>


				
			</aside>	
		</div> <!-- /row featured -->
			
		</div>
	</section>
	
<?php get_footer() ?>