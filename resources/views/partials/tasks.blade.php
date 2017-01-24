<template id="tasks-template">
    <h1>
        <button class="btn btn-success" v-on:click="addTask">
            <i class="glyphicon glyphicon-plus"></i>
        </button>
        <button class="btn btn-default" v-show="showTask || ! remaining" v-on:click="cancelTask">
            <i class="glyphicon glyphicon-minus"></i>
        </button>

        <a class="logo">do<span>Vue</span></a>
    </h1>

    <div class="alert alert-danger" v-show="error" v-text="error"></div>
    <div class="input-group" v-show="showTask || ! remaining" >
        <input type="text" placeholder="add new task" autofocus autocomplete="off"
               class="form-control" v-el="newTask" v-model="newTask" v-on:keyup.enter="saveTask">

                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" v-on:click="saveTask">
                            <i class="glyphicon glyphicon-plus"></i> Add task
                        </button>
                    </span>
    </div>
    <hr>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <i class="glyphicon glyphicon-tasks"></i> doVue
        </div>

        <ul class="list-group">
            <li
                    id="task_@{{ task.id }}"
                    class="list-group-item"
                    v-for="task in tasks | sortDate | sortCompleted | filter completed"
                    v-on:dblclick="editTask(task)"
                    :class="{ 'disabled': task.completed }"
            >
                <i class="glyphicon glyphicon-ok"
                   v-on:click="completeTask(task)"
                   :class="{ 'icon-success': task.completed }"></i> <!-- v-if="task.completed" -->

                @{{ task.body }}

                <i class="glyphicon glyphicon-remove pull-right icon-danger" v-if="!task.completed" v-on:click="deleteTask(task)"> </i>
                <span class="date pull-right">Created: @{{ task.created_at }}</span>

            </li>
        </ul>
    </div>

    <div class="alert alert-warning" role="alert" v-if="! tasks.length">No tasks yet! Add the first task...</div>

    <div class="col-lg-12">
        <a class="label label-default"
           :class="{'label-success': filter == 'all'}"
           v-on:click="setFilter('all')">All</a>

        <a class="label label-default"
           :class="{'label-success': filter == 'inProgress'}"
           v-on:click="setFilter('inProgress')"
           v-show="remaining">In progress</a>

        <a class="label label-default"
           :class="{'label-success': filter == 'isCompleted'}"
           v-on:click="setFilter('isCompleted')"
           v-show="completions">Completed</a>

        <a class="label label-danger"
           v-on:click="clearCompleted"
           v-show="completions">Clear Completed</a>

        <span v-show="remaining" class="small pull-right">@{{ remaining }} items left</span>
    </div>
</template>