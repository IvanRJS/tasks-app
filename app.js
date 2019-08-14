let edit= false;
$(document).ready(function() {
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
        console.log(edit);
        let url = (edit === true) ? 'task-edit.php':'task-add.php';
        console.log(url);
        $.post(url, postData, function(response) {
           edit =  false ;
            console.log(response);
            $('#task-form').trigger('reset');
            fetchTasks();
            
        });
        e.preventDefault();
    });
})

//Delete task
$(document).on('click','.taskDelete', function () {
    let element =  $(this)[0].parentElement.parentElement;
    console.log(element);
    let id =$(element).attr('taskid');
  
    bootbox.confirm({
        message: "Are you sure you want to delete this task?",
        buttons: {
            cancel: {
                label: '<i class="material-icons">close</i> Cancel'
            },
            confirm: {
                label: '<i class="material-icons">check</i> Confirm'
            }
        },
        callback: function (result) {
            console.log(result);
            if(result==true){
                $.post('task-delete.php' , {id}, function (response) {
                console.log(response);
                fetchTasks();
            });
                }
        }
    })
    //if(confirm("Are you sure you want to delete this task?")){
        
    
});

//edit button
$(document).on('click',".taskEdit", function () {
    console.log("editing");
    edit =true;
    $('#name').focus();
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
                                <td> <!--<a href="#" class="task-item">--> ${task.name} <!--</a>--> </td>
                                <td> ${task.description} </td>
                                <td> 
                                    <i class="material-icons ibutton delete taskDelete">delete</i>
                                    <i class="material-icons ibutton edit taskEdit">edit</i>
                                </td>
                               
                             </tr>`
            });
            $('#tasks').html(template);
        }
    });
}