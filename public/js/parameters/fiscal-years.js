/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/parameters/fiscal-years.js":
/*!*************************************************!*\
  !*** ./resources/js/parameters/fiscal-years.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./fiscal-years/modal_edit */ "./resources/js/parameters/fiscal-years/modal_edit.js");

__webpack_require__(/*! ./fiscal-years/modal_create */ "./resources/js/parameters/fiscal-years/modal_create.js");

__webpack_require__(/*! ./fiscal-years/main */ "./resources/js/parameters/fiscal-years/main.js");

/***/ }),

/***/ "./resources/js/parameters/fiscal-years/main.js":
/*!******************************************************!*\
  !*** ./resources/js/parameters/fiscal-years/main.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var url = "/api/fiscalYears"; // Datatable init

var table = $('#fiscal-years').DataTable({
  processing: true,
  ajax: {
    url: url,
    dataSrc: ''
  },
  columnDefs: [{
    targets: 0,
    data: "name"
  }, {
    targets: 1,
    data: null,
    render: function render(data) {
      var monthStart = '';

      if (data.month_start < 10) {
        monthStart = "0".concat(data.month_start);
      } else {
        monthStart = data.month_start;
      }

      return "".concat(monthStart, "/").concat(data.year_start);
    }
  }, {
    targets: 2,
    data: null,
    render: function render(data) {
      var monthEnd = '';

      if (data.month_end < 10) {
        monthEnd = "0".concat(data.month_end);
      } else {
        monthEnd = data.month_end;
      }

      return "".concat(monthEnd, "/").concat(data.year_end);
    }
  }, {
    targets: 3,
    data: null,
    render: function render(data) {
      var badgeClass = '';

      if (data.status === 'En cours') {
        badgeClass = 'badge-warning';
      } else if (data.status === 'Clôturé') {
        badgeClass = 'badge-danger';
      }

      return "<span class=\"badge ".concat(badgeClass, " mr-2\">\n                    ").concat(data.status, "\n                </span>");
    }
  }, {
    targets: -1,
    data: null,
    className: "align-middle text-center actions-cell",
    render: function render(data) {
      return "<a class=\"btn btn-warning btn-sm m-2 editFiscalYearBtn\" href=\"#editFiscalYearModal\" data-toggle=\"modal\" data-id=\"".concat(data.id, "\">\n                <i class=\"fas fa-pencil-alt\"></i>\n                </a>");
    },
    orderable: false
  }],
  language: {
    "zeroRecords": "Aucun résultat",
    "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
    "infoEmpty": "",
    "emptyTable": "Aucune donnée à afficher. Ajoutez votre premier exercice comptable.",
    "infoFiltered": "(Filtré par _MAX_ total entrées)",
    "decimal": ",",
    "thousands": " "
  },
  scrollY: 300,
  scrollCollapse: true,
  order: [[1, 'asc']],
  paging: false
}); // Hide default search row

$('.dataTables_wrapper .row:first-child').hide();

/***/ }),

