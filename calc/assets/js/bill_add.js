let bill_calculator = document.getElementById("bill_calculator");
let bill_select_all_btn = document.getElementById("select_all_btn");
const add_new_bill = (id) => {
  bill_calculator.showModal();
};

const close_dialog = () => {
  bill_calculator.close();
};
// Selecting all the members of split bill popup

// function select_all_member() {
//   // document.getElementById("tick_mark_icon").style.display = "block";

//   let list = document.querySelector("#member_list_ui");
//   for (let i = 0; i < list.children.length; i++) {
//     if ((list.children[i].children[0].style.display = "none")) {
//       list.children[i].children[0].style.display = "block";
//     } else {
//       list.children[i].children[0].style.display = "none";
//     }
//   }
// }

// Now the calculation function
const SPLITMEMBERS = [];

let user_id = document.getElementById("user_id");
if (user_id == null) {
  alert("Something went wrong");
}
SPLITMEMBERS.push(user_id.value);

// let billInput = document.getElementById("billInput").value;
let SPLIT_AMOUNT = 0;
const splitAmountInput = (ele) => {
  SPLIT_AMOUNT = ele.value;
  calc_per_person();
};

const calc_per_person = () => {
  if (SPLIT_AMOUNT != "" && SPLIT_AMOUNT > 0) {
    let per_person = Number(Math.floor(SPLIT_AMOUNT / SPLITMEMBERS.length));
    document.getElementById("per_person").innerText = "₹ " + per_person;
  }
};

const split_with_member = (id, ele) => {
  if (id == user_id.value) return;

  if (SPLITMEMBERS.indexOf(id) != -1) {
    SPLITMEMBERS.splice(SPLITMEMBERS.indexOf(id), 1);
    ele.innerText = "Add";
  } else {
    SPLITMEMBERS.push(id);
    ele.innerText = "Remove";
  }
  bill_select_all_btn.innerText = "Select All";
  calc_per_person();
};

const split_with_all_member = () => {
  let ele = bill_select_all_btn;
  let member_list = document.getElementById("group_member_list");
  if (member_list === null) return;
  member_list = member_list.value;

  try {
    member_list = JSON.parse(member_list);
  } catch (error) {
    console.log(error);
    member_list = [];
  }

  if (member_list.length == SPLITMEMBERS.length) {
    SPLITMEMBERS.length = 0;
    SPLITMEMBERS.push(user_id.value);
  } else {
    SPLITMEMBERS.length = 0;
    SPLITMEMBERS.push(user_id.value);
    member_list.forEach((member) => {
      let id = member.userid;
      if (id == user_id.value) return;

      if (SPLITMEMBERS.indexOf(id) != -1) {
        SPLITMEMBERS.splice(SPLITMEMBERS.indexOf(id), 1);
      } else {
        SPLITMEMBERS.push(id);
      }
    });
  }
  calc_per_person();

  let btn = document.getElementsByClassName("split-bill-member-btn");
  let btn_text = "";

  if (member_list.length == SPLITMEMBERS.length) {
    ele.innerText = "Unselect All";
    btn_text = "Remove";
  } else {
    ele.innerText = "Select All";
    btn_text = "Add";
  }

  for (let index = 0; index < btn.length; index++) {
    const element = btn[index];
    element.innerHTML = btn_text;
  }
};

// Split bill
const save_bill = () => {
  console.log();
};
