var currDate = '';

function initWork() {
    try {
        // Get today's date in Hijri format
        currDate = HijriJS.today().toString().slice(0, -1); // Remove 'H' from the year
        $('#today').html(currDate); // Display the current date

        // Set the date input field for the datepicker
        //$('#datepicker').val(currDate);
    } catch (error) {
        console.error('Error initializing date:', error);
    }
}

$(function() {
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dayNamesMin: ["س", "ج", "خ", "ر", "ث", "ن", "ح"], // Arabic day names
        dateFormat: "yy-mm-dd", // Set format to dd-mm-yyyy
        monthNames: [
            "محرم", "صفر", "ربيع الأول", "ربيع الثاني", 
            "جمادى الأول", "جمادى الثاني", "رجب", 
            "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"
        ],
        yearRange: "c-578:c-577", // Hijri year range
        monthNamesShort: [
            "محرم", "صفر", "ربيع ١", "ربيع ٢", 
            "جمادى ١", "جمادى ٢", "رجب", 
            "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"
        ],
        showAnim: 'bounce'
    });
});

// Call initWork to initialize the date when the page loads
$(document).ready(initWork);
