// Function to convert Arabic numbers to Latin numbers
function arToEn(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}

// Function to convert date to standard format
function convertDateToStandardFormat(input) {
    const supportedFormats = [
        { format: 'YYYY-MM-DD', separator: '-' },
        { format: 'DD-MM-YYYY', separator: '-' },
        { format: 'YYYY/MM/DD', separator: '/' },
        { format: 'DD/MM/YYYY', separator: '/' },
    ];

    let formattedDate = null;
    let validFormat = false;

    for (const formatObj of supportedFormats) {
        const parts = input.split(formatObj.separator);
        if (parts.length === 3) {
            let year, month, day;

            if (formatObj.format === 'YYYY-MM-DD' || formatObj.format === 'YYYY/MM/DD') {
                year = parts[0];
                month = parts[1].padStart(2, '0');
                day = parts[2].padStart(2, '0');
            } else if (formatObj.format === 'DD-MM-YYYY' || formatObj.format === 'DD/MM/YYYY') {
                day = parts[0].padStart(2, '0');
                month = parts[1].padStart(2, '0');
                year = parts[2];
            }

            if (isValidDate(year, month, day)) {
                formattedDate = `${year}-${month}-${day}`;
                validFormat = true;
                break;
            }
        }
    }

    if (validFormat) {
        return formattedDate;
    } else {
        return null;
    }
}

