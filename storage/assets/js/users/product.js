const sortInput = document.querySelector("#sortSelect");

sortInput.onchange = function () {
    const url = sortInput.value;
    window.location.href = url;
};
