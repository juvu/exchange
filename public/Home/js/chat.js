!(function(w){
				
    var chat = function(options){
        var _self = this;
        this.options = $.extend(true, {
            userid : "001",
            username : "user"
        }, options);
        this.ui = {
            box : "chat-box",
            body : "chat-box-body",
            footer : "chat-box-footer",
            chatButton : "chat-button"
        }
        this.connected = false;
        this.username = this.options.username;
        this.userid = this.options.userid;
        this.client = new WebSocket("ws://127.0.0.1:8080");
        this.client.onmessage = this.onMessage;
        this.client.onopen = this.onOpen;
    }

    /**
     * chat.init
     * 聊天室初始化
     */
    chat.prototype.init = function(){
        var _self = this;
        var $body = $("body");
        this.$chatBox = $('<div class="chat-close" />')
            .addClass(this.ui.box);
        this.$chatButton = $('<button id="chatButton" class="ui-button" />')
            .addClass(this.ui.chatButton)
            .text('发送')
            .attr({
                type : "button"
            });
        var $chatBody = $('<div />')
            .addClass(this.ui.body)
            .addClass('g-scrollbar');
        
        var $chatFooter = $('<div class="' + this.ui.footer + '" />')
            .append('<textarea id="inputMessage" class="chat-input" name="inputMessaeg" ></textarea>')
            .append(this.$chatButton);
        this.$chatBox.append($chatBody, $chatFooter);
        $body.append(this.$chatBox);
        //event
        this.$inputMessage = $("#inputMessage");
        this.$chatButton.on('click', function(){
            _self.send();
        })
        this.$inputMessage.on("keydown", function(){
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
                e.preventDefault();
                if($(this).val().trim() == ""){
                    $(this).val("");
                }else{
                    _self.send();
                }
            }
        })
        return this;
    }
    
    chat.prototype.open = function(){
        this.$chatBox.removeClass('chat-close').addClass('chat-open');
        return this;
    }
    
    chat.prototype.send = function(){
        var message = this.$inputMessage.val();
        message = cleanInput(message);
        if(message != ''){
            this.$inputMessage.val('');
            var obj = {
                userid : this.userid,
                username : this.username,
                message : message
            }
            addChatMessage(obj, true)
            this.client.send(JSON.stringify(obj));
        }
    }
    
    chat.prototype.onOpen = function(){
        //this.connected = true;
    }
    
    chat.prototype.onMessage = function(msg){
        var obj = JSON.parse(msg.data);
        addChatMessage(obj);
        $(".chat-box-body").scrollTop(400);
    }
    
    //防止注入标记
    function cleanInput(input){
        return $("<div/>").text(input).html();
    }
    
    function addChatMessage(obj, isSelf){
        var $useridDiv = $('<span class="chat-userid"/>')
          .text(obj.userid);
        var $usernameDiv = $('<p class="chat-username"/>')
          .text(obj.username + "：");
        var $messageBodyDiv = $('<div class="chat-text">')
          .text(obj.message);
        var $messageDiv = $('<li class="chat-message ' + (isSelf ? "chat-message-self" : "") + '"/>')
          .data('username', obj.username)
          .append($useridDiv, $usernameDiv, $messageBodyDiv);
        $(".chat-box-body").append($messageDiv);
    }
    
    w.chat = chat;
    
})(window)