require('./bootstrap');
require('./adminlte/adminlte');
require('./adminlte/Treeview');

$(document).ready(function () {
    require('./modals/analytic/create');
    require('./modals/analytic/affect');
    require('./modals/analytic/activate');
    require('./modals/analytic/edit');
    require('./modals/analytic/delete');
    require('./modals/general/create');
    require('./modals/general/affect');
    require('./modals/general/activate');
    require('./modals/general/edit');
    require('./modals/general/delete');
    require('./modals/fiscalYears/create');
})

$(document).ready(function () {
    require('./tables/analytics');
    require('./tables/generals');
})
