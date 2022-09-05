let scroll_to_bottom = document.getElementById("bill-container");
function scrollBottom(element) {
  element.scroll({ top: element.scrollHeight, behavior: "smooth" });
}

scrollBottom(scroll_to_bottom);

function open_bill_history() {
  document.getElementById("group_payment_history").showModal();
}

function close_bill_history() {
  try {
    document.getElementById("group_payment_history").close();
  } catch (err) {}
}

// payment history drows

function open_drawer(type) {
  let drawer_btns = document.getElementsByClassName("drawer-btn");
  for (let index = 0; index < drawer_btns.length; index++) {
    drawer_btns[index].classList.remove("active");
  }

  switch (type) {
    case 2:
      drawer_btns[1].classList.add("active");
      break;

    case 3:
      drawer_btns[2].classList.add("active");
      break;

    default:
      drawer_btns[0].classList.add("active");
      break;
  }

  let drawer = document.getElementById("payment_history_0");
  let child = drawer.children;

  for (let index = 0; index < child.length; index++) {
    const e = child[index];
    if (
      type == 1 ||
      (type == 2 && e.classList.contains("red")) ||
      (type == 3 && e.classList.contains("green"))
    ) {
      e.style.display = "flex";
    } else {
      e.style.display = "none";
    }
  }
}
