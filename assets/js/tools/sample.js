$(function() {

    $.ajax({
        type: "GET",
        url: "http://localhost/tools/jsgrid/countries/"
    }).done(function(countries) {

        countries.unshift({ id: "0", name: "" });

        $("#jsGrid").jsGrid({
            height: "70%",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: {
				deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "http://localhost/tools/jsgrid/clients/",
                        data: item
                    });
                },
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "http://localhost/tools/jsgrid/clients/",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "http://localhost/tools/jsgrid/clients/",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "http://localhost/tools/jsgrid/clients/",
                        data: item
                    });
                },
                
            },
            fields: [
                { name: "name", title: "Name", type: "text", width: 150 },
                { name: "age", title: "Age", type: "number", width: 50, filtering: false },
                { name: "address", title: "Address", type: "text", width: 200 },
                { name: "country_id", title: "Country", type: "select", width: 100, items: countries, valueField: "id", textField: "name" },
                { name: "married", type: "checkbox", title: "Is Married", sorting: false, filtering: false },
                { type: "control" }
            ]
        });

    });


});