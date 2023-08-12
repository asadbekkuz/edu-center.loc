let body = $('body')

$("#create-button").on('click',function (event) {
    event.preventDefault();
    let url = $(this).attr('href');
    send(url);
})

function send(_url,_data = null)
{
    $.ajax({
        url: _url,
        method: "POST",
        data: _data,
        dataType: "json",
        success:function (response){
            if(response.status == false)
            {
                $('#modal').modal('show').find('#modal-content').html(response.content);
                $('#saveButton').on('click',function (event) {
                    event.preventDefault()
                    let formData = $('#saveForm').serialize()
                    send(_url,formData)
                })
            }else{
                $('#modal').modal('hide');
                $.pjax.reload({container: '#pjaxGrid'});
            }
        }
    })
}

body.on('click','.update-button',function (event) {
    event.preventDefault()
    let url = $(this).attr('href')
    send(url);
})

body.on('click','.view-button',function (event){
    event.preventDefault()
    let url = $(this).attr('href')
    send(url);
})