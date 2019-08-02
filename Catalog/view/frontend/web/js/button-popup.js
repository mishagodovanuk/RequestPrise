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
            }]
        };

        var popup = modal(options, $('#popup-modal-form'));
        $("#request-price-button").on('click',function(){
            $("#popup-modal-form").modal("openModal");
        });
    }
);
