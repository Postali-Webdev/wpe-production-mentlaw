<?php
require_once(ABSPATH . 'wp-content/mu-plugins/vendor/autoload.php');
// print_r($_POST);

use PhpOffice\PhpWord\TemplateProcessor;

// Function to convert number to words
function numberToWords($num) {
    $words = [
        0 => "zero", 1 => "one", 2 => "two", 3 => "three", 4 => "four",
        5 => "five", 6 => "six", 7 => "seven", 8 => "eight", 9 => "nine",
        10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen",
        15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen",
        20 => "twenty", 30 => "thirty", 40 => "forty", 50 => "fifty", 60 => "sixty",
        70 => "seventy", 80 => "eighty", 90 => "ninety"
    ];

    if ($num < 20) {
        return $words[$num];
    } elseif ($num < 100) {
        return $words[floor($num / 10) * 10] . ($num % 10 != 0 ? " " . $words[$num % 10] : "");
    } elseif ($num < 1000) {
        return $words[floor($num / 100)] . " Hundred" . ($num % 100 != 0 ? " and " . numberToWords($num % 100) : "");
    } else {
        return (string)$num; // Extend for larger numbers if needed
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $templateProcessor = new TemplateProcessor( ABSPATH . 'wp-content/mu-plugins/template-docs/template.docx');
    $templateProcessor = new TemplateProcessor( ABSPATH . 'wp-content/mu-plugins/template-docs/template_p.docx');
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //  Choose the correct template
    $planningFees = trim($_POST['planning']);
    $templateFile = ($planningFees === "Yes") ? ABSPATH . 'wp-content/mu-plugins/template-docs/template.docx' : ABSPATH . 'wp-content/mu-plugins/template-docs/template_p.docx';

    // Load the selected template
    $templateProcessor = new TemplateProcessor($templateFile);

    // Get form values
    $weeksInput = isset($_POST['weeks']) ? (int)$_POST['weeks'] : 0;
    $weeksInWords = numberToWords($weeksInput); // Convert number to words
    $legalName = $_POST['legal_name'];
    $dbaOption = $_POST['DBA_option'];
$dbaText = trim($_POST['DBA_text']);           // Input DBA Name
$dbaTextCaps = strtoupper($dbaText);           // CAPS version of DBA Name
$dbaaText = trim($_POST['DBAA_text']);         // Input Legal/Doc Name
$dbaaTextCaps = strtoupper($dbaaText);    $departureDays = !empty($_POST['departure_days']) ? $_POST['departure_days'] : '60';
    $planningFees = trim($_POST['planning']);
    $changes = $_POST['changes']; 
    $selection = $_POST['selection']; 
    $amount = $_POST['amount']; 
    $cancel = $_POST['cancel']; 
    $ttdOption = $_POST['TPI_option'];
    $tpiName = $_POST['TPI_text1'];
    $tpiEmail = $_POST['TPI_text2'];
    $tpiCall = $_POST['TPI_text3'];
    $tpiReference = $_POST['TPI_text4'];
    $llcType = $_POST['LLC'];
    $juryEmail = strtoupper($_POST['jury']);
    $countyName = $_POST['county'];
    $stateName = $_POST['state'];
    $addressName1 = strtoupper($_POST['address_1']);
    $addressName2 = strtoupper($_POST['address_2']);
    $email = strtoupper($_POST['email']);
    $attn = strtoupper($_POST['attn']);
    $hostAgency = $_POST['host_option'];
    $clientPageURL = $_POST['brand_url'];
    $hostDetails = $_POST['host_text'];
    $date = $_POST['selected_date'];
    $agency = $_POST['AGENCY'];
    $offering = $_POST['text_box'];

function formatDate($date) {
    $timestamp = strtotime($date);
    $day = date('j', $timestamp);
    $month = date('F', $timestamp);
    $year = date('Y', $timestamp);

    // Determine the correct ordinal suffix (st, nd, rd, th)
    if ($day % 10 == 1 && $day != 11) {
        $suffix = "st";
    } elseif ($day % 10 == 2 && $day != 12) {
        $suffix = "nd";
    } elseif ($day % 10 == 3 && $day != 13) {
        $suffix = "rd";
    } else {
        $suffix = "th";
    }

    return strtoupper($month . " " . $day . $suffix .", " . $year);
}

// Get the date from the form
$rawDate = $_POST['selected_date'];
$formattedDate = formatDate($rawDate);

    // Replace text placeholders
    $templateProcessor->setValue('LEGAL_NAME', $legalName);
    $templateProcessor->setValue('BRAND_URL', $clientPageURL);

if ($dbaOption === "Yes") {
    $templateProcessor->setValue('DBA_NAME', $dbaText);          // for regular use
    $templateProcessor->setValue('DBA_NAME1', $dbaTextCaps);     // for all caps use
} else {
    $templateProcessor->setValue('DBA_NAME', $dbaaText);         // fallback name
    $templateProcessor->setValue('DBA_NAME1', $dbaaTextCaps);    // fallback caps
}

    $templateProcessor->setValue('DEPARTURE_DAYS', $departureDays);
    $templateProcessor->setValue('AMOUNT', $amount);
    $templateProcessor->setValue('OFFERING', $offering);
    $templateProcessor->setValue('AGENCY', $agency);
    $templateProcessor->setValue('CANCEL', $cancel);
    $templateProcessor->setValue('SELECTION', $selection);
    $templateProcessor->setValue('JURYEMAIL', $juryEmail);
    $templateProcessor->setValue('COUNTY', $countyName);
    $templateProcessor->setValue('STATE', $stateName);
    $templateProcessor->setValue('ADDRESS1', $addressName1);
    $templateProcessor->setValue('ADDRESS2', $addressName2);
    $templateProcessor->setValue('EMAIL', $email);
    $templateProcessor->setValue('ATTN', $attn);
    $templateProcessor->setValue('HOST_DETAILS', $hostDetails);
    $templateProcessor->setValue('DATE', $formattedDate);
    $templateProcessor->setValue('WEEKS_PLACEHOLDER', $weeksInWords);
    $selectedOptions = [];
    
    if (!empty($_POST['input1'])) {
        $selectedOptions[] = "California Seller of Travel Ref. No: " . $_POST['input1'];
    }
    if (!empty($_POST['input2'])) {
        $selectedOptions[] = "Florida Seller of Travel Ref. No: " . $_POST['input2'];
    }
    if (!empty($_POST['input3'])) {
        $selectedOptions[] = "Washington Seller of Travel Ref. No: " . $_POST['input3'];
    }
    if (!empty($_POST['input4'])) {
        $selectedOptions[] = "Hawaii Seller of Travel Ref. No: " . $_POST['input4'];
    }

    if (!empty($selectedOptions)) {
        $templateProcessor->setValue('HEADING_SECTION', "SELLER OF TRAVEL: As an independent affiliate of $hostDetails, a Virtuoso Member Agency");

        // Use a line break instead of a comma
        $formattedText = implode("\n", $selectedOptions);
        
        // Ensure line breaks work in Word documents
        $formattedText = str_replace("\n", "</w:t><w:br/><w:t>", $formattedText);

        $templateProcessor->setValue('PLACEHOLDER', $formattedText);
    } else {
        // Remove the heading and placeholder if no selection
        $templateProcessor->setValue('HEADING_SECTION', '');
        $templateProcessor->setValue('PLACEHOLDER', '');
    }

//Host agency addition
if ($hostAgency === "Yes") {
    $templateProcessor->setValue('HOST_AGENCY', ", an affiliate of $hostDetails");
} else {
    $templateProcessor->setValue('HOST_AGENCY', '');
}

//Document Name
if ($dbaOption === "Yes") {
    $dcnText = "$legalName is doing business as $dbaText,";
} else {
    $dcnText = "$legalName";
}
$templateProcessor->setValue('DCN', $dcnText);

//client URL addition
if ($hostAgency === "Yes") {
    $templateProcessor->setValue('CLIENT_PAGE_URL', $clientPageURL);
} else {
    $templateProcessor->setValue('CLIENT_PAGE_URL', '');
}

    // Handle Planning Fees Removal
    if ($planningFees === "No") {
        $templateProcessor->setValue('PLANNING_FEES_SECTION', '');
    } else {
        $templateProcessor->setValue('PLANNING_FEES_SECTION', 'PLANNING FEES. Although our work on your travel experience begins when you agree to book your travel with us, the planning process begins long before that. We pride ourselves on years of experience planning travel, educating ourselves, building relationships, and networking with our suppliers to provide our clients with the best options for their travel needs. Our custom proposals often take many hours of planning, researching, and communicating with suppliers to confirm the custom details for your travel plans. To compensate for our experience, time, and effort, we charge a planning fee that varies depending on the type of group, length of stay, destination(s), number of travelers in the group, extent of planning involved, and the general complexity of your trip.  You agree to full payment of our planning fee prior to receipt of any proposal. Our planning fees are always NON-REFUNDABLE, regardless of whether you choose to book with us, or cancel for any reason.');
    }

    // Handle Changes Section
    if ($changes === "No") {
        $templateProcessor->setValue('CHANGES_SECTION', '');
    } else {
        $templateProcessor->setValue('CHANGES_SECTION', "For certain changes, we may charge a change fee starting at $$amount per $selection");
    }

    // Handle TPI Section
    if ($changes === "No") {
        $templateProcessor->setValue('TPI_SECTION', '');
    } else {
        $templateProcessor->setValue('TPI_SECTION', "$dbaText works with a reputable travel insurance industry leader, $tpiName. For more information on the available plans contact Travelex Insurance at $tpiEmail or call $tpiCall and reference $tpiReference. ");
    }

// Define the replacement text based on selection
$nonResponsibilityText = ($llcType === "llc") 
    ? "members, managers, president, owner(s), employees, affiliates, agents, and representatives." 
    : "directors, board members, president, chairpersons, officers, owner(s), shareholders, employees, affiliates, agents, and representatives.";

// Replace the placeholder in the document
$templateProcessor->setValue('NON_RESPONSIBILITY', $nonResponsibilityText);



    // Handle brand logo upload
    if (isset($_FILES['brand_logo']) && $_FILES['brand_logo']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $logoPath = $uploadDir . basename($_FILES['brand_logo']['name']);

        if (move_uploaded_file($_FILES['brand_logo']['tmp_name'], $logoPath)) {
            // Replace image placeholder
            $templateProcessor->setImageValue('BrandLogo', [
                'path' => $logoPath,
                'width' => 100,
                'height' => 100
            ]);
        }
    }

    // Save and output the document
    $outputFile = 'generated.docx';
    $templateProcessor->saveAs($outputFile);

    // Force download
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=" . basename($outputFile));
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    readfile($outputFile);
    exit;
}
}
?>
