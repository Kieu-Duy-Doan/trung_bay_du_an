const mailOpeningBtn = document.querySelector("#mail_opening");
const mailContentBtn = document.querySelector("#mail_content");
const modalLoading = document.querySelector(".modal-backdrop-custom");
const inputEmailGreeting = document.querySelector("#emailGreeting");
const inputEmailBody = document.querySelector("#emailBody");

const promtOpeningMail = `Từ mẫu sau: "Xin chào ${customerName}, chào mừng đến với DISPLAY_PROJECT Website". Hãy tạo ra 5 lời mở đầu tương tự như vậy. Nội dung cần tự nhiên, thu hút và tăng tỷ lệ mở email. Chỉ trả về nội dung hoàn chỉnh. Không giải thích. Không thêm tiêu đề. Không xuống dòng thừa.`;
const promtBodyMail = `Hãy là một nhân viên chăm sóc khách hàng với 10 năm kinh nghiệm. Hãy viết phần nội dung của email giải quyết vấn đề sau: "${customerProblem}". Với tên khách hàng là ${customerName} và tên người gửi là DISPLAY_PROJECT Website. Chỉ trả về nội dung hoàn chỉnh. Không giải thích. Không thêm tiêu đề. Không xuống dòng thừa.`;

mailOpeningBtn.onclick = function () {
    modalLoading.classList.remove("d-none");

    axios
        .post(
            `https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=${apiKey}`,
            {
                contents: [
                    {
                        parts: [
                            {
                                text: promtOpeningMail,
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
            mailOpeningBtn.previousElementSibling.classList.remove("d-none");
            mailOpeningBtn.previousElementSibling.innerHTML =
                error.response?.data || error.message;
        });
};

mailContentBtn.onclick = function () {
    modalLoading.classList.remove("d-none");

    axios
        .post(
            `https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=${apiKey}`,
            {
                contents: [
                    {
                        parts: [
                            {
                                text: promtBodyMail,
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
            inputEmailBody.value = text;
        })
        .catch((error) => {
            modalLoading.classList.add("d-none");
            mailContentBtn.previousElementSibling.classList.remove("d-none");
            mailContentBtn.previousElementSibling.innerHTML =
                error.response?.data || error.message;
        });
};
