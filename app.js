$(document).ready(function() {
    fetchTasks();
    console.log('JQuery is working');
    $('#task-result').hide();
    $('#search').keyup(function(e) {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: { search },
                success: function(response) {
                    let tasks = JSON.parse(response);
                    console.log(response);
                    let template = ``;

                    tasks.forEach(task => {
                        template += `<li> ${task.name} </li>`
                    });
                    $('#container').html(template);
                    $('#task-result').show();
                }
            });
        }
    })

    $('#task-form').submit(function name(e) {
        const postData = {
            name: $('#name').val(),
            description: $('#description').val()
        };
        $.post('task-add.php', postData, function(response) {
            console.log(response);
            $('#task-form').trigger('reset');
            fetchTasks();
        });
        e.preventDefault();
    });


})

function fetchTasks() {
    $.ajax({
        url: 'task-list.php',
        type: 'GET',
        success: function(response) {

            let tasks = JSON.parse(response);
            console.log(response);
            let template = ``;

            tasks.forEach(task => {
                template += `<tr> 
                                <td> ${task.id} </td>
                                <td> ${task.name} </td>
                                <td> ${task.description} </td>
                             </tr>`
            });
            $('#tasks').html(template);
        }
    });
}