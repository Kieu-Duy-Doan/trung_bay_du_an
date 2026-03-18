const allBtnSwitchBanner = document.querySelectorAll(".form-check-input");
const form = document.querySelector("#updateForBtnSwitch");

console.log(123);

if (allBtnSwitchBanner) {
    allBtnSwitchBanner.forEach((btnSwitchBanner) => {
        btnSwitchBanner.onchange = function () {
            const aElement = btnSwitchBanner.nextElementSibling;
            const active = btnSwitchBanner.checked ? 1 : 0;
            const bannerId = btnSwitchBanner.value;
            aElement.href = `banner/update?key=active&value=${active}&column=id&columnValue=${bannerId}`;
            aElement.click();
        };
    });
}
