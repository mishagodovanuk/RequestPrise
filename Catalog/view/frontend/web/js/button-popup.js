/*
*  Create modal window onclick function
*/
define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'mage/mage'
    ],
    function(
        $,
        modal,
        mage
    ) {
        var $form = $('#request-price-form');
        $form.mage('validation', {});
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Request price',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            },
                {
                    text: $.mage.__('Send'),
                    class: 'action submit primary',
                    click: function () {
                        sendFormData($form)
                    }
                }
            ]
        };


        var popup = modal(options, $('#popup-modal-form'));
        $("#request-price-button").on('click',function(){
            $("#popup-modal-form").modal("openModal");
        });

        function sendFormData($form) {
            if($form.validation('isValid')){
                alert('this say');
                $.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',
                    success: function() {
                        alert('success');
                        $form[0].reset();
                        $('#popup-modal-form').modal('closeModal');

                    }
                });
            }
        }
    }
);
