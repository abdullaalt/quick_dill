var content = {
    tasks: {},
    current_page: 1,
    _sorted: 'id',
    count: 0,
    filter: {},
    filter_string: '',

    loadTasks: function(){
        xhr.sendRequest('/tasks?page='+this.current_page+'&sorted='+this._sorted+this.filter_string, 'setTasks', false, content) 
    },

    filter: function(field, source){
        this.filter[field] = source.val()

        let res = ''

        for (key in this.filter){
            if (this.filter[key] != '')
                res = '&' + key + '=' + this.filter[key]
        }

        this.filter_string = res

        this.loadPage(1)
    },

    sorted: function(val){
        this._sorted = val
        this.loadPage(1)
    },

    loadPage: function(page){
        this.current_page = page
        this.loadTasks()
    },

    setTasks: function (s, data, el){

        this.tasks = data.items
        this.count = data.count
        this.renderTasks()

    },

    renderTasks: function(){
        $('.tasks-list').html('').append($('#task').tmpl({
            'items': this.tasks
        }))

        this.renderPaginate()
    },

    renderPaginate: function(){
        let p = $('.tasks-paginate')
        p.html('')
        pages = Math.ceil(this.count/3)
        for (i=1; i<=pages; i++){
            if (i == this.current_page){
                p.append($('<span>'+i+'</span>'))
            }else{
                p.append($('<a onclick="content.loadPage('+i+')">'+i+'</a>'))
            }
        }
    },

    sendTask: function(){

        let fd = new FormData(document.getElementById('add-task'))

		xhr.sendRequest('/tasks', 'addTaskInList', null, content, 'POST', fd)

    },

    addTaskInList: function(s, data, el){

        $('#add-task')[0].reset()

        this.current_page = 1
        this.loadTasks()

    },

    setStatus: function(task_id, el){

        let fd = new FormData()
        fd.append('status', 'RESOLVED')
        xhr.sendRequest('/tasks/'+task_id, 'changeStatus', el, content, 'POST', fd, true)

    },

    changeStatus: function(s, data, el){

        el.prev().text('Завершена')
        el.remove()

    },

    changeText: function(task_id, el){
        text = el.prev().text()
        el.prev().remove()
        el.before($('<div><textarea>'+text+'</textarea><input type="button" value="Сохранить" onclick="content.saveText('+task_id+', $(this))" /><input type="button" value="Отмена" onclick="content.cancelText($(this))" /></div>'))
    },

    saveText: function(task_id, el){
        let fd = new FormData()
        fd.append('text', el.prev().val())
        xhr.sendRequest('/tasks/'+task_id, 'textChanched', el, content, 'POST', fd, true)
    },

    cancelText: function(task_id, el){
        this.loadTasks()
    },

    textChanched: function(s, data, el){
        this.loadTasks()
    },

    history: function(task_id){
        xhr.sendRequest('/tasks/'+task_id+'/history', 'showHistory', false, content)
    },

    showHistory: function(s, data, el){
        $('.popup > div').html('').append($('#history').tmpl({
            'items': data.data
        }))

        $('.popup').show()
    }
    
}