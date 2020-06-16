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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/parameters/accounts-general.js":
/*!*****************************************************!*\
  !*** ./resources/js/parameters/accounts-general.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./accounts-general/modal_activate */ "./resources/js/parameters/accounts-general/modal_activate.js");

__webpack_require__(/*! ./accounts-general/modal_create */ "./resources/js/parameters/accounts-general/modal_create.js");

__webpack_require__(/*! ./accounts-general/modal_affect */ "./resources/js/parameters/accounts-general/modal_affect.js");

__webpack_require__(/*! ./accounts-general/modal_edit */ "./resources/js/parameters/accounts-general/modal_edit.js");

__webpack_require__(/*! ./accounts-general/modal_delete */ "./resources/js/parameters/accounts-general/modal_delete.js");

__webpack_require__(/*! ./accounts-general/main */ "./resources/js/parameters/accounts-general/main.js");

/***/ }),

/***/ "./resources/js/parameters/accounts-general/main.js":
/*!**********************************************************!*\
  !*** ./resources/js/parameters/accounts-general/main.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var url = "/api/generalAccounts"; // Datatable init

var table = $('#general-accounts').DataTable({
  processing: true,
  ajax: {
    url: url,
    dataSrc: ''
  },
  columnDefs: [{
    targets: 0,
    data: null,
    className: 'align-middle text-center selectRow',
    searchable: false,
    orderable: false,
    render: function render(data, type, full, meta) {
      return "<input type=\"checkbox\" class=\"checkAccount\" id=\"check_".concat(data.id, "\" data-id=\"").concat(data.id, "\">");
    },
    width: "5%"
  }, {
    targets: 1,
    data: "id",
    className: 'align-middle',
    width: "10%"
  }, {
    targets: 2,
    data: "account_subclass_id",
    visible: false
  }, {
    targets: 3,
    data: null,
    render: function render(data, type, full, meta) {
      if (data.active) {
        return "<span class=\"badge badge-success mr-2\">Actif</span> ".concat(data.name);
      } else {
        return "<span class=\"badge badge-danger mr-2\">Inactif</span> ".concat(data.name);
      }
    },
    className: 'align-middle',
    width: "25%"
  }, {
    targets: 4,
    data: "active",
    visible: false
  }, {
    targets: 5,
    data: "cerfa1_line",
    render: function render(data, type, full, meta) {
      if (data !== null) {
        return "<small>Groupe : </small><span class=\"badge badge-secondary\">".concat(data.cerfa1_group.name, "</span>\n                    <br>\n                    <small>Ligne : </small><span class=\"badge badge-info\">").concat(data.name, "</span>");
      } else {
        return '<small><i class="fas fa-exclamation-circle"></i> Aucune affectation<small>';
      }
    },
    className: 'align-middle',
    width: "25%"
  }, {
    targets: -1,
    data: null,
    className: "align-middle text-center actions-cell",
    render: function render(data) {
      return "<a class=\"btn bg-teal btn-sm m-2 editAccountBtn\" href=\"#editModal\" data-toggle=\"modal\" data-id=\"".concat(data.id, "\">\n                <i class=\"fas fa-pencil-alt\"></i>\n                </a>\n                <a class=\"btn btn-outline-danger btn-sm m-2 deleteAccountBtn\" href=\"#deleteModal\" data-toggle=\"modal\" data-id=\"").concat(data.id, "\">\n                <i class=\"fas fa-trash\"></i>\n                </a>");
    },
    orderable: false,
    width: "15%"
  }],
  language: {
    "zeroRecords": "Aucun résultat",
    "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
    "infoEmpty": "",
    "emptyTable": "Aucune donnée à afficher. Importez d'abord votre plan de compte",
    "infoFiltered": "(Filtré par _MAX_ total entrées)",
    "decimal": ",",
    "thousands": " "
  },
  scrollY: 300,
  scrollCollapse: true,
  order: [[1, 'asc']],
  paging: false
}); // reload data in the table

$('#reloadAccounts').click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "GET",
    url: url,
    success: function success(response) {
      table.ajax.reload();
    },
    error: function error(_error) {
      alert('Impossible de charger les données.');
    }
  });
}); // Filter 'active'

$('#activeSelect').change(function () {
  table.column($(this).data('column')).search($(this).val()).draw();
}); // Search input

$('#searchInput').on('keyup', function () {
  table.search(this.value).draw();
}); // reload icon : spin on hover

$('.fa-sync-alt').hover(function () {
  $(this).addClass('fa-spin');
}, function () {
  $(this).removeClass('fa-spin');
}); // Hide default search row

$('.dataTables_wrapper .row:first-child').hide(); // Rows "select all"

$('#checkAll').change(function () {
  $('.checkAccount').prop('checked', $(this).prop('checked'));
}); // Enabled or disabled actions button for selection

$('.dataTables_wrapper').on('change', "input:checkbox", function () {
  if ($('.dataTables_wrapper').find('input:checkbox:checked').length > 0) {
    $('.select-action').removeClass('disabled');
    $('.select-action').css('pointer-events', 'initial');
  } else {
    $('.select-action').addClass('disabled');
    $('.select-action').css('pointer-events', 'none');
  }
});

/***/ }),