/***/ "./resources/js/parameters/fiscal-years/modal_create.js":
/*!**************************************************************!*\
  !*** ./resources/js/parameters/fiscal-years/modal_create.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var months = {
  1: ["01", "Janvier"],
  2: ["02", "Février"],
  3: ["03", "Mars"],
  4: ["04", "Avril"],
  5: ["05", "Mai"],
  6: ["06", "Juin"],
  7: ["07", "Juillet"],
  8: ["08", "Août"],
  9: ["09", "Septembre"],
  10: ["10", "Octobre"],
  11: ["11", "Novembre"],
  12: ["12", "Décembre"]
}; // Add Modal script

$('#addFiscalYearModal').on('show.bs.modal', function (event) {
  var modal = $(this);
  var inputName = modal.find('#addName');
  var inputNameValue = "Exercice ";
  inputName.val(inputNameValue);
  var selectMonthStart = modal.find('#addMonthStart');
  var selectMonthEnd = modal.find('#addMonthEnd');
  var selectYearStart = modal.find('#addYearStart');
  var selectYearEnd = modal.find('#addYearEnd'); // Listener on month start change

  selectMonthStart.change(function () {
    selectMonthEnd.find('option').remove();

    function appendMonthEndOption(value) {
      var monthEndOp = "<option value=\"".concat(months[value][0], "\" selected>").concat(months[value][1], "</option>");
      selectMonthEnd.append(monthEndOp);
    }

    if (selectMonthStart.val() == "01") {
      var monthEnd = 12;
      appendMonthEndOption(monthEnd);

      if (selectYearStart.val() == selectYearEnd.val()) {
        return;
      } else {
        modal.find('#addYearStart, #addYearEnd').val(0);
        inputName.val(inputNameValue);
      }
    } else {
      var _monthEnd = parseInt(selectMonthStart.val()) - 1;

      appendMonthEndOption(_monthEnd);

      if (selectYearStart.val() == selectYearEnd.val()) {
        modal.find('#addYearStart, #addYearEnd').val("0");
        inputName.val(inputNameValue);
      } else {
        return;
      }
    }
  }); // Listener on year start change

  selectYearStart.change(function () {
    selectYearEnd.find('option').remove();
    inputName.val(inputNameValue);
    var yearStart = $(this).val();
    var yearEnd = '';

    function appendYearEndOption(value) {
      var yearEndOp = "<option value=\"".concat(value, "\" selected>").concat(value, "</option>");
      selectYearEnd.append(yearEndOp);
    }

    if (selectMonthStart.val() == "01") {
      yearEnd = parseInt(yearStart);
      appendYearEndOption(yearEnd);
    } else {
      yearEnd = parseInt(yearStart) + 1;
      appendYearEndOption(yearEnd);
    }

    if (selectYearStart.val() == 0) {
      selectYearEnd.find('option').remove();
    }
  }); // Listener for select change

  modal.find('select').change(function () {
    var monthStart = selectMonthStart.val();
    var monthEnd = selectMonthEnd.val();
    var yearStart = selectYearStart.val();
    var yearEnd = selectYearEnd.val(); // Auto fill name input

    inputName.val(inputNameValue + monthStart + '-' + yearStart + '/' + monthEnd + '-' + yearEnd);
  });
  $('#addFiscalYearForm').on('submit', function (e) {
    e.preventDefault();
    console.log($('#addFiscalYearForm').serialize());
    $.ajax({
      type: "POST",
      url: "/api/fiscalYears",
      data: $('#addFiscalYearForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function error(_error) {
        console.log(_error.responseText.message);
        alert("Une erreur est survenue. Vérifiez ceci : les champs marqués d'un * sont renseignés, le code que vous tentez d'ajouter n'existe pas déjà ; puis recommencez.");
      }
    });
  });
});
$('#addFiscalYearModal').on('hide.bs.modal', function () {
  $(this).find('#addMonthStart, #addYearStart').val(0);
  $(this).find('#addMonthEnd, #addYearEnd').empty();
});

/***/ }),

/***/ "./resources/js/parameters/fiscal-years/modal_edit.js":
/*!************************************************************!*\
  !*** ./resources/js/parameters/fiscal-years/modal_edit.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#editFiscalYearModal').on('show.bs.modal', function (e) {
  var modal = $(this);
  var button = $(e.relatedTarget);
  var selectStatus = modal.find('#editStatus');
  var nameFiscalYear = modal.find('#nameFiscalYear'); // Get account to edit

  $.ajax({
    type: 'GET',
    url: "/api/fiscalYears/edit/".concat(button.data('id')),
    dataType: 'JSON',
    success: fiscalYearSurccess,
    error: function (_error) {
      function error() {
        return _error.apply(this, arguments);
      }

      error.toString = function () {
        return _error.toString();
      };

      return error;
    }(function () {
      console.log(error.responseText.message);
    })
  });

  function fiscalYearSurccess(response) {
    selectStatus.val(response.status).prop('selected', true);
    nameFiscalYear.text(response.name);
    $('#editFiscalYearForm').append("<input type='hidden' id=\"fiscalYearId\" value='".concat(response.id, "'>"));
  } // Submit form


  $('#editFiscalYearForm').on('submit', function (e) {
    e.preventDefault();
    var fiscalYearId = modal.find('#fiscalYearId').val();
    $.ajax({
      type: "PATCH",
      url: "/api/fiscalYears/update/".concat(fiscalYearId),
      data: $('#editFiscalYearForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function (_error2) {
        function error(_x) {
          return _error2.apply(this, arguments);
        }

        error.toString = function () {
          return _error2.toString();
        };

        return error;
      }(function (error) {
        console.log(error.responseText.message);
        alert("Une erreur est survenue. Vérifiez que les champs marqués d'un * sont renseignés, puis recommencez.");
      })
    });
  });
});

/***/ }),

/***/ 3:
/*!*******************************************************!*\
  !*** multi ./resources/js/parameters/fiscal-years.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/valou/Documents/DEV-WEB/PROJETS-LARAVEL/Pilotexc-lar/resources/js/parameters/fiscal-years.js */"./resources/js/parameters/fiscal-years.js");


/***/ })

/******/ });