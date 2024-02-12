<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Confirmation.css">
    <link rel="stylesheet" href="..//FontAwesome/css/all.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <title></title>
  </head>

  <script>
    function confirmAction() {
      let confirmation = document.getElementById("confirmation");
      if (!confirmation.classList.contains("modal-open")) {
        confirmation.classList.add("modal-open");
      }
    }

    function onCancel() {
      let confirmation = document.getElementById("confirmation");
      confirmation.classList.remove("modal-open");
    }

    function onConfirm() {
      onCancel();
    }

    document.addEventListener("DOMContentLoaded", () => {
      document
        .getElementById("confirmation")
        .addEventListener("click", onCancel);
      document
        .querySelector(".modal")
        .addEventListener("click", (e) => e.stopPropagation());
    });

    function modal_msg(headmsg,contmsg){
        confirmAction();
        let head_text = document.getElementById("modal_header");
        head_text.innerText = headmsg;
        content_text = document.getElementById("modal_content");
        content_text.innerText = contmsg
    }


  </script>

  <body id="body">

    <button id="delete" name="delete" onclick="modal_msg('Do Something','Sheesh Pare, you sure?')">Confirm</button>

    <div id="confirmation" class="modal-container">
      <div class="modal">
        <section>
          <header class="modal-header">
            <span onclick="onCancel()" class="fa-solid fa-x"></span>
            <h2 id="modal_header"></h2>
          </header>
          <section class="modal-content">
            <p id="modal_content"></p>
          </section>
          <footer class="modal-footer">
            <button class="modal-button" onclick="onCancel()">Cancel</button>
            <button class="modal-button modal-confirm-button" onclick="onConfirm()">Confirm</button>
          </footer>
        </section>
      </div>
    </div>

  </body>
</html>