/***/ "./resources/js/parameters/accounts-general/modal_activate.js":
/*!********************************************************************!*\
  !*** ./resources/js/parameters/accounts-general/modal_activate.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#activateToggleModal').on('show.bs.modal', function (e) {
  var modal = $(this);
  var button = $(e.relatedTarget); // catch all selected accounts id into input fields

  $('.checkAccount:checkbox:checked').each(function (i) {
    var inputSelectedRows = '';
    var accountId = $(this).data('id');
    inputSelectedRows = "<input type='hidden' class='selectedRow' name='row".concat(i, "' value='").concat(accountId, "'>");
    modal.find('.selected-rows-list').append(inputSelectedRows);
  });
  modal.find('.modal-body p').text("\xCAtes-vous s\xFBr de modifier ".concat(modal.find('.modal-body .selectedRow').length, " comptes en ").concat(button.data('state'), " ?")); // Submit form

  $('#activateToggleForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/api/generalAccounts/".concat(button.data('action')),
      data: $('#activateToggleForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function error(_error) {
        console.log(_error.responseText.message);
        alert('Une erreur est survenue.');
      }
    });
  });
});
$('#activateToggleModal').on('hide.bs.modal', function () {
  $(this).find('.selected-rows-list').empty();
});

/***/ }),

/***/ "./resources/js/parameters/accounts-general/modal_affect.js":
/*!******************************************************************!*\
  !*** ./resources/js/parameters/accounts-general/modal_affect.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#affectModal').on('show.bs.modal', function () {
  var modal = $(this);
  var selectCerfaGroup = modal.find('#affectCerfa1Group');
  var selectCerfaLine = modal.find('#affectCerfa1Line'); // catch all selected accounts id into input fields

  $('.checkAccount:checkbox:checked').each(function (i) {
    var inputSelectedRows = '';
    var accountId = $(this).data('id');
    inputSelectedRows = "<input type='hidden' class='selectedRow' name='row".concat(i, "' value='").concat(accountId, "'>");
    modal.find('.selected-rows-list').append(inputSelectedRows);
  }); // show info message with number of selected accounts

  modal.find('.modal-body p').text("Veuillez affecter les ".concat(modal.find('.modal-body .selectedRow').length, " comptes s\xE9lectionn\xE9s :")); // Get cerfa groups options

  $.ajax({
    type: 'GET',
    url: '/api/cerfa1/groups',
    success: function success(response) {
      response.forEach(function (cerfaGroup) {
        selectCerfaGroup.append("<option value=\"".concat(cerfaGroup.id, "\">").concat(cerfaGroup.name, "</option>"));
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
  }); // Listener for cerfa group change

  selectCerfaGroup.on('change', function () {
    var groupId = $(this).val();
    var lineOp = '';

    if (groupId == 0) {
      selectCerfaLine.prop("disabled", true);
    } else {
      selectCerfaLine.prop("disabled", false);
    }

    $.ajax({
      type: 'GET',
      url: "/api/cerfa1/group/".concat(groupId, "/lines"),
      success: success,
      error: function (_error2) {
        function error() {
          return _error2.apply(this, arguments);
        }

        error.toString = function () {
          return _error2.toString();
        };

        return error;
      }(function () {
        console.log(error.responseText.message);
      })
    });

    function success(response) {
      lineOp += '<option value="0" selected>Sélectionner un secteur...</option>';
      response.forEach(function (line) {
        lineOp += "<option value=\"".concat(line.id, "\">").concat(line.name, "</option>");
      });
      selectCerfaLine.find('option').remove().end().append(lineOp);
    }
  });
  $('#affectForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/api/generalAccounts/affect",
      data: $('#affectForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function (_error3) {
        function error(_x) {
          return _error3.apply(this, arguments);
        }

        error.toString = function () {
          return _error3.toString();
        };

        return error;
      }(function (error) {
        console.log(error.responseText.message);
        alert('Une erreur est survenue.');
      })
    });
  });
});
$('#affectModal').on('hide.bs.modal', function () {
  $(this).find('.selected-rows-list').empty();
  $(this).find('#affectCerfa1Group').empty().append("<option value='0'>Sélectionner un groupe...</option>");
  $(this).find('#affectCerfa1Line').empty().prop("disabled", true);
});

/***/ }),

