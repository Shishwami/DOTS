var sent_modal = document.getElementById("sent_modal");

var sent_btn = document.getElementById("RADIO_SEND");

var sent_span = document.getElementsByClassName("sent_close")[0];

sent_btn.onclick = function()
{
  sent_modal.style.display = "block";
}

sent_span.onclick = function()
{
  sent_modal.style.display = "none";
}

window.onclick = function(event)
{
  if (event.target == sent_modal)
  {
    sent_modal.style.display = "none";
  }
}
