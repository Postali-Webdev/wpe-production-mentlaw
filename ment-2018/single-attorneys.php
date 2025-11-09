<?php 
/*
Template Name: Full Width with Breadcrumb
*/ 
?>

<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  
$background_img = get_field('banner_image'); 

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_passage['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_passage['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_passage['title_image'];
}

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
?>
	<?php get_header(); ?>
		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
            <div class="title animate <?php echo $background_img ? 'has_background' : 'no_background'; ?>" style="background-image:url('<?php echo $background_img; ?>');">

				<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
				<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<?php if($title_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix">
					<?php } ?>
					<p id="breadcrumbs"><span><span><a href="/">Home</a>  <span><a href="/about/">About The Ment Law Group, PC</a>  </span></span></span></p>
					
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
        <?php the_field('bio_intro'); ?>

        <div class="textpanel">
            <div class="container_inner">
                <div class="two_columns_66_33 clearfix">
                    <div class="column1"> 
                        <div class="column_inner">
                            <?php the_field('bio');  ?>
                        </div>
                    </div>
                    <div class="column2">
                        <div class="column_inner">
                            <div class="attorney-sidebar">
                                <?php the_field('our_attorneys_sidebar'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div id="personalAttention">
		<section class="parallax">
			<section id="1" style="background-image: url(&quot;/wp-content/uploads/2018/06/parallax_bio.jpg&quot;); height: 175px; background-position: center 2.58893px;" data-height="175" data-title="...">
				<div class="parallax_content">
					<div class="container_inner">
						<h2>Personal Attention &amp; Knowledgeable Methods</h2>
						<div class="two_columns_50_50 clearfix">
							<div class="column1">
								<div class="column_inner">
									<p>Whatever your specific legal needs, at <a title="Ment Law Group, PC" href="/about/">The Ment Law Group, PC</a>, we are committed to making every client feel valued and understood. From major travel corporations to individuals dealing with serious legal challenges, we will give you our full attention and every available resource. When we are your legal representation or counsel, you can rely on prompt responses to any question, thoughtful approaches to your issues, and every ounce of our collective experience being brought to bear.</p>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									<p>With offices located in Hartford, CT, we serve individual clients throughout Connecticut and New York. Our travel clients are from around the globe and we are available when they need us – no matter what time zone they are located in!To personally discuss your legal needs with a member of The Ment Law Group, PC, <strong>call 866-MENT-LAW</strong> or <a title="Contact Us" href="/contact/">contact us online</a> to schedule an appointment.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</div>
	<?php get_footer(); ?>			