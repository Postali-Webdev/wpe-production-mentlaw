<?php 
/*
Template Name: Form Download
*/ 

require_once dirname( __FILE__ ) . '/generate_doc1.php'; // Custom Post Type Attorneys
?>
	<?php get_header(); ?>

		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
			<div class="title animate has_background" style="background-image:url(/wp-content/uploads/2018/05/header_areasServed.jpg); height:px;">
				<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
				<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<?php if($title_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix">
					<?php } ?>
					<h1><?php the_title(); ?></h1>
					<?php if($title_in_grid){ ?>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if($qode_options_passage['show_back_button'] == "yes") { ?>
			<a id='back_to_top' href='#'>
				<span class='back_to_top_inner'>
					<span>&nbsp;</span>
				</span>
			</a>
		<?php } ?>
		
		<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){
			echo do_shortcode($revslider);
		}
		?>
	<div class="full_width">
		<div class="textpanel">
            <div class="container_inner">
                    <?php the_content(); ?>		
            </div>
        </div>
	</div>
	<?php get_footer(); ?>			