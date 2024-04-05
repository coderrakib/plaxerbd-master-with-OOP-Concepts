<button class="chat_open" onclick="openChat()"><i class="icon icon-message"></i></button>
    <div class="wrapper" id="chat_box">
        <div class="title">Welcome To Plaxerbd</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <img src="images/cropped-P-favicon.png" alt="icon-user" width="16" height="16">
                </div>
                <sub style="top: 8px; left: -10px; width:9px; height:9px; background:green; border: 1px solid #fff; border-radius:50%;"></sub>
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
        <button class="chat_close" onclick="closeChat()"><i class="icon icon-times-circle"></i></button>
    </div>
    <script>
        function openChat() {
            document.getElementById("chat_box").style.display = "block";
        }
        function closeChat() {
            document.getElementById("chat_box").style.display = "none";
        }
    </script>
    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                // start ajax code
                $.ajax({
                    url: 'chat_message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="images/cropped-P-favicon.png" alt="icon-user" width="16" height="16"></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>