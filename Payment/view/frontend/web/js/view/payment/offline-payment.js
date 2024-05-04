
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'invoice30',
                component: 'Cp_Payment/js/view/payment/method-renderer/invoice30-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);