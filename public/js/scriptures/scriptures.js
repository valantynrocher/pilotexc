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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/scriptures/main.js":
/*!*****************************************!*\
  !*** ./resources/js/scriptures/main.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var url = "/api/scriptures"; // Datatable init

var table = $('#scriptures').DataTable({
  processing: true,
  ajax: {
    url: url,
    type: 'GET',
    dataSrc: ''
  },
  columns: [{
    className: 'details-control text-center',
    orderable: false,
    data: null,
    defaultContent: '<i class="fas fa-plus-circle toggleChildRow"></i>'
  }, {
    targets: 1,
    data: "title"
  }, {
    targets: 2,
    data: "status",
    render: function render(data) {
      var badgeClass = '';

      if (data === 'En cours') {
        badgeClass = 'badge-warning';
      } else if (data === 'Clôturé') {
        badgeClass = 'badge-danger';
      }

      return "<span class=\"badge ".concat(badgeClass, " mr-2\">\n                ").concat(data, "\n                </span>");
    }
  }, {
    targets: 3,
    data: "count",
    className: 'text-center'
  }, {
    targets: 4,
    data: "result",
    render: function render(data) {
      var badgeClass = '';
      var result = data.toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');

      if (parseInt(result) >= 0) {
        badgeClass = 'badge-success';
      } else {
        badgeClass = 'badge-danger';
      }

      return "<span class=\"badge ".concat(badgeClass, " mr-2\">\n                ").concat(result, " \u20AC\n                </span>");
    },
    className: 'text-center'
  }],
  language: {
    "zeroRecords": "Aucun résultat",
    "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
    "infoEmpty": "",
    "emptyTable": "Aucune donnée à afficher. Importez d'abord vos écritures comptables.",
    "infoFiltered": "(Filtré par _MAX_ total entrées)",
    "decimal": ",",
    "thousands": " "
  },
  paging: false
});
/* Formatting function for row details */

function format(d) {
  // `d` is the original data object for the row
  var structures = d.structures;
  var childTable = $('<table class="table table-bordered"></table>').append('<thead></thead>').append('<tr></tr>');
  childTable.append('<th scope="col">Structure</th><th scope="col">Écritures</th><th scope="col">Résultat</th>');
  $.each(structures, function (key, object) {
    var result = object.result;
    result = result.toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
    var badgeClass = '';

    if (parseInt(result) >= 0) {
      badgeClass = 'badge-success';
    } else {
      badgeClass = 'badge-danger';
    }

    childTable.append('<tbody></tbody>').append("<td>".concat(object.name, "</td><td>").concat(object.count, "</td><td><span class=\"badge ").concat(badgeClass, " mr-2\">\n        ").concat(result, " \u20AC</span></td>"));
  });
  return childTable;
} // Add event listener for opening and closing details


$('#scriptures tbody').on('click', 'td.details-control', function (e) {
  var tr = $(this).closest('tr');
  var row = table.row(tr);
  $(e.currentTarget).find('.toggleChildRow').toggleClass('fa-plus-circle').toggleClass('fa-minus-circle');

  if (row.child.isShown()) {
    // This row is already open - close it
    row.child.hide();
    tr.removeClass('shown');
  } else {
    // Open this row
    row.child(format(row.data())).show();
    tr.addClass('shown');
  }
}); // Hide default search row

$('.dataTables_wrapper .row:first-child').hide(); // reload icon : spin on hover

$('.fa-sync-alt').hover(function () {
  $(this).addClass('fa-spin');
}, function () {
  $(this).removeClass('fa-spin');
}); // reload data in the table

$('#reloadAccounts').click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "GET",
    url: url,
    success: function success() {
      table.ajax.reload();
    },
    error: function error() {
      alert('Impossible de charger les données.');
    }
  });
});

/***/ }),

