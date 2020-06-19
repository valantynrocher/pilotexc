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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/parameters/accounts-analytic.js":
/*!******************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./accounts-analytic/modal_activate */ "./resources/js/parameters/accounts-analytic/modal_activate.js");

__webpack_require__(/*! ./accounts-analytic/modal_create */ "./resources/js/parameters/accounts-analytic/modal_create.js");

__webpack_require__(/*! ./accounts-analytic/modal_affect */ "./resources/js/parameters/accounts-analytic/modal_affect.js");

__webpack_require__(/*! ./accounts-analytic/modal_edit */ "./resources/js/parameters/accounts-analytic/modal_edit.js");

__webpack_require__(/*! ./accounts-analytic/modal_delete */ "./resources/js/parameters/accounts-analytic/modal_delete.js");

__webpack_require__(/*! ./accounts-analytic/main */ "./resources/js/parameters/accounts-analytic/main.js");

/***/ }),

/***/ "./resources/js/parameters/accounts-analytic/main.js":
/*!***********************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic/main.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var url = "/api/analyticAccounts"; // Datatable init

var table = $('#analytic-accounts').DataTable({
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
    targets: 3,
    data: null,
    className: 'align-middle',
    render: function render(data, type, full, meta) {
      if (data.structure_id !== null) {
        return "<span class=\"badge badge-secondary\">".concat(data.structure.name, "</span>");
      } else {
        return '<small><i class="fas fa-exclamation-circle"></i> Aucune affectation<small>';
      }
    }
  }, {
    targets: 4,
    data: null,
    className: 'align-middle',
    render: function render(data, type, full, meta) {
      if (data.service_id !== null) {
        return "".concat(data.service.name, "\n                    <br>\n                    <small>Secteur : </small><span class=\"badge badge-info\">").concat(data.service.sector.name, "</span>\n                    <br>\n                    <small>Dossier : </small><span class=\"badge badge-info\">").concat(data.service.sector.folder.name, "</span>");
      } else {
        return '<small><i class="fas fa-exclamation-circle"></i> Aucune affectation<small>';
      }
    }
  }, {
    targets: 5,
    data: "active",
    visible: false
  }, {
    targets: -1,
    data: null,
    className: "align-middle text-center actions-cell",
    render: function render(data, type, full, meta) {
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

/***/ "./resources/js/parameters/accounts-analytic/modal_activate.js":
/*!*********************************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic/modal_activate.js ***!
  \*********************************************************************/
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
      url: "/api/analyticAccounts/".concat(button.data('action')),
      data: $('#activateToggleForm').serialize(),
      success: function success(response) {
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

/***/ "./resources/js/parameters/accounts-analytic/modal_affect.js":
/*!*******************************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic/modal_affect.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#affectModal').on('show.bs.modal', function () {
  var modal = $(this);
  var selectStructure = $('#affectStructure');
  var selectFolder = $('#affectFolder');
  var selectSector = $('#affectSector');
  var selectService = $('#affectService'); // catch all selected accounts id into input fields

  $('.checkAccount:checkbox:checked').each(function (i) {
    var inputSelectedRows = '';
    var accountId = $(this).data('id');
    inputSelectedRows = "<input type='hidden' class='selectedRow' name='row".concat(i, "' value='").concat(accountId, "'>");
    modal.find('.selected-rows-list').append(inputSelectedRows);
  }); // show info message with number of selected accounts

  modal.find('.modal-body p').text("Veuillez affecter les ".concat(modal.find('.modal-body .selectedRow').length, " comptes s\xE9lectionn\xE9s :")); // Get structure options

  $.ajax({
    type: 'GET',
    url: '/api/structures',
    success: function success(response) {
      response.forEach(function (structure) {
        selectStructure.append("<option value=".concat(structure.id, ">").concat(structure.name, "</option>"));
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
  }); // Get folders options

  $.ajax({
    type: 'GET',
    url: '/api/folders',
    success: function success(response) {
      response.forEach(function (folder) {
        selectFolder.append("<option value=".concat(folder.id, ">").concat(folder.name, "</option>"));
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
  }); // Listener for folder change

  selectFolder.on('change', function () {
    var folderId = $(this).val();
    var sectorOp = '';

    if (folderId == 0) {
      selectSector.empty().prop("disabled", true);
      selectService.empty().prop("disabled", true);
    } else {
      selectSector.prop("disabled", false);
    }

    selectService.empty().prop("disabled", true);
    $.ajax({
      type: 'GET',
      url: '/api/sectors/folder/' + folderId,
      success: success,
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

    function success(response) {
      sectorOp += '<option value="0" selected>Sélectionner un secteur...</option>';
      response.forEach(function (sector) {
        sectorOp += "<option value=\"".concat(sector.id, "\">").concat(sector.name, "</option>");
      });
      selectSector.find('option').remove().end().append(sectorOp);
    }
  }); // Listener for sector change

  selectSector.on('change', function () {
    var sectorId = $(this).val();
    var serviceOp = '';

    if (sectorId == 0) {
      selectService.prop("disabled", true).empty();
    } else {
      selectService.prop("disabled", false);
    }

    $.ajax({
      type: 'GET',
      url: '/api/services/sector/' + sectorId,
      success: success,
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

    function success(response) {
      serviceOp += '<option value="0" selected>Sélectionner un service...</option>';
      response.forEach(function (service) {
        serviceOp += "<option value=\"".concat(service.id, "\">").concat(service.name, "</option>");
      });
      selectService.find('option').remove().end().append(serviceOp);
    }
  });
  $('#affectForm').on('submit', function (e) {
    e.preventDefault();
    console.log($('#affectForm').serialize());
    $.ajax({
      type: "POST",
      url: "/api/analyticAccounts/affect",
      data: $('#affectForm').serialize(),
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
        console.log(error);
        alert('Une erreur est survenue.');
      })
    });
  });
});
$('#affectModal').on('hide.bs.modal', function () {
  $(this).find('.selected-rows-list').empty();
  $(this).find('#affectStructure').empty().append("<option value='0'>Sélectionner une structure...</option>");
  $(this).find('#affectFolder').empty().append("<option value='0'>Sélectionner un dossier...</option>");
  $(this).find('#affectSector').empty().prop("disabled", true);
  $(this).find('#affectService').empty().prop("disabled", true);
});

/***/ }),

