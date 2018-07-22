import angular from 'angular';
import _ from 'lodash';

const todoFactory = angular.module('app.todoFactory', [])

.factory('todoFactory', () => {

    function createTodo($scope, params) {

        params.hasInput = false;
        $scope.createTodoinput = ''
    }

    function updateTodo(todo) {
        todo.task = todo.updatedTodo;
        todo.isEditing = false;

    }

    function deleteTodo($scope, todoToDelete) {

        _.remove($scope.todos, todo => todo.task === todoToDelete.task);

    }

    function watchCreateTodoInput(params, $scope, val) {
    	
        if (!val && params.hasInput) {
            $scope.todos.pop();
            params.hasInput = false;
        } else {
            if (val && !params.hasInput) {
                $scope.todos.push({ task: val, isCompleted: false, isEditing: false });
                params.hasInput = true;
            } else if (val && params.hasInput) {
                $scope.todos[$scope.todos.length - 1].task = val;
            }

        }
    }

    return {
        createTodo,
        updateTodo,
        deleteTodo,
        watchCreateTodoInput
    };



});

export default todoFactory;
