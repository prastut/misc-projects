import _ from 'lodash';

export default function($scope, todoFactory) {

    let params = {
        hasInput: false
    };

    console.log(todoFactory.createTask);

    $scope.todos = [

        {
            task: 'Homework, that I was supposed to do yesterday',
            isCompleted: false,
            isEditing: false
        }, {
            task: 'Wash dirty clothes. They smell a lot!',
            isCompleted: true,
            isEditing: false
        }


    ];

    $scope.strikeCompleted = todo => {

        todo.isCompleted = !todo.isCompleted
    };

    $scope.onEdit = todo => {
    	console.log(todo);
        todo.isEditing = true;
        todo.updatedTodo = todo.task; 
    };

    $scope.createTodo = _.partial(todoFactory.createTodo, $scope, params);

    $scope.onCancel = todo => {
        todo.isEditing = false;
    };

    $scope.updateTodo = _.partial(todoFactory.updateTodo);

    $scope.deleteTodo = _.partial(todoFactory.deleteTodo, $scope);


    $scope.$watch('createTodoinput', _.partial(todoFactory.watchCreateTodoInput, params, $scope));

}
