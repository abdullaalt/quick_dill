@verbatim
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@600&family=Open+Sans:wght@300;400;500;600;700;800&family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet"> 
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <link href="/css/styles.css" rel="stylesheet" />
    <script src="/js/jtmpl.js"></script>
    <script src="/js/jquery.cookies.js"></script>
    <script src="/js/xhr.js"></script>
    <script src="/js/content.js"></script>

    <title>Задачник</title>

    <script>
        $(document).ready(function(){

            content.loadTasks()

            $('.popup').click(function(){
                $(this).children('div').html('')
                $(this).hide()
            })

            $('.popup > div').click(function(e){
                e.stopPropagation()
            })
        })
    </script>
</head>
<body>
    
    <main>
        <div class="tasks">
            <div class="filter-panel">
                <div class="field">
                    <label>
                        Отобразить по дате: 
                        <input onchange="content.filter('created_at', $(this))" type="date" name="by_date" class="filter_by_date"/>
                    </label>
                </div>

                <div class="field">
                    <label>
                        Статус: 
                        <select name="by_status" onchange="content.filter('status', $(this))" >
                            <option value="">Любой</option>
                            <option value="ACTIVE">На рассмотрении</option>
                            <option value="RESOLVED">Завершена</option>
                        </select>
                    </label>
                </div>
            </div>

            <div class="tasks-list">

            </div>

            <div class="tasks-paginate">

            </div>

        </div>

        <div class="forms">

            <form id="add-task">
                <div class="field text-input">
                    <label>
                        <input type="text" name="name" placeholder="Ваше имя" />
                    </label>
                </div>

                <div class="field text-input">
                    <label>
                        <input type="text" name="email" placeholder="Ваш email" />
                    </label>
                </div>

                <div class="field textarea-field">
                    <label>
                        <textarea name="text" placeholder="Текст задачи"></textarea>
                    </label>
                </div>

                <div class="field btn-input">
                    <label>
                        <input type="button" name="email" value="Отправить" onclick="content.sendTask()" />
                    </label>
                </div>
            </form>
        </div>
    </main>   

    <div class="popup">
        <div>
            
        </div>
    </div>

</body>

<script id="history" type="text/x-jquery-tmpl">
{{each(index, item) items}}
    <div class="history-item">
        ${item.text}
        <span>${item.date}</span>
    </div>
{{/each}}
</script>

<script id="task" type="text/x-jquery-tmpl">
    <table>
        <tr>
            <th onclick="content.sorted('name')">Имя пользователя</th>
            <th onclick="content.sorted('email')">E-mail</th>
            <th>Текст</th>
            <th>Дата добавления</th>
            <th onclick="content.sorted('status')">Статус</th>
        </tr>
        {{each(index, item) items}}
            <tr>
                <td>${item.name}</td>
                <td>${item.email}</td>
                <td>
                    <span>${item.text}</span>
                    <br>
                    <a onclick="content.changeText(${item.id}, $(this))">Изменить</a>

                    {{if item.is_updated}}
                        <a onclick="content.history(${item.id})">История изменений</a>
                    {{/if}}
                </td>
                <td>${item.date}</td>
                <td>
                    <span>${item.status}</span>
                    {{if item.status_int != 'RESOLVED'}}
                        <a onclick="content.setStatus(${item.id}, $(this))">Завершить</a>
                    {{/if}}
                </td>
            </tr>
        {{/each}}
    </table>
</script>
</html>
@endverbatim