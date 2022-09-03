let GROUP_CATEGORY = "",
  GROUP_NAME = "",
  GROUP_MEMBERS = [];

// Steps

const STEP1 = document.getElementById("select-type"),
  STEP2 = document.getElementById("customize-group"),
  STEP3 = document.getElementById("customize-group-member");

// Setting the group icon according to name
let group_name = document.getElementById("group-name");

group_name.addEventListener("keyup", () => {
  if (group_name.value != "")
    document.getElementById("group-icon-name").innerHTML =
      group_name.value.charAt(0);
});

// First properties to hide and display the winodw modal

function customize_group(category) {
  let select_type = document.getElementById("select-type");
  let customize_group = document.getElementById("customize-group");

  if (category != "")
    (select_type.style.display = "none"),
      (customize_group.style.display = "block"),
      (GROUP_CATEGORY = category);
}

// Checking if the user has filled the group name

const create_group = () => {
  let group_name = document.getElementById("group-name").value;
  let customize_group_member = document.getElementById(
    "customize-group-member"
  );
  let customize_group = document.getElementById("customize-group");

  if (group_name != "") {
    customize_group.style.display = "none";
    customize_group_member.style.display = "block";
    GROUP_NAME = group_name;
  } else {
    document.getElementById("name-error").innerHTML =
      "Please Enter a group name";
  }
};

const add_user = (id, ele) => {
  if (id != "") {
    if (GROUP_MEMBERS.indexOf(id) == -1) {
      ele.innerText = "Remove";
      GROUP_MEMBERS.push(id);
    } else {
      ele.innerText = "Add";
      GROUP_MEMBERS.splice(GROUP_MEMBERS.indexOf(id), 1);
    }
    // console.log(GROUP_MEMBERS);
    // console.log(GROUP_NAME);
  }
};

const make_group = () => {
  if (GROUP_CATEGORY != "" && GROUP_NAME != "" && GROUP_MEMBERS.length > 0) {
    let data = new FormData();
    data.append("category", GROUP_CATEGORY);
    data.append("name", GROUP_NAME);
    data.append("member_list", JSON.stringify(GROUP_MEMBERS));

    fetch(url("services/group/create.php"), {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((res) => {
        console.log(res);
        if (res.result) {
          window.location.href = url("group/" + res.data.group_id);
        } else {
          handleError(res.code, res.message);
        }
      });
  } else {
    if (GROUP_CATEGORY == "") {
      handleError(4002, "Please select a group category");
      return;
    }
    if (GROUP_NAME == "") {
      handleError(4003, "Please enter group name");
      return;
    }
    if (GROUP_MEMBERS.length == 0) {
      handleError(4004, "Please select atleast a member");
      return;
    }
  }
};

function handleError(code, message) {
  if (code == 4001) {
    STEP1.style.display = "block";
    STEP2.style.display = "none";
    STEP3.style.display = "none";
  }

  if (code == 4002) {
    STEP1.style.display = "block";
    STEP2.style.display = "none";
    STEP3.style.display = "none";

    document.getElementById("group-category-error").innerHTML = message;
  }
  if (code == 4003) {
    STEP1.style.display = "none";
    STEP2.style.display = "block";
    STEP3.style.display = "none";

    document.getElementById("name-error").innerHTML = message;
  }
  if (code == 4004) {
    STEP1.style.display = "none";
    STEP2.style.display = "none";
    STEP3.style.display = "block";

    document.getElementById("group-member-error").innerHTML = message;
  }
  if (code == 4005) {
    STEP1.style.display = "block";
    STEP2.style.display = "none";

    document.getElementById("group-member-error").innerHTML = message;
  }
}
