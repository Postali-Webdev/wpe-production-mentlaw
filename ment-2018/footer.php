<?php global $qode_options_passage; ?>
				
		</div>
	</div>
		<footer>
			<div class="footer_holder clearfix">
				
						<div id="mobile-footer-contact">
							<a href="tel:1-860-918-1138" title="Call Ment Law Group">Call Now</a>
							<a href="sms:8609181138" title="Text Ment Law Group">Text Now</a>
						</div> 
						<?php	
						$display_footer_widget = false;
						if ($qode_options_passage['footer_widget_area'] == "yes") $display_footer_widget = true;
						if($display_footer_widget): ?> 
						<div class="footer_top_holder">
							<div class="footer_top">
								
								
									<?php
										$header_in_grid = false;
										if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

									?>
									
									<?php if($header_in_grid){ ?>
										<div class="container">
											<div class="container_inner clearfix">
									<?php } ?>
									<div class="footer_top_inner">
										<div class="three_columns clearfix">
											<div class="column1">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_1' ); ?>
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_2' ); ?>
												</div>
											</div>
											<div class="column3">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_3' ); ?>
												</div>
											</div>
										</div>
											
									</div>
									<?php if($header_in_grid){ ?>
										</div>
									</div>
								<?php } ?>
								
							</div>
						</div>
						<?php endif; ?>
						
						<?php
						$display_footer_text = false;
						if (isset($qode_options_passage['footer_text'])) {
							if ($qode_options_passage['footer_text'] == "yes") $display_footer_text = true;
						}
						if($display_footer_text): ?>
						<div class="footer_bottom_holder">
							<div class="footer_bottom">
								<?php dynamic_sidebar( 'footer_text' ); ?>
                                <?php if(is_page_template('front-page.php')) { ?>
                                <a href="https://www.postali.com" title="Site design and development by Postali" target="blank"><img src="https://www.postali.com/wp-content/themes/postali-site/img/postali-tag-reversed.png" alt="Postali | Results Driven Marketing" style="display:block; max-width:250px; margin:10px auto 10px;"></a>
                                <?php } ?>
                            </div>
						</div>
						<?php endif; ?>
			</div>
		</footer>
</div>
<?php
global $qode_toolbar;
if(isset($qode_toolbar)) include("toolbar.php")
?>
	<?php wp_footer(); ?>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700|Roboto+Slab:400,700" rel="stylesheet"> 
		
	
</body>
</html>