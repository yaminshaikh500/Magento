define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Cp_User/knockout-test'
        },
        initialize: function () {
           this.customerName = ko.observableArray([]);
           this.customerData = ko.observable('hello');
            this._super();
        },

        addNewCustomer: function () {
            this.customerName.push({name:this.customerData()});
            this.customerData('');
        }
    });
}
);