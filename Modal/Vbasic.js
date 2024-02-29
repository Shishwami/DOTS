const rec_span = document.getElementsByClassName("rec_close")[0];
const sent_span = document.getElementsByClassName("sent_close")[0];

if (rec_span) {
  rec_span.onclick = function () {
    rec_modal.style.display = "none";
  }
}
if (sent_span) {
  sent_span.onclick = function () {
    sent_modal.style.display = "none";
  }
}

window.onclick = function (event) {
  if (event.target == sent_modal) {
    sent_modal.style.display = "none";
  }
  if (event.target == rec_modal) {
    rec_modal.style.display = "none";
  }
}