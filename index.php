<html>
<head>
	<title>Botman Testing</title>
</head>
<body>

<p>test...</p>

<script>
    var botmanWidget = {
        frameEndpoint: 'http://localhost:8080/botmantest/chat.html',
        introMessage: 'Hello, I am a Chatbot',
        chatServer : 'http://localhost:8080/botmantest/chat.php', 
        title: 'My Chatbot', 
        mainColor: '#456765',
        bubbleBackground: '#ff76f4',
        aboutText: '',
        bubbleAvatarUrl: '',
    }; 
</script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</body>
</html>