/***/ "./resources/js/scriptures/modal_import.js":
/*!*************************************************!*\
  !*** ./resources/js/scriptures/modal_import.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#importModal').on('show.bs.modal', function () {
  var modal = $(this);
  var selectFiscalYear = modal.find('#fiscalYear');
  var scripturesInfo = modal.find('#checkScripturesInfo');
  var formStep2 = modal.find('#step2');
  var formStep3 = modal.find('#step3');
  var inputFile = modal.find('#scripturesImport');
  var inputAmountCheck = modal.find('#amountCheck');
  var amountCheckBtn = modal.find('#amountCheckBtn');
  var amountCheckInfo = modal.find('#amountCheckInfo');
  var submitBtn = modal.find('#submitImport'); // Get fiscal year options

  $.ajax({
    type: 'GET',
    url: "/api/fiscalYears/inProgress",
    dataType: 'JSON',
    success: function success(response) {
      response.forEach(function (fiscalYear) {
        selectFiscalYear.append("<option value=\"".concat(fiscalYear.id, "\">").concat(fiscalYear.name, "</option>"));
      });
    },
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
  }); // Listener for fiscal year change to get number of existing scriptures

  selectFiscalYear.on('change', function () {
    var fiscalYearId = $(this).val();

    if (fiscalYearId > 0) {
      var success = function success(response) {
        scripturesInfo.html("Il y a actuellement <strong>".concat(response.count, "</strong> \xE9criture(s) pour cet exercice."));
        formStep2.removeClass('d-none');
      };

      $.ajax({
        type: "GET",
        url: "/api/scriptures/countExistingScriptures/".concat(fiscalYearId),
        beforeSend: function beforeSend() {
          scripturesInfo.html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Calcul en cours...").removeClass('d-none');
        },
        success: success,
        error: function (_error2) {
          function error(_x) {
            return _error2.apply(this, arguments);
          }

          error.toString = function () {
            return _error2.toString();
          };

          return error;
        }(function (error) {
          console.log(error);
          scripturesInfo.html('Erreur');
          formStep2.addClass('d-none');
        })
      });
    } else {
      scripturesInfo.addClass('d-none');
      formStep2.addClass('d-none');
      inputFile.val('');
      formStep3.addClass('d-none');
      inputAmountCheck.val('');
    }
  }); // Listener for file input

  inputFile.on('change', function () {
    var inputValue = $(this).val();

    if (inputValue) {
      formStep3.removeClass('d-none');
    } else {
      formStep3.addClass('d-none');
    }
  }); // Listener for check amount change

  inputAmountCheck.on('change', function () {
    var amountToCheck = $(this).val();

    if (amountToCheck > 0) {
      amountCheckBtn.removeAttr('disabled');
    } else {
      amountCheckBtn.attr('disabled', 'disabled');
    }
  }); // listener for checking amount button

  amountCheckBtn.on('click', function (e) {
    e.preventDefault();
    amountCheckInfo.empty().removeClass('alert-success alert-danger').addClass('d-none');
    var formData = new FormData($('#importScriptures')[0]);
    $.ajax({
      type: "POST",
      url: "/api/scriptures/checkImportAmount",
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function beforeSend() {
        amountCheckBtn.empty().html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Patientez...");
      },
      success: success,
      error: function (_error3) {
        function error(_x2) {
          return _error3.apply(this, arguments);
        }

        error.toString = function () {
          return _error3.toString();
        };

        return error;
      }(function (error) {
        alert('Une erreur est survenue.');
        console.log(error);
        amountCheckBtn.empty().html('Vérifier');
      })
    });

    function success(response) {
      amountCheckInfo.removeClass('d-none').html(response.message);

      if (response.validate) {
        amountCheckBtn.empty().html("<i class=\"fas fa-check-circle\"></i>").attr('disabled', 'disabled');
        submitBtn.removeAttr('disabled');
        amountCheckInfo.addClass('alert-success');
      } else {
        amountCheckBtn.empty().html('Vérifier');
        amountCheckInfo.addClass('alert-danger');
      }
    }
  }); // Submit form

  $('#importScriptures').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/api/scriptures/import",
      data: $(this).serialize(),
      beforeSend: function beforeSend() {
        submitBtn.empty().html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Patientez...");
      },
      success: function success() {
        submitBtn.empty().removeClass('btn-primary').addClass('btn-success').html("<i class=\"fas fa-check-circle\"></i> Ok !");
        setTimeout(function () {
          modal.modal('hide');
          location.reload();
        }, 1000);
      },
      error: function (_error4) {
        function error(_x3) {
          return _error4.apply(this, arguments);
        }

        error.toString = function () {
          return _error4.toString();
        };

        return error;
      }(function (error) {
        console.log(error);
        submitBtn.empty().removeClass('btn-primary').addClass('btn-danger').html("<i class=\"fas fa-times-circle\"></i> \xC9chec !");
        alert("Une erreur est survenue pendant l'import. Si l'erreur persiste, contactez le support Pilotexc.");
        setTimeout(function () {
          modal.modal('hide');
        }, 1000);
      })
    });
  });
});
$('#importModal').on('hide.bs.modal', function () {
  $(this).find('#fiscalYear').find('option').remove().end().append("<option value=\"0\">S\xE9lectionnez un exercice comptable...</option>");
  $(this).find('#scripturesImport').val('');
  $(this).find('#amountCheck').val('');
  $(this).find('#amountCheckBtn').removeAttr('disabled').empty().html('Vérifier');
  $(this).find('#checkScripturesInfo').empty().addClass('d-none');
  $(this).find('#step2, #step3').addClass('d-none');
  $(this).find('#amountCheckInfo').empty().removeClass('alert-success', 'alert-danger').addClass('d-none');
  $.ajax({
    type: "GET",
    url: "/api/scriptures/truncateTempScriptures"
  });
});

/***/ }),

/***/ "./resources/js/scriptures/scriptures.js":
/*!***********************************************!*\
  !*** ./resources/js/scriptures/scriptures.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./modal_import */ "./resources/js/scriptures/modal_import.js");

__webpack_require__(/*! ./main */ "./resources/js/scriptures/main.js");

/***/ }),

/***/ 4:
/*!*****************************************************!*\
  !*** multi ./resources/js/scriptures/scriptures.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/valou/Documents/DEV-WEB/PROJETS-LARAVEL/Pilotexc-lar/resources/js/scriptures/scriptures.js */"./resources/js/scriptures/scriptures.js");


/***/ })

/******/ });