// Function to check if a date is valid
function isValidDate(year, month, day) {
    const date = new Date(year, month - 1, day);
    return date.getFullYear() === parseInt(year, 10) && date.getMonth() === parseInt(month, 10) - 1 && date.getDate() === parseInt(day, 10);
}

  /*
// Function to convert Arabic numbers to Latin numbers
function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
      const index = arabicDigits.indexOf(input[i]);
      if (index !== -1) {
        converted += latinDigits[index];
      } else {
        converted += input[i];
      }
    }
    return converted;
  }
  
  // Function to convert date to standard format
  function convertDateToStandardFormat(input) {
    const supportedFormats = [
      { format: 'YYYY-MM-DD', separator: '-' },
      { format: 'DD-MM-YYYY', separator: '-' },
      { format: 'YYYY/MM/DD', separator: '/' },
      { format: 'DD/MM/YYYY', separator: '/' },
    ];
  
   /* let formattedDate = null;
    let validFormat = false;
  
    for (const formatObj of supportedFormats) {
      const parts = input.split(formatObj.separator);
      if (parts.length === 3) {
        let year, month, day;
        if (supportedFormats === 'YYYY-MM-DD' || supportedFormats === 'YYYY/MM/DD') {
          year = parts[0];
          month = parts[1].padStart(2, '0');
          day = parts[2].padStart(2, '0');
        } else if (supportedFormats === 'DD-MM-YYYY' || supportedFormats === 'DD/MM/YYYY') {
          day = parts[0].padStart(2, '0');
          month = parts[1].padStart(2, '0');
          year = parts[2];
        }
  
       /* if (isValidDate(year, month, day)) {
          formattedDate = `${year}-${month}-${day}`;
          validFormat = true;
          break;
        }
      }
    //}
  
    if (validFormat) {
      return formattedDate;
    } else {
      return null;
    }
  //}
  
  // Function to check if a date is valid
  function isValidDate(year, month, day) {
    const date = new Date(year, month - 1, day);
    return date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;
  }
  
  // Function to convert date
  function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    if (!inputDate) {
      console.error("Input date is empty or null");
      return;
    }

    const convertedDate = convertArabicToLatinNumbers(inputDate);
    if (!convertedDate) {
      console.error("Failed to convert Arabic numbers to Latin");
      return;
    }

    const date = convertDateToStandardFormat(convertedDate);
  
    if (date) {
      const outputElement = document.getElementById("output");
      outputElement.innerText = date;
    } else {
      console.error("Invalid date format:", convertedDate);
    }
  }

  }

/*function convertArabicToGregorian(input) {
    // هنا يمكنك تعريف دالة تحويل التاريخ من الأرقام العربية إلى التاريخ المدني
    const parts = input.split('-');
    if (parts.length === 3) {
        const day = parts[0].trim();
        const month = parts[1].trim();
        const year = parts[2].trim();
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
    } else {
        return input; // إرجاع القيمة كما هي إذا لم تتمكن من التحويل
    }
}



function saveDate() {
    const inputDate = document.getElementById("arabicDate").value;
    const convertedDate = convertArabicToGregorian(inputDate);

    // إرسال البيانات إلى الصفحة نفسها باستخدام fetch
    fetch(bio.php {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ date: convertedDate }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('تم حفظ التاريخ في الصفحة نفسها:', data);
        // هنا يمكنك إضافة المنطق للتعامل مع الرد بعد حفظ التاريخ
        document.getElementById("output").innerText = 'تم حفظ التاريخ: ' + data.date;
    })
    .catch(error => {
        console.error('خطأ في حفظ التاريخ:', error);
        // هنا يمكنك إضافة التعامل مع الأخطاء إذا لزم الأمر
    });
}


// Function to convert Arabic numbers to Latin numbers
function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
      const index = arabicDigits.indexOf(input[i]);
      if (index !== -1) {
        converted += latinDigits[index];
      } else {
        converted += input[i];
      }
    }
    return converted;
  }
  
  // Function to convert date to standard format
  function convertDateToStandardFormat(input) {
    const supportedFormats = [
      { format: 'YYYY-MM-DD', separator: '-' },
      { format: 'DD-MM-YYYY', separator: '-' },
      { format: 'YYYY/MM/DD', separator: '/' },
      { format: 'DD/MM/YYYY', separator: '/' },
    ];
  
   /* let formattedDate = null;
    let validFormat = false;
  
    for (const formatObj of supportedFormats) {
      const parts = input.split(formatObj.separator);
      if (parts.length === 3) {
        let year, month, day;
        if (supportedFormats === 'YYYY-MM-DD' || supportedFormats === 'YYYY/MM/DD') {
          year = parts[0];
          month = parts[1].padStart(2, '0');
          day = parts[2].padStart(2, '0');
        } else if (supportedFormats === 'DD-MM-YYYY' || supportedFormats === 'DD/MM/YYYY') {
          day = parts[0].padStart(2, '0');
          month = parts[1].padStart(2, '0');
          year = parts[2];
        }
  
       /* if (isValidDate(year, month, day)) {
          formattedDate = `${year}-${month}-${day}`;
          validFormat = true;
          break;
        }
      }
    //}
  
    if (validFormat) {
      return formattedDate;
    } else {
      return null;
    }
  //}
  
  // Function to check if a date is valid
  function isValidDate(year, month, day) {
    const date = new Date(year, month - 1, day);
    return date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;
  }
  
  // Function to convert date
  function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    if (!inputDate) {
      console.error("Input date is empty or null");
      return;
    }

    const convertedDate = convertArabicToLatinNumbers(inputDate);
    if (!convertedDate) {
      console.error("Failed to convert Arabic numbers to Latin");
      return;
    }

    const date = convertDateToStandardFormat(convertedDate);
  
    if (date) {
      const outputElement = document.getElementById("output");
      outputElement.innerText = date;
    } else {
      console.error("Invalid date format:", convertedDate);
    }
  }

}

/*function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}

function convertDate() {
    // الحصول على قيمة التاريخ المدخل بالأرقام العربية من العنصر الذي له id = "arabicDate"
    const inputDate = document.getElementById("arabicDate").value;
    
    // تحويل الأرقام العربية إلى الأرقام اللاتينية باستخدام الدالة convertArabicToLatinNumbers
    const convertedDate = convertArabicToLatinNumbers(inputDate);

    // قائمة بالتنسيقات المدعومة للتاريخ مع الفاصلة المحددة بين أجزاء التاريخ
    const supportedFormats = [
        { format: 'YYYY-MM-DD', separator: '-' },
        { format: 'DD-MM-YYYY', separator: '-' },
        // يمكنك إضافة المزيد من التنسيقات حسب الحاجة
    ];

    let formattedDate = null;
    let validFormat = false;

    supportedFormats.forEach(formatObj => {
        if (!validFormat) {
            const parts = convertedDate.split(formatObj.separator);
            if (parts.length === 3) {
                const year = parts[2];
                const month = parts[1].padStart(2, '0');
                const day = parts[0].padStart(2, '0');
                formattedDate = `${day}-${month}-${year}`;
                validFormat = true; // تم العثور على تنسيق صحيح
            }
        }
    });
    // جرب تحليل التاريخ باستخدام كل تنسيق مدعوم
    supportedFormats.forEach(formatObj => {
        if (!validFormat) {
            const parts = convertedDate.split(formatObj.separator);
            if (parts.length === 3) {
                const year = parts[2];
                const month = parts[1].padStart(2, '0');
                const day = parts[0].padStart(2, '0');
                formattedDate = `${year}-${month}-${day}`;
                validFormat = true; // تم العثور على تنسيق صحيح
            }
        }
    });

    // إذا تم العثور على تنسيق صحيح، عرض التاريخ المنسق في العنصر ذو id = "output"
    if (validFormat) {
        const outputElement = document.getElementById("output");
        outputElement.innerText = formattedDate;
    } else {
        // إذا كان التنسيق غير صحيح، قم بمعالجة الخطأ (يتم عرضه في وحدة التحكم)
        console.error("Invalid date format:", convertedDate);
    }
}


/*function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}



function convertDate() {
    // الحصول على قيمة التاريخ المدخل بالأرقام العربية من العنصر الذي له id = "arabicDate"
    const inputDate = document.getElementById("arabicDate").value;
    
    // تحويل الأرقام العربية إلى الأرقام اللاتينية باستخدام الدالة convertArabicToLatinNumbers
    const convertedDate = convertArabicToLatinNumbers(inputDate);

    // قائمة بالتنسيقات المدعومة للتاريخ مع الفاصلة المحددة بين أجزاء التاريخ
    const supportedFormats = [
        { format: 'YYYY-MM-DD', separator: '-' },
        { format: 'DD-MM-YYYY', separator: '-' },
        // يمكنك إضافة المزيد من التنسيقات حسب الحاجة
    ];

    let formattedDate = null;
    let validFormat = false;

    // جرب تحليل التاريخ باستخدام كل تنسيق مدعوم
    supportedFormats.forEach(formatObj => {
        if (!validFormat) {
            const parts = convertedDate.split(formatObj.separator);
            if (parts.length === 3) {
                const year = parts[2];
                const month = parts[1].padStart(2, '0');
                const day = parts[0].padStart(2, '0');
                formattedDate = `${day}-${month}-${year}`;
                validFormat = true; // تم العثور على تنسيق صحيح
            }
        }
    });

    // إذا تم العثور على تنسيق صحيح، عرض التاريخ المنسق في العنصر ذو id = "output"
    if (validFormat) {
        const outputElement = document.getElementById("output");
        outputElement.innerText = formattedDate;
    } else {
        // إذا كان التنسيق غير صحيح، قم بمعالجة الخطأ (يتم عرضه في وحدة التحكم)
        console.error("Invalid date format:", convertedDate);
    }
}*/


