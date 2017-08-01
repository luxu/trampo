'use strict'

angular.module('myApp.directives',['ngAnimate'])

      .directive('focus', function() {
          return function(scope, element) {
              element[0].focus();
          }
      })

      .directive('animateOnChange', function($animate) {
        return function(scope, elem, attr) {
            scope.$watch(attr.animateOnChange, function(nv,ov) {
              if (nv!=ov) {
                    var c = 'change-up';
                    $animate.addClass(elem,c, function() {
                    $animate.removeClass(elem,c);
                });
              }
            });
        }
      })

      // .directive('campodata', function (dateFilter) {
      //     return {
      //         require:'ngModel',
      //         link:function (scope, elm, attrs, ctrl) {

      //             var dateFormat = attrs['date'] || 'yyyy-MM-dd';

      //             ctrl.$formatters.unshift(function (modelValue) {
      //                 return dateFilter(modelValue, dateFormat);
      //             });
      //         }
      //     };
      // })

      // .directive('bsDatefield', function () {
      //     return {
      //       require: 'ngModel',
      //       link: function (scope, element, attrs, ngModelCtrl) {

      //         var dateFormat = attrs.bsDatefield || 'YYYY/MM/DD';

      //         ngModelCtrl.$parsers.push(function (viewValue) {

      //           //convert string input into moment data model
      //           var parsedMoment = moment(viewValue, dateFormat);

      //           //toggle validity
      //           ngModelCtrl.$setValidity('datefield', parsedMoment.isValid());

      //           //return model value
      //           return parsedMoment.isValid() ? parsedMoment.toDate() : undefined;
      //         });

      //         ngModelCtrl.$formatters.push(function (modelValue) {

      //           var isModelADate = angular.isDate(modelValue);
      //           ngModelCtrl.$setValidity('datefield', isModelADate);

      //           return isModelADate ? moment(modelValue).format(dateFormat) : undefined;
      //         });
      //       }
      //     };
      //   })

      .directive('myDate', ['$timeout', '$filter', function ($timeout, $filter)
          {
              return {
                  require: 'ngModel',

                  link: function ($scope, $element, $attrs, $ctrl)
                  {
                      var dateFormat = 'yyyy/MM/dd';
                      $ctrl.$parsers.push(function (viewValue)
                      {
                          //convert string input into moment data model
                          var pDate = Date.parse(viewValue);
                          if (isNaN(pDate) === false) {
                              return new Date(pDate);
                          }
                          return undefined;

                      });
                      $ctrl.$formatters.push(function (modelValue)
                      {
                          var pDate = Date.parse(modelValue);
                          if (isNaN(pDate) === false) {
                              return $filter('date')(new Date(pDate), dateFormat);
                          }
                          return undefined;
                      });
                      $element.on('blur', function ()
                      {
                          var pDate = Date.parse($ctrl.$modelValue);
                          if (isNaN(pDate) === true) {
                              $ctrl.$setViewValue(null);
                              $ctrl.$render();
                          } else {
                              if ($element.val() !== $filter('date')(new Date(pDate), dateFormat)) {
                                  $ctrl.$setViewValue($filter('date')(new Date(pDate), dateFormat));
                                  $ctrl.$render();
                              }
                          }

                      });
                      $timeout(function ()
                      {
                          $element.kendoDatePicker({

                              format: dateFormat
                          });

                      });
                  }
              };
          }]);
