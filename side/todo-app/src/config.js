import angular from 'angular';
import uiRouter from 'angular-ui-router';
import todosController from 'todos/todos'
import todoFactory from "factories/todo-factory"

const app = angular.module('app', [uiRouter, todoFactory.name]);

app.config(($stateProvider, $urlRouterProvider, $locationProvider) => {
	$urlRouterProvider.otherwise('/');

	$stateProvider
		.state('todos', {
			url: '/',
			template: require('todos/todos.html'),
			controller: todosController
		})
		.state('about', {
			url: '/about',
			template: require('about/about.html')
		});


		//Make our URL's look nicer
		$locationProvider.html5Mode(true);
});

export default app;
