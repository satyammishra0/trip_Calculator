let bill_calculator = document.getElementById("bill_calculator");
let bill_select_all_btn = document.getElementById("select_all_btn");

const SPLITMEMBERS = [];
let SPLIT_AMOUNT = 0;

const add_new_bill = (id) => {
  bill_calculator.showModal();
};

const close_dialog = () => {
  bill_calculator.close();
};

// add a default user in bill
let user_id = document.getElementById("user_id");
if (user_id == null) {
  alert("Something went wrong");
}

let group_id = document.getElementById("group_id");
if (group_id == null) {
  alert("Something went wrong");
}
SPLITMEMBERS.push(user_id.value);

// ===========================================================

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
const split_bill = () => {
  let remark = document.getElementById("bill-remark");
  remark = remark != null ? remark.value : "";

  if (SPLIT_AMOUNT != 0 && SPLITMEMBERS.length > 0) {
    let data = new FormData();
    data.append("amount", SPLIT_AMOUNT);
    data.append("members", JSON.stringify(SPLITMEMBERS));
    console.log(JSON.stringify(SPLITMEMBERS));
    data.append("remark", remark);
    data.append("group_id", group_id.value);

    fetch(url("services/bill/add.php"), {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((res) => {
        console.log(res);
        if (res.result) {
          alert("Bill created successfully");
          window.location.reload();
        } else {
          if (res.code == 4001) {
            alert("Your spending should be more than 0");
            return;
          }
          if (res.code == 4002) {
            alert("Select atleast a member to split a bill");
            return;
          }
        }
      });
  } else {
    if (SPLIT_AMOUNT == 0) {
      alert("Your spending should be more than 0");
      return;
    }
    if (SPLITMEMBERS.length < 1) {
      alert("Select atleast a member to split a bill");
      return;
    }
  }
};