/***/ "./resources/js/parameters/accounts-analytic/modal_create.js":
/*!*******************************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic/modal_create.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#addModal').on('show.bs.modal', function () {
  var modal = $(this);
  var inputActive = modal.find('#addActive');
  var selectStructure = modal.find('#addStructure');
  var selectFolder = modal.find('#addFolder');
  var selectSector = modal.find('#addSector');
  var selectService = modal.find('#addService'); // Check active toggle by default

  inputActive.prop('checked', true).change(function () {
    if (this.checked) {
      inputActive.val(1);
    } else {
      inputActive.val(0);
    }
  }); // Get structures options

  $.ajax({
    type: 'GET',
    url: '/api/structures/',
    success: function success(response) {
      response.forEach(function (structure) {
        selectStructure.append("<option value=".concat(structure.id, ">").concat(structure.name, "</option>"));
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
  }); // Get folders options

  $.ajax({
    type: 'GET',
    url: '/api/folders/',
    success: function success(response) {
      response.forEach(function (folder) {
        selectFolder.append("<option value=".concat(folder.id, ">").concat(folder.name, "</option>"));
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
  }); // Listener for folder change

  selectFolder.on('change', function () {
    var folderId = $(this).val();
    var sectorOp = '';

    if (folderId == 0) {
      selectSector.empty().prop("disabled", true);
      selectService.empty().prop("disabled", true);
    } else {
      selectSector.prop("disabled", false);
    }

    selectService.empty().prop("disabled", true);
    $.ajax({
      type: 'GET',
      url: '/api/sectors/folder/' + folderId,
      success: success,
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

    function success(response) {
      sectorOp += '<option value="0" selected>Sélectionner un secteur...</option>';
      response.forEach(function (sector) {
        sectorOp += "<option value=\"".concat(sector.id, "\">").concat(sector.name, "</option>");
      });
      selectSector.find('option').remove().end().append(sectorOp);
    }
  }); // Listener for sector change

  selectSector.on('change', function () {
    var sectorId = $(this).val();
    var serviceOp = '';

    if (sectorId == 0) {
      selectService.prop("disabled", true).empty();
    } else {
      selectService.prop("disabled", false);
    }

    $.ajax({
      type: 'GET',
      url: '/api/services/sector/' + sectorId,
      success: success,
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

    function success(response) {
      serviceOp += '<option value="0" selected>Sélectionner un service...</option>';
      response.forEach(function (service) {
        serviceOp += "<option value=\"".concat(service.id, "\">").concat(service.name, "</option>");
      });
      selectService.find('option').remove().end().append(serviceOp);
    }
  }); // Submit form

  $('#addForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/api/analyticAccounts",
      data: $('#addForm').serialize(),
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
        alert("Une erreur est survenue. Vérifiez ceci : les champs marqués d'un * sont renseignés, le code que vous tentez d'ajouter n'existe pas déjà ; puis recommencez.");
      })
    });
  });
});
$('#addModal').on('hide.bs.modal', function () {
  $(this).find('input').val('');
  $(this).find('#addStructure').empty().append("<option value='0'>Sélectionner une structure...</option>");
  $(this).find('#addFolder').empty().append("<option value='0'>Sélectionner un dossier...</option>");
  $(this).find('#addSector').empty().prop("disabled", true);
  $(this).find('#addService').empty().prop("disabled", true);
});

/***/ }),

