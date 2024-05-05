define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Cp_User/knockout-test'
        },
        initialize: function () {
           this.customerName = ko.observableArray([]);
           this.customerData = ko.observable('');

           this.nameTest = ko.observable('Test');

           this.customerData.subscribe(function() {
            // alert(1);
           })

            this._super();
        },

        removeData: function() {
          this.customerName.pop();  
        },
 
        addNewCustomer: function () {
            this.customerName.push({name:this.customerData()});
            // this.customerData('');
        }
    });
}
);