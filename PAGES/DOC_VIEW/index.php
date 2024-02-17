<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        (function () {
            var devTools = {
                isOpen: false,
                isOpenTriggered: false,
                check: function () {
                    // Check if the console is open
                    if (!this.isOpen && window.console && window.console.debug) {
                        this.isOpen = true;
                        if (!this.isOpenTriggered) {
                            debugger;
                            this.isOpenTriggered = true;
                        }
                    }else{
                        location.href = "./DOC_VIEW.php";
                    }
                },
                loopCheck: function () {
                    setInterval(this.check.bind(this), 0);
                }
            };
            devTools.loopCheck();
        })();

    </script>
</body>

</html>