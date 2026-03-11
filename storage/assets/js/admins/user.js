const allCheckBoxs = document.querySelectorAll(".checkbox");
const totalCheckBox = allCheckBoxs.length;
const checkBoxAll = document.querySelector("#checkAll");

allCheckBoxs.forEach((checkbox) => {
    checkbox.onchange = function () {
        checkBoxAll.checked =
            document.querySelectorAll(".checkbox:checked").length ==
            totalCheckBox;
    };
});

checkBoxAll.onchange = function () {
    allCheckBoxs.forEach((checkbox) => {
        checkbox.checked = checkBoxAll.checked;
    });
};

///Xử lý xóa form

const formDelete = document.getElementById("formDelete");
const deleteAllBtn = document.querySelector("#btnDeleteAll");

console.log(formDelete);
console.log(deleteAllBtn);

deleteAllBtn.onclick = function (event) {
    event.preventDefault();

    if (confirm("Bạn có chắc chắn muốn xóa các lựa chọn?")) {
        if (document.querySelectorAll(".checkbox:checked").length == 0) {
            alert("Vui lòng chọn tài khoản muốn xóa");
            return;
        }
        formDelete.submit();
    }
};
