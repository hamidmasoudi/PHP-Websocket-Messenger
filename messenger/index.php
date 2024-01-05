<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="PHP Websocket Messenger">
        <meta name="keywords" content="Messenger">
        <meta name="author" content="@masoudiofficial">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Messenger</title>
        <link rel="icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAMAAAANIilAAAAAUVBMVEUisUyav0wisW7//+Pe2W7e//+a8v////8Aougiv6tOsUz/8qtO2eO9zEwisY29//91sUz//8h15v8izMj/5o0iv41O2ch1zEx15uO9/+Pe/+MT2quvAAABNklEQVRIx+3XYW+CMBSFYcRqq6tOkanz//9Qo9Lec1u3npslS0zsJwq8qU9AxM7/YXTv+J9j18lYhtvol3jOfHbfGWZy2mrxcxwGjD/WtviA8Rhs8ePgNDbGGNGJTMch1mQ+PtRkPt5+VmQ+FnQm87GgM9kQZ7QL9jijM7lvxX2OE3q/S3u++DihhXxsx7sCLeRzO94UaJl/t2On0UJeXdqxGKMmx3k73mu0kAci9hoNMyZWaCAvmFihccLEuBiSqVihcZuKYTX1KagYnMpPxbAckrkYoCe85lws6wUgk7FI1ZebiwWNZDIWtLrNydg9I7NxhY6ejyv0YIhL9ONxxsbuCZmOC3T0lrhAD6ZYo6cnOB2PNZmPFTp6WyyvA/JGR8eITr/UfDxWZEMM6Oh/i99/E14ivgLYjUwCTswLfwAAAABJRU5ErkJggg==">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <div class="xboxmessages" id="xboxmessages"></div>
        <div class="xboxmessenger" id="xboxmessenger">
            <input type="text" class="xboxname" id="xboxname" placeholder="Name" autocomplete="off">
            <input type="text" class="xboxmessege" id="xboxmessege" placeholder="Message ..." autocomplete="off">
            <button type="submit" class="xboxsubmit" id="xboxsubmit" onclick="xmessagesend();">Send</button>
        </div>

        <script src="script.js"></script>
    </body>
</html>
