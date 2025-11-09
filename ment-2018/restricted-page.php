<?php 
/*
Template Name: Restricted Page
*/

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Form has been submitted, process the data
    
// }

require_once dirname( __FILE__ ) . '/generate_doc1.php';

?>

<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

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
			<div class="title animate <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
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
					
			   <form action="./download-form/generate_doc1.php" method="POST" enctype="multipart/form-data" class="doc-generator-form" id="submit">
					<!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="doc-generator-form" id="submit"> -->
            
                        <div class="form-group">
                            <label for="legal_name">Formal Legal Name:</label>
                            <input type="text" id="legal_name" name="legal_name" required>
                        </div>

                        <div class="form-group">
                            <label for="DBA_dropdown">DBA Name:</label>
                            <select id="DBA_dropdown" name="DBA_option" onchange="toggleDBATextbox()" required>
                                <option value="">Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="form-group" id="DBA_textbox">
                            <label for="DBA_text">DBA:</label>
                            <input type="text" id="DBA_text" name="DBA_text">
                        </div>
                        <div class="form-group" id="DBAA_textbox">
                            <label for="DBAA_text">Legal Entity Name:</label>
                            <input type="text" id="DBAA_text" name="DBAA_text">
                        </div>

                    <div class="form-group">
                            <label for="AGENCY">Agency:</label>
                            <select id="AGENCY" name="AGENCY" required>
                                <option value="">Select</option>
                                <option value="Limited Liability Company">Limited Liability Company</option>
                                <option value="Corporation">Corporation</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="host_dropdown">Host Agency:</label>
                            <select id="host_dropdown" name="host_option" onchange="toggleHOSTTextbox()" required>
                                <option value="">Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="form-group" id="host_textbox">
                            <label for="host_text">Host Name:</label>
                            <input type="text" id="host_text" name="host_text">
                        </div>

                        <div class="form-group">
                            <label for="text_box">Offering:</label>
                            <input type="text" id="text_box" name="text_box">
                        </div>

                        <div class="form-group">
                            <label for="brand_logo">Brand Logo:</label>
                            <input type="file" id="brand_logo" name="brand_logo" accept=".jpg, .jpeg, .png" required>
                        </div>

                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="selected_date" required>
                        </div>

                        <div class="form-group">
                    <label for="brand_url">Client Page URL:</label>
                        <input type="url" id="text_box" name="brand_url" placeholder="Enter a valid URL" required>
                        </div>

                        <div class="form-group">
                            <label for="depart_days">Departure Days:</label>
                            <input type="text" id="depart_days" name="depart_days">
                        </div>

                        <div class="form-group">
                            <label for="weeks">Itinerary Time Period:</label>
                            <input type="text" id="weeks" name="weeks">
                        </div>

                    <div class="form-group">
                            <label for="planning">Planning Fee:</label>
                            <select id="planning" name="planning" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                    <div class="form-group">
                            <label for="changes">Changes:</label>
                            <select id="changes" name="changes" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                    <div class="form-group">
                            <label>Select One (Required):</label>
                            <input type="radio" name="selection" value="traveler" checked> Traveler
                            <input type="radio" name="selection" value="booking"> Booking
                            <input type="radio" name="selection" value="room"> Room
                        </div>

                        <div class="form-group" id="amount">
                            <label for="amount">Amount:</label>
                            <input type="text" id="amount" name="amount">
                        </div>

                        <div class="form-group" id="cancel">
                            <label for="cancel">Cancellation Charges by traveler:</label>
                            <input type="text" id="cancel" name="cancel">
                        </div>

                        <div class="form-group">
                            <label for="TPI_dropdown">TPI:</label>
                            <select id="TPI_dropdown" name="TPI_option" onchange="toggleTPIFields()" required>
                                <option value="">Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div id="ttd_fields" style="display: none;">
                        <div class="form-group" id="TPI_textbox">
                            <label for="TPI_text1">Name:</label>
                            <input type="text" id="TPI_text1" name="TPI_text1">
                        </div>
                        <div class="form-group" id="TPI_textbox">
                            <label for="TPI_text2">Email:</label>
                            <input type="text" id="TPI_text2" name="TPI_text2">
                        </div>
                        <div class="form-group" id="TPI_textbox">
                            <label for="TPI_text3">Call:</label>
                            <input type="text" id="TPI_text3" name="TPI_text3">
                        </div>
                        <div class="form-group" id="TPI_textbox">
                            <label for="TPI_text4">Reference:</label>
                            <input type="text" id="TPI_text4" name="TPI_text4">
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="LLC">Non-Responsibility:</label>
                            <select id="LLC" name="LLC" required>
                                <option value="">Select</option>
                                <option value="llc">LLC</option>
                                <option value="corporate">Corporate</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jury">Notice of Claim:</label>
                            <input type="text" id="jury" name="jury" required>
                        </div>

                        <div class="form-group">
                            <label for="county">County:</label>
                            <input type="text" id="county" name="county" required>
                        </div>

                    <div class="form-group">
                            <label for="state">State:</label>
                            <select id="state" name="state" required>
                                <option value="">Select State</option>
                                <option value="Alabama">Alabama</option>
                                <option value="Alaska">Alaska</option>
                                <option value="Arizona">Arizona</option>
                                <option value="Arkansas">Arkansas</option>
                                <option value="California">California</option>
                                <option value="Colorado">Colorado</option>
                                <option value="Connecticut">Connecticut</option>
                                <option value="Delaware">Delaware</option>
                                <option value="Florida">Florida</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Hawaii">Hawaii</option>
                                <option value="Idaho">Idaho</option>
                                <option value="Illinois">Illinois</option>
                                <option value="Indiana">Indiana</option>
                                <option value="Iowa">Iowa</option>
                                <option value="Kansas">Kansas</option>
                                <option value="Kentucky">Kentucky</option>
                                <option value="Louisiana">Louisiana</option>
                                <option value="Maine">Maine</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Massachusetts">Massachusetts</option>
                                <option value="Michigan">Michigan</option>
                                <option value="Minnesota">Minnesota</option>
                                <option value="Mississippi">Mississippi</option>
                                <option value="Missouri">Missouri</option>
                                <option value="Montana">Montana</option>
                                <option value="Nebraska">Nebraska</option>
                                <option value="Nevada">Nevada</option>
                                <option value="New Hampshire">New Hampshire</option>
                                <option value="New Jersey">New Jersey</option>
                                <option value="New Mexico">New Mexico</option>
                                <option value="New York">New York</option>
                                <option value="North Carolina">North Carolina</option>
                                <option value="North Dakota">North Dakota</option>
                                <option value="Ohio">Ohio</option>
                                <option value="Oklahoma">Oklahoma</option>
                                <option value="Oregon">Oregon</option>
                                <option value="Pennsylvania">Pennsylvania</option>
                                <option value="Rhode Island">Rhode Island</option>
                                <option value="South Carolina">South Carolina</option>
                                <option value="South Dakota">South Dakota</option>
                                <option value="Tennessee">Tennessee</option>
                                <option value="Texas">Texas</option>
                                <option value="Utah">Utah</option>
                                <option value="Vermont">Vermont</option>
                                <option value="Virginia">Virginia</option>
                                <option value="Washington">Washington</option>
                                <option value="West Virginia">West Virginia</option>
                                <option value="Wisconsin">Wisconsin</option>
                                <option value="Wyoming">Wyoming</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address_1">Address Line 1:</label>
                            <input type="text" id="address_1" name="address_1" required>
                        </div>

                        <div class="form-group">
                            <label for="address_2">Address Line 2:</label>
                            <input type="text" id="address_2" name="address_2">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="attn">Attn:</label>
                            <input type="text" id="attn" name="attn" required>
                        </div>

                    <div class="form-group checkbox-group">
                        <label>Seller of Travel:</label><br>
                        <div class="checkbox-wrapper">
                           <div class="checkbox"><input type="checkbox" id="checkbox1" onchange="toggleTextbox('checkbox1', 'textbox1')"> <p>California</p></div>
                           <div class="checkbox"><input type="checkbox" id="checkbox2" onchange="toggleTextbox('checkbox2', 'textbox2')"> <p>Florida</p></div>
                           <div class="checkbox"><input type="checkbox" id="checkbox3" onchange="toggleTextbox('checkbox3', 'textbox3')"> <p>Washington</p></div>
                           <div class="checkbox"><input type="checkbox" id="checkbox4" onchange="toggleTextbox('checkbox4', 'textbox4')"> <p>Hawaii</p></div>
                        </div>
                        </div>

                        <div class="form-group" id="textbox1" style="display: none;">
                        <label for="input1">California Ref No:</label>
                        <input type="text" id="input1" name="input1">
                        </div>
                        <div class="form-group" id="textbox2" style="display: none;">
                        <label for="input2">Florida Ref No:</label>
                        <input type="text" id="input2" name="input2">
                        </div>
                        <div class="form-group" id="textbox3" style="display: none;">
                        <label for="input3">Washington Ref No:</label>
                        <input type="text" id="input3" name="input3">
                        </div>
                        <div class="form-group" id="textbox4" style="display: none;">
                        <label for="input4">Hawaii:</label>
                        <input type="text" id="input4" name="input4">
                        </div>
                                
                        <div class="button-container">
                            <button type="submit">Generate Document</button>
                        </div>
                    </form>
					<div class="download-doc-success-message"><p>Thank you for your submission! Your document should automatically download. If your document has not downloaded, make sure to allow the download from your browser.</p>
					<p><strong><span style="color:#ff0000;">Notice!</span></strong> When opening your generated Microsoft Word document, you may encounter a message that says: <em>"Word found unreadable content in "generated.docx". Do you want to recover the contents of this document? If you trust the source of this document, click Yes."</em> Click <strong>YES</strong> to view your personalized document.</p></div>
            </div>
        </div>
	</div>
	<?php get_footer(); ?>			