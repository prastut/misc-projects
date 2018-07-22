import angular from 'angular';
import appModule from 'config';
import 'css/master.scss'

//Attach the angular module in our HTML
angular.bootstrap(document, [appModule.name]);