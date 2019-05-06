$(document).ready(function() {
    let edit= false;
    fetchTasks();
    console.log('JQuery is working');
    $('#task-result').hide();
    //when a key is pressed show similar tasks names
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

//Add task
    $('#task-form').submit(function name(e) {
        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
            id : $('#task-id').val()
        };
        //if editing...
        let url = (edit === false) ? 'task-edit.php':'task-add.php';
        console.log(url);
        $.post(url, postData, function(response) {
           edit = (edit === false) ? true : false ;
            console.log(response);
            $('#task-form').trigger('reset');
            fetchTasks();
        });
        e.preventDefault();
    });

})

//Delete task
$(document).on('click','.taskDelete', function () {
  
    if(confirm("Are you sure you want to delete this task?")){
        let element =  $(this)[0].parentElement.parentElement;
        let id =$(element).attr('taskid');
        $.post('task-delete.php' , {id}, function (response) {
            console.log(response);
            fetchTasks();
        });
    }
});

$(document).on('click',".task-item", function () {
    console.log("editing");
    edit =true;
    let element = $(this)[0].parentElement.parentElement;
    let id= $(element).attr('taskid');
    console.log(id);
    $.post('task-single.php',{id},function (response) {
        console.log(response);
        const task = JSON.parse(response);
        $('#name').val(task.name);
        $('#description').val(task.description);
        $('#task-id').val(task.id);
    });
    
});

//select all tasks
function fetchTasks() {
    $.ajax({
        url: 'task-list.php',
        type: 'GET',
        success: function(response) {

            let tasks = JSON.parse(response);
            //console.log(response);
            let template = ``;

            tasks.forEach(task => {
                template += `<tr taskid="${task.id}"> 
                                <td> ${task.id} </td>
                                <td> <a href="#" class="task-item"> ${task.name} </a> </td>
                                <td> ${task.description} </td>
                                <td> 
                                    <button class="taskDelete btn btn-danger">
                                        Delete
                                    </button> 
                                </td>
                             </tr>`
            });
            $('#tasks').html(template);
        }
    });
}