(function ($) {
    $.calendars.calendars.ummalqura.prototype.regionalOptions['ar'] = {
        name: 'UmmAlQura', // The calendar name
        epochs: ['BAM', 'AM'],
        monthNames: ['المحرّم', 'صفر', 'ربيع الأول', 'ربيع الثاني', 'جمادى الاول', 'جمادى الآخر', 'رجب', 'شعبان', 'رمضان', 'شوّال', 'ذو القعدة', 'ذو الحجة'],
        monthNamesShort: ['المحرّم', 'صفر', 'ربيع 1', 'ربيع 2', 'جمادى 1', 'جمادى 2', 'رجب', 'شعبان', 'رمضان', 'شوّال', 'ذو القعدة', 'ذو الحجة'],
        dayNames: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
        dayNamesMin: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
        dayNamesShort: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
        digits: $.calendars.substituteDigits(['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩']),
        dateFormat: 'yyyy/mm/dd', // See format options on BaseCalendar.formatDate
        firstDay: 6, // The first day of the week, Sat = 0, Sun = 1, ...
        isRTL: true // True if right-to-left language, false if left-to-right
    };
})(jQuery);

   $(function() {
    $( "#datepicker" ).datepicker( $.datepicker.regional[ "ar" ] );
  });