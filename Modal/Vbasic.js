const rec_span = document.getElementsByClassName("rec_close")[0];

if (rec_span) {
    rec_span.onclick = function()
    {
    rec_modal.style.display = "none";
    }
  }

window.onclick = function(event)
{
  if (event.target == rec_modal)
  {
    rec_modal.style.display = "none";
  }
}