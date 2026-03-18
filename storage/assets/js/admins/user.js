const checkBoxHandlers = document.querySelectorAll(".checkBoxHandler");

checkBoxHandlers.forEach(function (checkBoxHandler) {
    const allCheckBoxs = checkBoxHandler.querySelectorAll(".checkbox");
    const totalCheckBox = allCheckBoxs.length;
    const checkBoxAll = checkBoxHandler.querySelector(".checkAll");
    const selectedCount = checkBoxHandler.querySelector(".selectedCount");

    function updateCheckBoxQuantity() {
        const total =
            checkBoxHandler.querySelectorAll(".checkbox:checked").length;
        if (selectedCount) {
            selectedCount.innerHTML = total;
        }
    }

    allCheckBoxs.forEach((checkbox) => {
        checkbox.onchange = function () {
            checkBoxAll.checked =
                checkBoxHandler.querySelectorAll(".checkbox:checked").length ==
                totalCheckBox;
            if (selectedCount) {
                updateCheckBoxQuantity();
            }
        };
    });

    checkBoxAll.onchange = function () {
        allCheckBoxs.forEach((checkbox) => {
            checkbox.checked = checkBoxAll.checked;
        });
        if (selectedCount) {
            updateCheckBoxQuantity();
        }
    };

    ///Xử lý xóa form
    const deleteAllBtn = checkBoxHandler.querySelector(".btnDeleteAll");

    deleteAllBtn.onclick = function (event) {
        event.preventDefault();

        if (confirm("Bạn có chắc chắn muốn xóa các lựa chọn?")) {
            if (
                checkBoxHandler.querySelectorAll(".checkbox:checked").length ==
                0
            ) {
                alert("Vui lòng chọn chọn checkbox");
                return;
            }
            checkBoxHandler.submit();
        }
    };
});
