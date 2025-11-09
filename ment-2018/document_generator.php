<?php
session_start();

// If the user is not authenticated, redirect to login page
if (!isset($_SESSION["authenticated"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ment Law</title>
    <style>
        body {
            background: url('logo (1).png') no-repeat top left;
            background-size: 15%;
            background-color: #f3f3f4;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 22px;
            color: #00796b;
            text-align: center;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        label {
            flex: 1;
            color: #00796b;
            font-weight: bold;
        }
        input[type="text"], select, input[type="file"], input[type="date"], input[type="url"] {
            flex: 2;
            padding: 8px;
            border: 1px solid #b2dfdb;
            border-radius: 5px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        button {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
.logout-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            background-color: red;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: darkred;
        }
        button:hover {
            background-color: #004d40;
        }
        #TA_textbox, #DBA_textbox, #DBAA_textbox, #host_textbox {
            display: none;
        }
	#ttd_fields {
        display: none;
        flex-direction: column; /* Ensures textboxes appear in a column */
        gap: 10px; /* Adds spacing between inputs */
    }
#input1 {
    display: block !important;
}
    </style>
    <script>
        function toggleDBATextbox() {
            var dropdown = document.getElementById("DBA_dropdown");
            var dbaTextbox = document.getElementById("DBA_textbox");
            var legalTextbox = document.getElementById("DBAA_textbox");

            // Hide both initially
            dbaTextbox.style.display = "none";
            legalTextbox.style.display = "none";

            if (dropdown.value === "Yes") {
                dbaTextbox.style.display = "flex";  // Show DBA Name
            } else if (dropdown.value === "No") {
                legalTextbox.style.display = "flex";  // Show Legal Entity Name
            }
        }
    </script>
    <script>
        function toggleTTDTextbox() {
            var dropdown = document.getElementById("TA_dropdown");
            var textboxDiv = document.getElementById("TA_textbox");

            if (dropdown.value === "Yes") {
                textboxDiv.style.display = "flex";
            } else {
                textboxDiv.style.display = "none";
            }
        }
    </script>
    <script>
        function toggleHOSTTextbox() {
            var dropdown = document.getElementById("host_dropdown");
            var textboxDiv = document.getElementById("host_textbox");

            if (dropdown.value === "Yes") {
                textboxDiv.style.display = "flex";
            } else {
                textboxDiv.style.display = "none";
            }
        }
    </script>
    <script>
        function toggleTPIFields() {
            var dropdown1 = document.getElementById("TPI_dropdown");
            var fields = document.getElementById("ttd_fields");

            if (dropdown1.value === "Yes") {
                fields.style.display = "flex";
            } else {
                fields.style.display = "none";
            }
        }
    </script>
    <script>
        function toggleSellerFields() {
            var dropdown2 = document.getElementById("seller_dropdown");
            var fields1 = document.getElementById("seller_fields");

            if (dropdown2.value === "Yes") {
                fields1.style.display = "flex";
            } else {
                fields1.style.display = "none";
            }
        }
    </script>
    <script>
    function toggleTextbox(checkboxId, textboxId) {
        var checkbox = document.getElementById(checkboxId);
        var textbox = document.getElementById(textboxId);

        if (checkbox.checked) {
            textbox.style.display = "flex";
        } else {
            textbox.style.display = "none";
        }
    }
    </script>
     <script>
        function resetForm() {
            document.getElementById("submit").reset();
            document.querySelectorAll("#DBA_textbox, #DBAA_textbox, #TA_textbox, #ttd_fields, #textbox1, #textbox2, #textbox3, #textbox4, #seller_fields, #host_textbox")
                .forEach(el => el.style.display = "none");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Document Generator</h1>
        <form action="generate_doc1.php" method="POST" enctype="multipart/form-data" id="submit">
            
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

	    <div class="form-group">
               <label>Seller of Travel:</label><br>
               <input type="checkbox" id="checkbox1" onchange="toggleTextbox('checkbox1', 'textbox1')"> California
               <input type="checkbox" id="checkbox2" onchange="toggleTextbox('checkbox2', 'textbox2')"> Florida
               <input type="checkbox" id="checkbox3" onchange="toggleTextbox('checkbox3', 'textbox3')"> Washington
               <input type="checkbox" id="checkbox4" onchange="toggleTextbox('checkbox4', 'textbox4')"> Hawaii
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
            	    </div>
		
            <div class="button-container">
                <button type="submit">Generate Document</button>
            </div>
        </form>

<!-- Logout Button -->
    <form action="logout.php" method="post">
        <button type="submit" class="logout-btn">Logout</button>
    </form>   


</div>
</body>
</html>