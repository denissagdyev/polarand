document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('whatsapp_number');
  
    phoneInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, ''); // Оставляем только цифры
      let formattedValue = '';
  
      if (value.length > 0) {
        formattedValue = '+7 (' + value.substring(1, 4);
        if (value.length > 4) {
          formattedValue += ') ' + value.substring(4, 7);
          if (value.length > 7) {
            formattedValue += '-' + value.substring(7, 9);
            if (value.length > 9) {
              formattedValue += '-' + value.substring(9, 11);
            }
          }
        }
      }
  
      e.target.value = formattedValue;
    });
  });