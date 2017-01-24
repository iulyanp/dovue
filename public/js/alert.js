Vue.component('alert', {
    template: '#alert-template',
    props: ['type'],
    data: function() {
        return {
            show: false,
        }
    },
    computed: {
        alertClasses: function() {
            var type = this.type;
            return {
                'alert': true,
                'alert--success': type == 'success',
                'alert--error': type == 'error',
                'alert--warning': type == 'warning',
                'alert--info': type == 'info'
            }
        }
    }
});


new Vue({
    el: 'body',
});