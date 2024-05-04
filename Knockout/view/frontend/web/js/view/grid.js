define([
    'jquery',
    'ko',
    'uiComponent',
    'Cp_Knockout/js/view/grid/price'
], function ($, ko, component, priceRender) {
    "use strict";
 
    return component.extend({
        items: ko.observableArray([]),
        columns: ko.observableArray([]),
        defaults: {
            template: 'Cp_Knockout/grid',
        },
 
        initialize: function () {
            this._super();
            this._render();
        },
 
        _render: function() {
            this._prepareColumns();
            this._prepareItems();                     
        },
        
        _prepareItems: function () {
           
            this.addItems(window.grid_data);
        },
 
        _prepareColumns: function () {
            this.addColumn({headerText: "ID", rowText: "user_id", renderer: ''});
            this.addColumn({headerText: "Name", rowText: "name", renderer: ''});
            this.addColumn({headerText: "Email", rowText: "email", renderer: ''});
          
        },
 
        addItem: function (item) {
            item.columns = this.columns;
            this.items.push(item);
        },
 
        addItems: function (items) {
            for (var i in items) {
                this.addItem(items[i]);
            }
        },
 
        addColumn: function (column) {
            this.columns.push(column);
        }
    });
});
 