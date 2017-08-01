'use strict'

angular.module('Directives',['ngAnimate'])

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
