let scroll_to_bottom = document.getElementById("bill-container");
function scrollBottom(element) {
  element.scroll({ top: element.scrollHeight, behavior: "smooth" });
}

scrollBottom(scroll_to_bottom);
