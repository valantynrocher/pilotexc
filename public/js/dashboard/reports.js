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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/reports/chart_analytic-evol-charges-product.js":
/*!*********************************************************************!*\
  !*** ./resources/js/reports/chart_analytic-evol-charges-product.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var spinner = $('#spinner1');
  var ctx = $('#analyticalEvolutionChart');
  var filter = $('#analyticalEvolutionChartFilter');
  var barChart; // Get Sector Options (filter)

  $.ajax({
    type: 'GET',
    url: '/api/sectors/',
    success: function success(response) {
      response.forEach(function (sector) {
        filter.append("<option value=".concat(sector.id, ">").concat(sector.name, "</option>"));
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
      console.log(error);
    })
  }); // Listener on sector (filter) change

  filter.on('change', function () {
    var sectorId = $(this).val();
    renderChart(sectorId);
  }); // Render Chart JS element

  var renderChart = function renderChart() {
    var sectorId = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
    $.ajax({
      type: 'GET',
      url: "/api/reports/analyticalEvolutionChart/sector/".concat(sectorId),
      dataType: 'JSON',
      beforeSend: function beforeSend() {
        spinner.show();
      },
      success: function success(response) {
        spinner.hide();
        ctx.show(); // if the chart is not undefined then destory the old one so we can create a new one later

        if (barChart) {
          barChart.destroy();
        } // Create chart


        barChart = new Chart(ctx, {
          type: 'bar',
          options: {
            responsive: true,
            title: {
              display: false
            },
            tooltips: {
              mode: 'index',
              intersect: true
            }
          }
        }); // Fill chart with response

        barChart.data = {
          labels: response.labels,
          datasets: response.datasets
        };
        barChart.update();
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
        console.log(error);
      })
    });
  }; // Initialize chart data when document is ready


  renderChart();
});

/***/ }),

/***/ "./resources/js/reports/chart_products-division-sector.js":
/*!****************************************************************!*\
  !*** ./resources/js/reports/chart_products-division-sector.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var spinner = $('#spinner2');
  var ctx = $('#productsDivisionChart');
  var filter = $('#productsDivisionChartFilter');
  var pieChart;
  var filterDefaultValue; // Get Sector Options (filter)

  $.ajax({
    type: 'GET',
    url: '/api/fiscalYears/getLastFive',
    success: function success(response) {
      response.forEach(function (fiscalYear) {
        filter.append("<option value=".concat(fiscalYear.id, ">").concat(fiscalYear.name, "</option>"));
      });
      filterDefaultValue = filter.find('option:first-child').val(); // Initialize chart data when filter options are loaded

      renderChart(filterDefaultValue);
    },
    error: function error(_error) {
      console.log(_error);
    }
  }); // Listener on sector (filter) change

  filter.on('change', function () {
    var fiscalYearId = $(this).val();
    renderChart(fiscalYearId);
  }); // Render Chart JS element

  var renderChart = function renderChart(fiscalYearId) {
    $.ajax({
      type: 'GET',
      url: "/api/reports/productsDivisionChart/fiscalYear/".concat(fiscalYearId),
      dataType: 'JSON',
      beforeSend: function beforeSend() {
        spinner.show();
      },
      success: function success(response) {
        spinner.hide();
        ctx.show(); // if the chart is not undefined then destory the old one so we can create a new one later

        if (pieChart) {
          pieChart.destroy();
        } // Create chart


        pieChart = new Chart(ctx, {
          type: 'pie',
          options: {
            responsive: true,
            title: {
              display: false
            },
            animation: {
              animateScale: true,
              animateRotate: true
            }
          }
        }); // Fill chart with response

        pieChart.data = {
          labels: response.labels,
          datasets: response.datasets
        };
        pieChart.update();
      },
      error: function error(_error2) {
        console.log(_error2);
      }
    });
  };
});

/***/ }),

/***/ "./resources/js/reports/reports.js":
/*!*****************************************!*\
  !*** ./resources/js/reports/reports.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./chart_analytic-evol-charges-product */ "./resources/js/reports/chart_analytic-evol-charges-product.js");

__webpack_require__(/*! ./chart_products-division-sector */ "./resources/js/reports/chart_products-division-sector.js");

/***/ }),

/***/ 5:
/*!***********************************************!*\
  !*** multi ./resources/js/reports/reports.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/valou/Documents/DEV-WEB/PROJETS-LARAVEL/Pilotexc-lar/resources/js/reports/reports.js */"./resources/js/reports/reports.js");


/***/ })

/******/ });