/***/ "./resources/js/parameters/accounts-general/modal_create.js":
/*!******************************************************************!*\
  !*** ./resources/js/parameters/accounts-general/modal_create.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#addModal').on('show.bs.modal', function () {
  var modal = $(this);
  var inputActive = modal.find('#addActive');
  var selectCerfaGroup = modal.find('#addCerfa1Group');
  var selectCerfaLine = modal.find('#addCerfa1Line'); // Check active toggle by default

  inputActive.prop('checked', true).change(function () {
    if (this.checked) {
      inputActive.val(1);
    } else {
      inputActive.val(0);
    }
  }); // Get cerfa groups options

  $.ajax({
    type: 'GET',
    url: '/api/cerfa1/groups',
    success: function success(response) {
      response.forEach(function (cerfaGroup) {
        selectCerfaGroup.append("<option value=\"".concat(cerfaGroup.id, "\">").concat(cerfaGroup.name, "</option>"));
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
  }); // Listener for cerfa group change

  selectCerfaGroup.on('change', function () {
    var groupId = $(this).val();
    var lineOp = '';

    if (groupId == 0) {
      selectCerfaLine.prop("disabled", true);
    } else {
      selectCerfaLine.prop("disabled", false);
    }

    $.ajax({
      type: 'GET',
      url: "/api/cerfa1/group/".concat(groupId, "/lines"),
      success: cerfaLinesChangeSuccess,
      error: function (_error2) {
        function error() {
          return _error2.apply(this, arguments);
        }

        error.toString = function () {
          return _error2.toString();
        };

        return error;
      }(function () {
        console.log(error.responseText.message);
      })
    });

    function cerfaLinesChangeSuccess(response) {
      lineOp += '<option value="0" selected>Sélectionner une ligne...</option>';
      response.forEach(function (line) {
        lineOp += "<option value=\"".concat(line.id, "\">").concat(line.name, "</option>");
      });
      selectCerfaLine.find('option').remove().end().append(lineOp);
    }
  }); // Submit form

  $('#addForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/api/generalAccounts",
      data: $('#addForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function (_error3) {
        function error(_x) {
          return _error3.apply(this, arguments);
        }

        error.toString = function () {
          return _error3.toString();
        };

        return error;
      }(function (error) {
        console.log(error.responseText.message);
        alert("Une erreur est survenue. Vérifiez ceci : les champs marqués d'un * sont renseignés, le code que vous tentez d'ajouter n'existe pas déjà ; puis recommencez.");
      })
    });
  });
});
$('#addModal').on('hide.bs.modal', function () {
  $(this).find('input').val('');
  $(this).find('#addCerfa1Group').find('option').remove().end().append("<option value='0'>Sélectionner un groupe...</option>");
  $(this).find('#addCerfa1Line').find('option').remove().end().prop("disabled", true);
});

/***/ }),

