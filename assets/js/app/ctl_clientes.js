$(document).ready(function () {
    grid_clientes();
});

function grid_clientes() {
    console.log("grid_clientes");

    var grid = $('#grid_clientes').jsGrid({
        height: "300px",
        width: "100%",
        filtering: false,
        inserting: true,
        editing: true,
        sorting: true,
        selecting: false,
        paging: true,
        autoload: true,
        pageSize: 4,
        pageButtonCount: 3,
        pagerFormat: "Páginas: {pageIndex} de {pageCount}    {first} {prev} {pages} {next} {last}   Total: {itemCount}",
        pagePrevText: "Anterior",
        pageNextText: "Siguiente",
        pageFirstText: "Primero",
        pageLastText: "Último",
        pageNavigatorNextText: "...",
        pageNavigatorPrevText: "...",
        rowClick: function (args) {
        },
        noDataContent: "Aún no hay clientes para mostrar.",
        pageLoading: false,
        deleteConfirm: 'Seguro que desea continuar',
        loadMessage: "Por favor espere",
        onItemUpdating: function (args) {
            grid._lastPrevItemUpdate = args.previousItem;
            grid._item = args.item;
            cancel = false;
        },
        controller: {
            loadData: function (filter) {
                var d = $.Deferred();

                $.ajax({
                    type: "GET",
                    url: site_url + "/registro/clientes/listar",
                    data: filter,
                    dataType: "json"
                }).done(function (data) {
//                    console.log(data);
                    var res = $.grep(data, function (item) {
                        //   return (!filter.clave_curso || (item.clave_curso !== null && item.clave_curso.toLowerCase().indexOf(filter.clave_curso.toString().toLowerCase()) > -1))
                        //     && (!filter.nombre || (item.nombre !== null && item.nombre.toLowerCase().indexOf(filter.nombre.toString().toLowerCase()) > -1))
                        //     && (!filter.anio || (item.anio !== null && filter.anio === item.anio))
                        //     && (!filter.activo || (item.activo !== null && filter.activo === item.activo))
                        //     && (!filter.id_tipo_curso || item.id_tipo_curso != 0  && item.id_tipo_curso === filter.id_tipo_curso);
                        return true;
                    });
                    d.resolve(res);
                    calcula_ancho_grid('grid_clientes', 'jsgrid-header-cell');
                });
                return d.promise();
            }
            ,
            updateItem: function (item) {
                var de = $.Deferred();

                console.log(item);
                $.ajax({
                    type: "POST",
                    url: site_url + "/registro/clientes/editar",
                    data: item
                })
                        .done(function (json) {
                            console.log('success');
                            alert(json['message']);
                            if (json['success']) {
                                de.resolve(json['data']);
                            } else {
                                de.resolve(grid._lastPrevItemUpdate);
                            }
                        })
                        .fail(function (jqXHR, error, errorThrown) {
                            console.log("error");
                            console.log(jqXHR);
                            console.log(error);
                            console.log(errorThrown);
                            de.resolve(grid._lastPrevItemUpdate);
                        });
                return de.promise();
            },
            deleteItem: function (item) {
                var de = $.Deferred();

                console.log(item);
                $.ajax({
                    type: "POST",
                    url: site_url + "/registro/clientes/eliminar",
                    data: item
                })
                        .done(function (json) {
                            console.log('success');
                            alert(json['message']);
                            var de = $.Deferred();
                            de.resolve(item);
                            jsgrid_generales_final_no_delete_registros_error(json['success'], item);
                            de.promise();
                            return item;
                        })
                        .fail(function (jqXHR, error, errorThrown) {
                            console.log("error");
                            console.log(jqXHR);
                            console.log(error);
                            console.log(errorThrown);
                            de.resolve(grid._lastPrevItemUpdate);
                        });
                return de.promise();
            },
            insertItem: function (item) {

                var de = $.Deferred();
                console.log(item);
                $.ajax({
                    type: "POST",
                    url: site_url + "/registro/clientes/insertar/",
//                    url: site_url + "/alumnos/registro/insertar/",
                    data: item
                })
                        .done(function (json) {
                            alert(json['message']);
                            console.log(json);
                            grid.insertSuccess = json['success'];
                            de.resolve(json['data']);
                            calcula_ancho_grid('grid_clientes', 'jsgrid-header-cell');
                        })
                        .fail(function (jqXHR, error, errorThrown) {
                            console.log("error");
                            console.log(jqXHR);
                            console.log(error);
                            console.log(errorThrown);
//                            $(this).jsGrid("destroy");
                        });
                return de.promise();
            }
        },
        fields: [
            {type: "control", editButton: true, deleteButton: true, clearFilterButton: true, modeSwitchButton: true,
                searchModeButtonTooltip: "Cambiar a fila de búsqueda", // tooltip of switching filtering/inserting button in inserting mode
                insertModeButtonTooltip: "Cambiar a fila para insertar", // tooltip of switching filtering/inserting button in filtering mode
                editButtonTooltip: "Editar", // tooltip of edit item button
                deleteButtonTooltip: "Eliminar", // tooltip of delete item button
                searchButtonTooltip: "Buscar", // tooltip of search button
                clearFilterButtonTooltip: "Limpiar filtros de búsqueda", // tooltip of clear filter button
                insertButtonTooltip: "Nuevo", // tooltip of insert button
                updateButtonTooltip: "Guardar", // tooltip of update item button
                cancelEditButtonTooltip: "Cancelar", // tooltip of cancel editing button
            },
            {name: "name", title: "Nombre", type: "text", align: "center", editing: true, insertcss: "nombre_css",
                validate: {
                    validator: "required",
                    message: function (value, item) {
                        return "El campo Nombre es obligatorio. Por favor ingréselo";
                    }
                }
            },
            {name: "firstname", title: "Apellido paterno", type: "text", align: "center", editing: true,
                validate: {
                    validator: "required",
                    message: function (value, item) {
                        return "El campo Apellido paterno es obligatorio. Por favor ingréselo";
                    }
                }
            },
            {name: "lastname", title: "Apellido materno", type: "text", align: "center", editing: true,
            },
            {name: "email", title: "Correo electrónico", type: "text", align: "center", editing: true,
                validate: {
                    validator: "required",
                    message: function (value, item) {
                        return "El campo correo electrónico es obligatorio. Por favor ingréselo";
                    }
                }
            },
            {name: "phone", title: "Teléfono", type: "number", align: "center", editing: true,
                validate: {
                    validator: "required",
                    message: function (value, item) {
                        return "El campo teléfono es obligatorio. Por favor ingréselo";
                    }
                }
            },
            {name: "credit_card", title: "Número de tarjeta de credito", type: "number", align: "center", editing: true,
                validate: {
                    validator: "required",
                    message: function (value, item) {
                        return "El campo Número de tarjeta de credito es obligatorio. Por favor ingréselo";
                    }
                }
            },
        ]
    }).data("JSGrid");
    //jsgrid_generales_final_no_agregar_registros_error();

}