/*

function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}

function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    const convertedDate = convertArabicToLatinNumbers(inputDate);

    // Assuming the convertedDate is in the format DD/MM/YYYY or similar
    const parts = convertedDate.split('-');
    if (parts.length === 3) {
        const year = parts[2];
        const month = parts[1].padStart(2, '0');
        const day = parts[0].padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;

        // Display the formatted date in the output element
        const outputElement = document.getElementById("output");
        outputElement.innerText = formattedDate;
    } else {
        // Handle invalid date format
        console.error("Invalid date format:", convertedDate);
    }
}*/

/*function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}

function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    const convertedDate = convertArabicToLatinNumbers(inputDate);
    
    // Assuming you have an element with id "result" to display the converted date
    const resultElement = document.getElementById("output");
    
    // Optionally, you can set a label or name for the output
    const outputName = "Date";
    
    // Set the inner text of the result element to include the label and the converted date
    resultElement.innerText =  convertedDate;
}


/*function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}*/

/*function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}


function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    const convertedDate = convertArabicToLatinNumbers(inputDate);
    document.getElementById("result").innerText = convertedDate;
}

function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    const convertedDate = convertArabicToLatinNumbers(inputDate);
    
    // Assuming you have an element with id "result" to display the converted date
    const resultElement = document.getElementById("output");
    
    // Optionally, you can set a label or name for the output
    //const outputName = "Date";
    
    // Set the inner text of the result element to include the label and the converted date
    resultElement.innerText =  convertedDate;
}


/*

function convertArabicToLatinNumbers(input) {
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const latinDigits = "0123456789";
    let converted = "";
    for (let i = 0; i < input.length; i++) {
        const index = arabicDigits.indexOf(input[i]);
        if (index !== -1) {
            converted += latinDigits[index];
        } else {
            converted += input[i];
        }
    }
    return converted;
}

function convertDate() {
    const inputDate = document.getElementById("arabicDate").value;
    const convertedDate = convertArabicToLatinNumbers(inputDate);
    document.getElementById("result").innerText = convertedDate;
}*/