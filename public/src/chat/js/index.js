// index.js

document.addEventListener("DOMContentLoaded", () => {
    const userInfos = document.querySelectorAll(".user-info");

    userInfos.forEach(userInfo => {
        userInfo.addEventListener("click", (event) => {
            const userId = event.currentTarget.getAttribute("data-user-id");
            const userName = event.currentTarget.getAttribute("data-user-name");
            const userEmail = event.currentTarget.getAttribute("data-user-email");
            const userPicture = event.currentTarget.getAttribute("data-user-picture");

            showUserModal(userId, userName, userEmail, userPicture);
        });
    });
});

function showUserModal(userId, userName, userEmail, userPicture) {
    const modalHtml = `
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <img src="${userPicture}" alt="${userName}" class="h-24 w-24 rounded-full mx-auto mb-4">
                <h2 class="text-xl font-bold mb-2">${userName}</h2>
                <p class="text-gray-600">${userEmail}</p>
                <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded" onclick="closeModal()">Close</button>
            </div>
        </div>
    `;

    const modalContainer = document.createElement("div");
    modalContainer.id = "userModal";
    modalContainer.innerHTML = modalHtml;

    document.body.appendChild(modalContainer);
}

function closeModal() {
    const modalContainer = document.getElementById("userModal");
    if (modalContainer) {
        modalContainer.remove();
    }
}
