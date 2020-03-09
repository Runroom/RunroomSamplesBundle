import $ from 'jquery';
import 'jquery-validation';

$(document).ready(function() {
  function ajaxSubmit(form) {
    const request = new XMLHttpRequest();
    const data = new FormData(form);

    function showMessage(type) {
      const formContainer = $(form).closest('.js-form-container');
      const formDisplay = formContainer.find('.js-form-display');
      const successMessage = formContainer.find('.js-form-success');
      const errorMessage = formContainer.find('.js-form-error');

      formDisplay.hide();

      if (type === 'ok') {
        errorMessage.hide();
        successMessage.show();
        successMessage.attr('aria-hidden', 'false');
      } else {
        errorMessage.show();
        successMessage.hide();
        errorMessage.attr('aria-hidden', 'false');
      }

      $(window).scrollTop(successMessage.offset().top - 80);
    }

    request.open(form.method, form.action, true);

    request.onload = function() {
      if (this.status >= 200 && this.status < 400) {
        const response = JSON.parse(this.response);

        showMessage(response.status);
      } else {
        showMessage('error');
      }
    };

    request.onerror = function() {
      showMessage('error');
    };

    request.send(data);
  }

  $(this).find('form.js-validate').validate({
    errorClass: 'form__message--invalid',
    errorElement: 'span',
    highlight: (element, errorClass, validClass) => {
      element.classList.add('form__state--invalid');
    },
    unhighlight: (element, errorClass, validClass) => {
      element.classList.remove('form__state--invalid');
    },
    errorPlacement: (error, element) => {
      if (element.attr('type') === 'radio') {
        element = $(element).parent().parent();
      }

      $(element).before(error);
    },
    normalizer: value => (value ? value.trim() : ''),
    submitHandler: form => {
      const formContainer = $(form).closest('.js-form-container');
      const button = formContainer.find('button[type="submit"]');

      button.prop('disabled', true);

      if (form.classList.contains('js-form-ajax')) {
        ajaxSubmit(form);

        return false;
      }

      return true;
    }
  });
});
