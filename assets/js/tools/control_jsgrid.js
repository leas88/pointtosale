$(function () {
    console.log(config_grid);
    var delete_;
    var insert_;
    var get_;
    var update_;
    for (var e in config_grid.funciones) {
        switch (e) {
            case 'GET':
                get_ = config_grid.funciones[e];
                break;
            case 'POST':
                insert_ = config_grid.funciones[e];
                break;
            case 'PUT':
                update_ = config_grid.funciones[e];
                break;
            case 'DELETE':
                delete_ = config_grid.funciones[e];
                break;
        }
    }
    ;


    $.ajax({
        type: "GET",
        url: site_url + '/' + config_grid.catalogos.url
    }).done(function (data) {
//        data.unshift({id: "0", name: ""});
        $("#" + config_grid.name_grid).jsGrid({
            height: "70%",
            width: "100%",
            filtering: true,
            inserting: (typeof insert_ !== 'undefined'),
            editing: (typeof update_ !== 'undefined'),
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: //controllerp
                    {
                        loadData: function (filter) {
                            console.log(filter);
                            if (typeof get_ !== 'undefined') {
                                var data = $.ajax({
                                    type: "GET",
                                    url: site_url + '/' + get_.url,
                                    data: filter
                                });
                                console.log(data);
                                return  data;
                            }
                        },
                        insertItem: function (item) {
                            var result = $.ajax({
                                type: "POST",
                                url: site_url + '/' + insert_.url,
                                data: item
                            });
                            return result;
                        },
                        updateItem: function (item) {
                            return $.ajax({
                                type: "POST",
                                url: site_url + '/' + update_.url,
                                data: item
                            });
                        },
                        deleteItem: function (item) {
                            return $.ajax({
                                type: "POST",
                                url: site_url + '/' + delete_.url,
                                data: item
                            });
                        }
                    }
            ,
            fields:
                    (function () {
                        for (var elemento  in column) {
                            if (typeof column[elemento].items !== 'undefined') {
                                column[elemento].items = eval(column[elemento].items);
                            }
                        }
                        return column;
                    })()
//            fields: column
        });

    });

//                {name: "name", title: "Name", type: "text", width: 150},
//                {name: "age", title: "Age", type: "number", width: 50, filtering: false},
//                {name: "address", title: "Address", type: "text", width: 200},
//                {name: "country_id", title: "Country", type: "select", width: 100, items: countries, valueField: "id", textField: "name"},
//                {name: "married", type: "checkbox", title: "Is Married", sorting: false, filtering: false},
//                {type: "control"}

});