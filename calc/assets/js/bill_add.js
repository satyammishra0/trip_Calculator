const add_new_bill = (id) => {
  let bill_calculator = document.getElementById("bill_calculator");
  bill_calculator.showModal();
};

// Selecting all the members of split bill popup

function select_all_member() {
  let tick_mark_icon = document.getElementById("tick_mark_icon");
  tick_mark_icon.style.display = "block";
}
