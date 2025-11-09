
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

function toggleTTDTextbox() {
    var dropdown = document.getElementById("TA_dropdown");
    var textboxDiv = document.getElementById("TA_textbox");

    if (dropdown.value === "Yes") {
        textboxDiv.style.display = "flex";
    } else {
        textboxDiv.style.display = "none";
    }
}

function toggleHOSTTextbox() {
    var dropdown = document.getElementById("host_dropdown");
    var textboxDiv = document.getElementById("host_textbox");

    if (dropdown.value === "Yes") {
        textboxDiv.style.display = "flex";
    } else {
        textboxDiv.style.display = "none";
    }
}

function toggleTPIFields() {
    var dropdown1 = document.getElementById("TPI_dropdown");
    var fields = document.getElementById("ttd_fields");

    if (dropdown1.value === "Yes") {
        fields.style.display = "flex";
    } else {
        fields.style.display = "none";
    }
}

function toggleSellerFields() {
    var dropdown2 = document.getElementById("seller_dropdown");
    var fields1 = document.getElementById("seller_fields");

    if (dropdown2.value === "Yes") {
        fields1.style.display = "flex";
    } else {
        fields1.style.display = "none";
    }
}

function toggleTextbox(checkboxId, textboxId) {
    var checkbox = document.getElementById(checkboxId);
    var textbox = document.getElementById(textboxId);

    if (checkbox.checked) {
        textbox.style.display = "flex";
    } else {
        textbox.style.display = "none";
    }
}

function resetForm() {
    document.getElementById("submit").reset();
    document.querySelectorAll("#DBA_textbox, #DBAA_textbox, #TA_textbox, #ttd_fields, #textbox1, #textbox2, #textbox3, #textbox4, #seller_fields, #host_textbox")
        .forEach(el => el.style.display = "none");
}


		

(function ($) {
    
    $(document).ready(function () {
        $('.doc-generator-form').on('submit', function (e) {
            $('.download-doc-success-message').css('display', 'block');
        })

        $('.close-btn').on('click', function (e) {
            $('.download-doc-success-message').css('display', 'none');
        })
    })

})(jQuery);