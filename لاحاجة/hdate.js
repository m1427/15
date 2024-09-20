        $(function() {
            // تهيئة التاريخ الهجري
            var $myDate = $('#datepicker');
        
            $myDate.hijriDate({
                showWeekDay: true,
                showGregDate: true,
                separator: '&nbsp;|&nbsp;',
                weekDayLang: 'ar',
                hijriLang: 'ar',
                gregLang: 'ar',
                correction: +1
            });
        });
 
        var currDate = '';

        function initWork() {
            // عرض التاريخ الحالي
            var todayElement = document.getElementById("today");
            todayElement.innerHTML = HijriJS.today().toString();

            // الحصول على التاريخ الحالي بالتقويم الهجري
            currDate = HijriJS.today().toString();
            // إزالة حرف الـ H من نهاية السنة الهجرية مثل 1440H، والتقليص بإزالة الحرف الأخير ليصبح 1440
            currDate = currDate.substring(0, currDate.length - 1);
            // إعادة تنسيق التاريخ من dd/mm/yyyy إلى dd-mm-yyyy
            currDate = currDate.split('/').join('-');
            // تعيين قيمة الحقل للتاريخ لـ currDate ليتم تعيينه كتاريخ افتراضي للتقويم تلقائياً
            $('#datepicker').val(currDate);
        }

        $(function() {
            // تهيئة التاريخ بواسطة datepicker من jQuery UI
            $("#datepicker").datepicker({
                changeMonth: true, // إظهار قائمة الشهور
                changeYear: true, // إظهار قائمة السنوات
                dayNamesMin: ["س", "ج", "خ", "ر", "ث", "ن", "ح"], // أسماء أيام الأسبوع بالعربية
                dateFormat: "dd-mm-yy", // تنسيق العرض للتاريخ إلى dd-mm-yyyy
                monthNames: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
                yearRange: "c-0:c+15", // نطاق السنوات في التقويم الهجري من السنة الحالية إلى +15 سنة
                monthNamesShort: ["محرم", "صفر", "ربيع ١", "ربيع ٢", "جمادى ١", "جمادى ٢", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
                showAnim: 'bounce' // تأثير الظهور
            });
        });
