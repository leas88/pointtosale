$(function () {
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
        var grid_actual = $("#" + config_grid.name_grid).jsGrid({
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
            deleteConfirm: textjsgrid.deleteConfirm,
            onItemDeleting: function (arg) {
//                console.log("onItemDeleting");
//                console.log(arg);
                arg.cancel = false;
            },
            onItemDeleted: function (arg) {//Antes de la ejecucion
                console.log("onItemDeleted");
                console.log(arg);
                arg.cancel = true;
            },
            onItemUpdating: function (args) {
                console.log('args');
                console.log(args);
                grid_actual._lastPrevItemUpdate = args.previousItem;
                grid_actual._item = args.item;
                args.cancel = false;
            },
            onItemEditing: function (args) {//No permite que se edite el registro
                args.cancel = false;
            },
            controller: //controllerp
                    {
                        loadData: function (filter) {
//                            console.log(filter);
                            var deferred = $.Deferred();
                            if (typeof get_ !== 'undefined') {
                                var data = $.ajax({
                                    type: "GET",
                                    url: site_url + '/' + get_.url,
                                    data: filter
                                }).done(function (resp) {
                                    console.log(resp);
                                    deferred.resolve(resp.data)
                                });
//                                console.log(data);
                                return deferred.promise();
                                ;
                            }
                        },
                        insertItem: function (item) {
                            var deferred = $.Deferred();
                            var result = $.ajax({
                                type: "POST",
                                url: site_url + '/' + insert_.url,
                                data: item
                            }).done(function (resp) {
                                console.log(resp);
                                deferred.resolve(resp.data)
                            });
                            return deferred.promise();
                        },
                        updateItem: function (item) {
                            var de = $.Deferred();
                            console.log(de);

                            return $.ajax({
                                type: "POST",
                                url: site_url + '/' + update_.url,
                                data: item,
                                dataType: "json"
                            }).done(function (resp) {
                                console.log(resp);
                                if (resp.result != 'success') {
                                } else {
                                    de.resolve(resp.data);
                                }

                            }
                            ).fail(function (data) {
                                de.resolve(item);
                            });
                            return de.promise();
                        },
                        deleteItem: function (item) {
                            console.log("que tal te elimino ?");
                            var resp = $.ajax({
                                type: "POST",
                                url: site_url + '/' + delete_.url,
                                data: item,
                            }).done(function (data) {
                                console.log(data);
                                if (data.result != 'success') {
                                    //Exito  en la transacción
                                    grid_actual.jsGrid("option", "pageIndex", 1);
                                    grid_actual.jsGrid("loadData");
                                }
                                get_mensaje_general(data.msg, data.result, 5000);
                            }).fail(function (jqXHR, textStatus) {
                                grid_actual.jsGrid("option", "pageIndex", 1);
                                grid_actual.jsGrid("loadData");
                            });
                        },
                    },
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