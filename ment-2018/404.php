<?php 
global $qode_options_passage; 

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

?>	

<?php get_header(); ?>
<div class="title animate <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
				<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
				<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<?php if($title_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix">
					<?php } ?>
					
					<?php
if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('
<p id="breadcrumbs">','</p>
');
}
?>
					
					<h1>Page Not Found</h1>
					<?php if($title_in_grid){ ?>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
			

			
			<div class="container top_move">
				<div class="container_inner">
					<div class="container_inner2 clearfix">
						<div class="page_not_found">
							<h2><?php if($qode_options_passage['404_text'] != ""): echo $qode_options_passage['404_text']; else: ?> <?php _e('Whoops!', 'qode'); ?> <?php endif;?></h2>
							<h3>We were unable to find that specific page. Maybe it's one of these?</h3>

							<ul class="menu"><li><a href="/about-ment-law-group-llc/">About Us</a>
<ul class="sub-menu">
	<li><a href="/about-ment-law-group-llc/attorney-jeffrey-l-ment/">Attorney Jeffrey L. Ment</a></li>
	<li><a href="/about-ment-law-group-llc/attorney-misty-r-percifield/">Attorney Misty R. Percifield</a></li>
	<li><a href="/about-ment-law-group-llc/attorney-kristin-shubert/">Attorney Kristin Shubert</a></li>
</ul>
</li>
<li><a href="/law-enforcement/">Law Enforcement</a>
<ul class="sub-menu">
	<li><a href="/law-enforcement/compensation-for-injured-police-officers/">Compensation for Injuries</a></li>
	<li><a href="/law-enforcement/critical-incidents-in-law-enforcement/">Critical incidents</a></li>
	<li><a href="/law-enforcement/police-labor-issues/">Police Labor Issues</a></li>
</ul>
</li>
<li><a href="/travel-industry-attorney/">Travel Industry</a>
<ul class="sub-menu">
	<li><a href="/travel-industry-attorney/crisis-management-in-the-travel-industry/">Crisis Management</a></li>
	<li><a href="/travel-industry-attorney/travel-industry-policies-and-contracts/">Policies and Contracts</a></li>
	<li><a href="/travel-industry-attorney/travel-industry-regulation-and-compliance/">Regulation and Compliance</a></li>
</ul>
</li>
<li><a href="/connecticut-civil-litigation-lawyer/">Civil Litigation</a></li>
<li><a href="/areas-served/">Areas Served</a></li>
<li><a href="/contact-ment-law-group-llc/">Contact Us</a></li>
</ul>

							<p><a href="<?php echo home_url(); ?>/"><?php if($qode_options_passage['404_backlabel'] != ""): echo $qode_options_passage['404_backlabel']; else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a></p>
						</div>
					</div>
				</div>
			</div>
			
<?php get_footer(); ?>	