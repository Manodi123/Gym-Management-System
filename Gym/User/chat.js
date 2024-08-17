$(document).ready(function(){
    $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
    });

    $('.send_btn').click(function(){
        sendMessage();
    });

    $('.type_msg').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            sendMessage();
        }
    });

    $('.attach_btn').click(function(){
        // Trigger file input click event
        $('#file_input').click();
    });

    $('#file_input').change(function(){
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                sendMedia(e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    function sendMessage(){
        var message = $('.type_msg').val();
        if($.trim(message) != ''){
            appendMessage(message, 'text', true);
            $('.type_msg').val('');
        }
    }

    function sendMedia(dataUrl){
        appendMessage(dataUrl, 'image', true); // Assuming it's an image, you can adjust this for videos or audio
    }

    function appendMessage(content, type, isUser){
        var currentTime = getCurrentTime();
        var messageContent = '';
        if(type === 'text'){
            messageContent = '<div class="d-flex justify-content-' + (isUser ? 'end' : 'start') + ' mb-4"><div class="msg_cotainer_' + (isUser ? 'send' : 'receive') + '">' + content + '<span class="msg_time_' + (isUser ? 'send' : 'receive') + '">' + currentTime + '</span></div><div class="img_cont_msg"><img src="' + (isUser ? 'https://avatars.hsoubcdn.com/ed57f9e6329993084a436b89498b6088?s=256' : 'https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg') + '" class="rounded-circle user_img_msg"></div></div>';
        } else if(type === 'image'){
            messageContent = '<div class="d-flex justify-content-' + (isUser ? 'end' : 'start') + ' mb-4"><div class="msg_cotainer_' + (isUser ? 'send' : 'receive') + '"><img src="' + content + '" alt="Image"><span class="msg_time_' + (isUser ? 'send' : 'receive') + '">' + currentTime + '</span></div><div class="img_cont_msg"><img src="' + (isUser ? 'https://avatars.hsoubcdn.com/ed57f9e6329993084a436b89498b6088?s=256' : 'https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg') + '" class="rounded-circle user_img_msg"></div></div>';
        } else {
            // Handle video, audio, etc.
        }
        $('.msg_card_body').append(messageContent);
        $('.msg_card_body').scrollTop($('.msg_card_body')[0].scrollHeight);
    }

    function getCurrentTime(){
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var currentTime = hours + ':' + minutes + ' ' + ampm;
        return currentTime;
    }
});
