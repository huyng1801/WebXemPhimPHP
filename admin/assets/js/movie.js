function isValidVideoUrl(url) {
    // Sử dụng một biểu thức chính quy để kiểm tra xem đường dẫn có hợp lệ hay không
    var videoUrlPattern = /^(http(s)?:\/\/)?[\w.-]+\.\w+(\/\S*)?$/;
    return videoUrlPattern.test(url);
}

function updateVideo() {
    var videoUrl = document.getElementById("directory").value;
    var iframeElement = document.getElementById("video_frame");

    if (isValidVideoUrl(videoUrl)) {
        iframeElement.src = videoUrl;
    } else {
        iframeElement.src = "";
    }
}


function displayImage() {
    var imageUrl = document.getElementById("image_link").value;
    var imageElement = document.getElementById("image_display");
    imageElement.src = imageUrl;
}

document.addEventListener("DOMContentLoaded", function() {
    const allActorsSelect = document.getElementById("allActors");
    const selectedActorsList = document.getElementById("selectedActorsList");
    const selectedActorsInput = document.getElementById("selectedActors");
    const initialSelectedActors = Array.from(selectedActorsList.querySelectorAll("li")).map(item => item.dataset.actorId);
    selectedActorsInput.value = JSON.stringify(initialSelectedActors);
    // Thêm sự kiện double click cho các tùy chọn trong danh sách tất cả diễn viên
    allActorsSelect.addEventListener("dblclick", function() {
        const selectedOption = allActorsSelect.options[allActorsSelect.selectedIndex];
        if (selectedOption) {
            const actorId = selectedOption.value;
            const actorName = selectedOption.text;
            addActorToSelectedList(actorId, actorName);
            updateSelectedActorsInput(); // Cập nhật input ẩn
        }
    });

    // Thêm sự kiện click cho nút xóa diễn viên
    selectedActorsList.addEventListener("click", function(event) {
        if (event.target.classList.contains("remove-actor")) {
            const listItem = event.target.parentElement;
            const actorId = listItem.dataset.actorId;
            removeActorFromSelectedList(actorId);
            updateSelectedActorsInput(); // Cập nhật input ẩn
        }
    });

    // Hàm thêm diễn viên vào danh sách đã chọn
    function addActorToSelectedList(actorId, actorName) {
        const listItem = document.createElement("li");
        listItem.dataset.actorId = actorId;
        listItem.innerHTML = `
    <span class="actor-name">${actorName}</span>
    <span class="remove-actor">&#10006;</span>
`;
        selectedActorsList.appendChild(listItem);
    }

    // Hàm xóa diễn viên khỏi danh sách đã chọn
    function removeActorFromSelectedList(actorId) {
        const listItem = selectedActorsList.querySelector(`[data-actor-id="${actorId}"]`);
        if (listItem) {
            listItem.remove();
        }
    }

    // Hàm cập nhật giá trị của input ẩn
    function updateSelectedActorsInput() {
        const selectedActors = [];
        const listItems = selectedActorsList.querySelectorAll("li");
        listItems.forEach(function(item) {
            const actorId = item.dataset.actorId;
            selectedActors.push(actorId);
        });
        selectedActorsInput.value = JSON.stringify(selectedActors);
    }
});