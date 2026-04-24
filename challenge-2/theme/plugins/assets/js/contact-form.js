/**
 * Law Firm Contact Form JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        $('#law-firm-contact-form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var submitButton = form.find('button[type="submit"]');
            var originalText = submitButton.text();

            // Disable button and show loading
            submitButton.prop('disabled', true).text('Sending...');

            // Collect form data
            var formData = {
                action: 'law_firm_contact_submit',
                nonce: lawFirmContact.nonce,
                name: form.find('#contact-name').val(),
                email: form.find('#contact-email').val(),
                phone: form.find('#contact-phone').val(),
                message: form.find('#contact-message').val()
            };

            // Send AJAX request
            $.ajax({
                url: lawFirmContact.ajax_url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert(response.data);
                        form[0].reset();
                    } else {
                        alert(response.data);
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                },
                complete: function() {
                    // Re-enable button
                    submitButton.prop('disabled', false).text(originalText);
                }
            });
        });
    });

})(jQuery);