/***/ "./resources/js/parameters/accounts-general/modal_delete.js":
/*!******************************************************************!*\
  !*** ./resources/js/parameters/accounts-general/modal_delete.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#deleteModal').on('show.bs.modal', function (e) {
  var modal = $(this);
  var button = $(e.relatedTarget);
  var accountId = button.data('id');
  modal.find('.modal-body p').text("Voulez-vous supprimer le compte n\xB0 ".concat(accountId, " de votre plan de compte ?")); // Submit form

  $('#deleteForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "DELETE",
      url: "/api/generalAccounts/destroy/".concat(accountId),
      data: $('#deleteForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function error(_error) {
        console.log(_error.responseText.message);
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/parameters/accounts-general/modal_edit.js":
/*!****************************************************************!*\
  !*** ./resources/js/parameters/accounts-general/modal_edit.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#editModal').on('show.bs.modal', function (e) {
  var modal = $(this);
  var button = $(e.relatedTarget);
  var inputId = modal.find('#editId');
  var inputName = modal.find('#editName');
  var inputActive = modal.find('#editActive');
  var selectCerfaGroup = modal.find('#editCerfa1Group');
  var selectCerfaLine = modal.find('#editCerfa1Line'); // Get account to edit

  $.ajax({
    type: 'GET',
    url: "/api/generalAccounts/edit/".concat(button.data('id')),
    dataType: 'JSON',
    success: accountSuccess,
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

  function accountSuccess(account) {
    // fill id field
    inputId.val(account.id); // fill name field

    inputName.val(account.name); // fill active toggle field

    if (account.active === 1) {
      inputActive.val(1).prop('checked', true);
    } else {
      inputActive.val(0).prop('checked', false);
    } // update toggle activation field value


    inputActive.change(function () {
      if (this.checked) {
        inputActive.val(1);
      } else {
        inputActive.val(0);
      }
    }); // Get cerfa groups options

    $.ajax({
      type: 'GET',
      url: '/api/cerfa1/groups',
      success: function success(response) {
        response.forEach(function (cerfaGroup) {
          selectCerfaGroup.append("<option value=".concat(cerfaGroup.id, ">").concat(cerfaGroup.name, "</option>"));
        });
      },
      error: function (_error2) {
        function error() {
          return _error2.apply(this, arguments);
        }

        error.toString = function () {
          return _error2.toString();
        };

        return error;
      }(function () {
        console.log(error.responseText.message);
      })
    }); // Check if current account is affected to a cerfa line

    if (account.cerfa1_line !== null) {
      var cerfaLinesSuccess = function cerfaLinesSuccess(response) {
        response.forEach(function (line) {
          lineOp += "<option value=\"".concat(line.id, "\">").concat(line.name, "</option>");
        }); // Clear cerfa line options / append new options / select current cerfa line

        selectCerfaLine.find('option').remove().end().append(lineOp).val(account.cerfa1_line.id).prop("selected", true).prop("disabled", false);
      };

      selectCerfaGroup.val(account.cerfa1_line.cerfa1_groupId).prop("selected", true); // Get cerfa line options

      var lineOp = '';
      $.ajax({
        type: 'GET',
        url: "/api/cerfa1/group/".concat(account.cerfa1_line.cerfa1_groupId, "/lines"),
        success: cerfaLinesSuccess,
        error: function (_error3) {
          function error() {
            return _error3.apply(this, arguments);
          }

          error.toString = function () {
            return _error3.toString();
          };

          return error;
        }(function () {
          console.log(error.responseText.message);
        })
      });
    } else {
      selectCerfaGroup.val(0);
      selectCerfaLine.find('option').remove().end().prop("disabled", true);
    }
  } // Listener for cerfa group change


  selectCerfaGroup.on('change', function () {
    var groupId = $(this).val();
    var newLineOp = '';

    if (groupId == 0) {
      selectCerfaLine.prop("disabled", true);
    } else {
      selectCerfaLine.prop("disabled", false);
    } // Get new cerfa line options


    $.ajax({
      type: 'GET',
      url: "/api/cerfa1/group/".concat(groupId, "/lines"),
      success: cerfaLinesChangeSuccess,
      error: function (_error4) {
        function error() {
          return _error4.apply(this, arguments);
        }

        error.toString = function () {
          return _error4.toString();
        };

        return error;
      }(function () {
        console.log(error.responseText.message);
      })
    });

    function cerfaLinesChangeSuccess(response) {
      newLineOp += '<option value="0" selected>Sélectionner une ligne...</option>';
      response.forEach(function (line) {
        newLineOp += "<option value=\"".concat(line.id, "\">").concat(line.name, "</option>");
      }); // Clear cerfa line options / append new options

      selectCerfaLine.find('option').remove().end().append(newLineOp);
    }
  }); // Submit form

  $('#editForm').on('submit', function (e) {
    e.preDefault();
    var accountId = inputId.val();
    $.ajax({
      type: "PATCH",
      url: "/api/generalAccounts/update/".concat(accountId),
      data: $('#editForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function (_error5) {
        function error(_x) {
          return _error5.apply(this, arguments);
        }

        error.toString = function () {
          return _error5.toString();
        };

        return error;
      }(function (error) {
        console.log(error.responseText.message);
        alert("Une erreur est survenue. Vérifiez que les champs marqués d'un * sont renseignés, puis recommencez.");
      })
    });
  });
});
$('#editModal').on('hide.bs.modal', function () {
  $(this).find('input').val('');
  $(this).find('#editCerfa1Group').find('option').remove().end().append("<option value='0'>Sélectionner un groupe...</option>");
  $(this).find('#editCerfa1Line').find('option').remove().end().prop("disabled", true);
});

/***/ }),

/***/ 1:
/*!***********************************************************!*\
  !*** multi ./resources/js/parameters/accounts-general.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/valou/Documents/DEV-WEB/PROJETS-LARAVEL/Pilotexc2/resources/js/parameters/accounts-general.js */"./resources/js/parameters/accounts-general.js");


/***/ })

/******/ });