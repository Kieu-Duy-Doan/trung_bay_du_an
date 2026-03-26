const mailOpeningBtn = document.querySelector("#mail_opening");
const modalLoading = document.querySelector(".modal-backdrop-custom");
const inputEmailGreeting = document.querySelector("#emailGreeting");

console.log(customerName);
console.log(customerEmail);
console.log(customerProblem);

mailOpeningBtn.onclick = function () {
    modalLoading.classList.remove("d-none");

    axios
        .post(
            `https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=AIzaSyC00i3nWgHXqyyaM8sJL0AuPbdGtRnCJFk`,
            {
                contents: [
                    {
                        parts: [
                            {
                                text: `Hãy tạo 5 tiêu đề email (subject) ngắn gọn, chuyên nghiệp và thân thiện bằng tiếng Việt để phản hồi khách hàng. Mỗi subject phải theo cấu trúc: "Xin chào Đoàn từ DISPLAY_PROJECT WEBSITE". Nội dung cần tự nhiên, thu hút và tăng tỷ lệ mở email.`,
                            },
                        ],
                    },
                ],
            },
            {
                headers: {
                    "Content-Type": "application/json",
                },
            },
        )
        .then((response) => {
            modalLoading.classList.add("d-none");
            const text = response.data.candidates[0].content.parts[0].text;
            inputEmailGreeting.value = text;
        })
        .catch((error) => {
            modalLoading.classList.add("d-none");
            console.error(error.response?.data || error.message);
        });
};
