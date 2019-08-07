/*
*  Create modal window onclick function
*/
define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        var $form = $('#request-price-form');
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
                        sendFormData()
                    }
                }
            ]
        };

        var popup = modal(options, $('#popup-modal-form'));
        $("#request-price-button").on('click',function(){
            $("#popup-modal-form").modal("openModal");
        });

        function sendFormData() {
            alert('send form data');
            //Ajax logic
        }
    }
);
