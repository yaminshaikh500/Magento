define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Cp_Knockout/knockout-test'
            },
            initialize: function () {
               this.customerName = ko.observableArray([]);
               this.customerData = ko.observable('');
                this._super();
            },

            addNewCustomer: function () {
                this.customerName.push({name:this.customerData()});
                this.customerData('');
            },
            removeCustomer: function () {
                this.customerName.pop();
                
            },
            removeThirdCustomer: function () {
                if (this.customerName().length > 2) { 
                    this.customerName.splice(2, 1); 
                }
            }
        });
    }
);