/***/ "./resources/js/parameters/accounts-analytic/modal_delete.js":
/*!*******************************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic/modal_delete.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#deleteModal').on('show.bs.modal', function (event) {
  var modal = $(this);
  var button = $(event.relatedTarget);
  var accountId = button.data('id');
  modal.find('.modal-body p').text("Voulez-vous supprimer le compte n\xB0 ".concat(accountId, " de votre plan de compte ?")); // Submit form

  $('#deleteForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: "DELETE",
      url: "/api/analyticAccounts/destroy/".concat(accountId),
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

/***/ "./resources/js/parameters/accounts-analytic/modal_edit.js":
/*!*****************************************************************!*\
  !*** ./resources/js/parameters/accounts-analytic/modal_edit.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#editModal').on('show.bs.modal', function (e) {
  var modal = $(this);
  var button = $(e.relatedTarget);
  var inputId = modal.find('#editId');
  var inputName = modal.find('#editName');
  var inputActive = modal.find('#editActive');
  var selectStructure = modal.find('#editStructure');
  var selectFolder = modal.find('#editFolder');
  var selectSector = modal.find('#editSector');
  var selectService = modal.find('#editService'); // Get account to edit

  $.ajax({
    type: 'GET',
    url: "/api/analyticAccounts/edit/".concat(button.data('id')),
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
    } // update active value according to toggle status


    inputActive.change(function () {
      if (this.checked) {
        inputActive.val(1);
      } else {
        inputActive.val(0);
      }
    }); // Get structures options

    $.ajax({
      type: 'GET',
      url: '/api/structures',
      success: function success(response) {
        response.forEach(function (structure) {
          selectStructure.append("<option value=".concat(structure.id, ">").concat(structure.name, "</option>"));
        });
        selectStructure.val(account.structure_id).prop("selected", true);
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
    }); // Get folder options

    $.ajax({
      type: 'GET',
      url: '/api/folders',
      success: function success(response) {
        response.forEach(function (folder) {
          selectFolder.append("<option value=".concat(folder.id, ">").concat(folder.name, "</option>"));
        });

        if (account.service !== null) {
          // Select current folder
          selectFolder.val(account.service.sector.folder.id).prop("selected", true);
        }
      },
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
    }); // Check if current account is affected to a service

    if (account.service !== null) {
      var sectorsSuccess = function sectorsSuccess(response) {
        response.forEach(function (sector) {
          sectorOp += "<option value=\"".concat(sector.id, "\">").concat(sector.name, "</option>");
        }); // Clear sector options / append new options / select current sector

        selectSector.append(sectorOp).val(account.service.sector.id).prop("selected", true).prop("disabled", false);
      }; // Get service options


      var servicesSuccess = function servicesSuccess(response) {
        response.forEach(function (service) {
          serviceOp += "<option value=\"".concat(service.id, "\">").concat(service.name, "</option>");
        }); // Clear service options / append new options / select current service

        selectService.append(serviceOp).val(account.service.id).prop("selected", true).prop("disabled", false);
      };

      // Get sector options
      var sectorOp = '';
      $.ajax({
        type: 'GET',
        url: "/api/sectors/folder/".concat(account.service.sector.folder.id),
        success: sectorsSuccess,
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
      var serviceOp = '';
      $.ajax({
        type: 'GET',
        url: "/api/services/sector/".concat(account.service.sector.id),
        success: servicesSuccess,
        error: function (_error5) {
          function error() {
            return _error5.apply(this, arguments);
          }

          error.toString = function () {
            return _error5.toString();
          };

          return error;
        }(function () {
          console.log(error.responseText.message);
        })
      });
    } else {
      selectFolder.val(0);
      selectSector.find('option').remove().end().prop("disabled", true);
      selectService.find('option').remove().end().prop("disabled", true);
    }
  } // Listener for folder change


  selectFolder.on('change', function () {
    var folderId = $(this).val();
    var newSectorOp = '';

    if (folderId == 0) {
      selectSector.empty().prop("disabled", true);
      selectService.empty().prop("disabled", true);
    } else {
      selectSector.prop("disabled", false);
    }

    selectService.empty().prop("disabled", true); // Get new sector options

    $.ajax({
      type: 'GET',
      url: "/api/sectors/folder/".concat(folderId),
      success: sectorsChangeSuccess,
      error: function (_error6) {
        function error() {
          return _error6.apply(this, arguments);
        }

        error.toString = function () {
          return _error6.toString();
        };

        return error;
      }(function () {
        console.log(error.responseText.message);
      })
    });

    function sectorsChangeSuccess(response) {
      newSectorOp += '<option value="0" selected>Sélectionner un secteur...</option>';
      response.forEach(function (sector) {
        newSectorOp += "<option value=\"".concat(sector.id, "\">").concat(sector.name, "</option>");
      }); // Clear sector options / append new options

      selectSector.find('option').remove().end().append(newSectorOp);
    }
  }); // Listener for sector change

  selectSector.on('change', function () {
    var sectorId = $(this).val();
    var newServiceOp = '';

    if (sectorId == 0) {
      selectService.empty().prop("disabled", true);
    } else {
      selectService.prop("disabled", false);
    } // Get new service options


    $.ajax({
      type: 'GET',
      url: "/api/services/sector/".concat(sectorId),
      success: servicesChangeSuccess,
      error: function (_error7) {
        function error() {
          return _error7.apply(this, arguments);
        }

        error.toString = function () {
          return _error7.toString();
        };

        return error;
      }(function () {
        console.log(error.responseText.message);
      })
    });

    function servicesChangeSuccess(services) {
      newServiceOp += '<option selected>Sélectionner un service...</option>';
      services.forEach(function (service) {
        newServiceOp += "<option value=\"".concat(service.id, "\">").concat(service.name, "</option>");
      }); // Clear service options / append new options

      selectService.find('option').remove().end().append(newServiceOp);
    }
  }); // Submit form

  $('#editForm').on('submit', function (e) {
    e.preventDefault();
    var accountId = inputId.val();
    $.ajax({
      type: "PATCH",
      url: "/api/analyticAccounts/update/".concat(accountId),
      data: $('#editForm').serialize(),
      success: function success() {
        modal.modal('hide');
        location.reload();
      },
      error: function (_error8) {
        function error(_x) {
          return _error8.apply(this, arguments);
        }

        error.toString = function () {
          return _error8.toString();
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
  $(this).find('#editStructure').find('option').remove().end().append("<option value='0'>Sélectionner une structure...</option>");
  $(this).find('#editFolder').find('option').remove().end().append("<option value='0'>Sélectionner un dossier...</option>");
  $(this).find('#editSector').find('option').remove().end().prop("disabled", true);
  $(this).find('#editService').find('option').remove().end().prop("disabled", true);
});

/***/ }),

/***/ 2:
/*!************************************************************!*\
  !*** multi ./resources/js/parameters/accounts-analytic.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/valou/Documents/DEV-WEB/PROJETS-LARAVEL/Pilotexc-lar/resources/js/parameters/accounts-analytic.js */"./resources/js/parameters/accounts-analytic.js");


/***/ })

/******/ });