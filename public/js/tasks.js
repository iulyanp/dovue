Vue.component('tasks', {
    template: '#tasks-template',

    data: function () {
        return {
            tasks: [],
            task: '',
            newTask: '',
            showTask: '',
            changeTask: '',
            filter: 'all',
            error: ''
        }
    },

    created: function() {
        this.getTasks();
    },

    computed: {
        remaining: function () {
            return this.tasks.filter(this.inProgress).length;
        },
        completions: function(){
            return this.tasks.filter(this.isCompleted).length;
        },
    },

    filters: {
        // @ToDo refactore this function
        sortDate: function() {
            return this.tasks.sort(function(a, b){
                return new Date(b.updated_at) - new Date(a.updated_at);
            });
        },
        // @ToDo refactore this function
        sortCompleted: function() {
            return this.tasks.sort(function(a, b){
                return a.completed - b.completed;
            });
        },
        filter: function() {
            if (this.filter == 'all') {
                return this.tasks;
            }

            return this.tasks.filter(this[this.filter]);
        }
    },

    methods: {
        getTasks: function() {
            this.$http.get('/api/tasks', function (tasks) {
                this.$set('tasks', tasks);
            });
        },
        completeTask: function(task) {
            task.completed = ! task.completed;
            this.saveEditTask(task);
            this.cancelTask();
        },
        deleteTask: function(task) {
            this.tasks.$remove(task);
            this.$http.delete('/api/task/' + task.id, function (task) {
                //console.log('deleted task with id: ' + task.id);
            });
        },
        clearCompleted: function() {
            this.tasks = this.tasks.filter(this.inProgress);

            this.$http.delete('/api/completed-tasks', function (task) {
                //console.log('deleted task with id: ' + task.id);
            });

            this.cancelTask();
        },
        cancelTask: function(task) {
            this.showTask = false;
            this.newTask = ''
        },
        addTask: function() {
            this.newTask = '';
            this.showTask = true;
        },
        saveTask: function(task) {
            this.$http.post('/api/task', {
                newTask: this.newTask
            }, function (task) {
                if (! task.error){
                    this.tasks.push(task);
                    this.newTask = '';
                    this.error = '';
                    return true;
                }
                return this.error = task.error;
            }).error(function (data, status, request) {
                console.error(data)
            });
        },
        saveEditTask: function (task) {
            this.$http.put('/api/task/' + task.id, {
                task: task
            }, function (task) {
                console.log(task.id + ' was edited!')
            });
        },
        isCompleted: function (task) {
            return task.completed;
        },
        inProgress: function(task) {
            return ! this.isCompleted(task)
        },
        setFilter: function(filter) {
            return this.filter = filter;
        }
    }
});


new Vue({
    el: 'body'
});