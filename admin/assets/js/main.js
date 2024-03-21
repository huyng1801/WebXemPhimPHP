function toggleSidebar() {
    // Kiểm tra kích thước màn hình trước khi thực thi
    if (window.matchMedia("(min-width: 769px)").matches) {
      const sidebar = document.getElementById("sidebar");
      const main_content = document.getElementById("main-content");
      sidebar.classList.toggle("active");
  
      // Toggle margin-left of content based on sidebar state
      if (sidebar.classList.contains("active")) {
        main_content.style.marginLeft = "0";
      } else {
        main_content.style.marginLeft = "200px";
      }
    }
    else {
        const sidebar = document.getElementById("sidebar");
        const main_content = document.getElementById("main-content");
        sidebar.classList.toggle("active");
    
        if (sidebar.classList.contains("active")) {
            main_content.style.marginTop = "0";
          } else {
            main_content.style.marginTop = "200px";
            main_content.style.marginLeft = "0";
          }
    }
  }
// Định nghĩa hàm để xử lý sự kiện resize
function handleWindowResize() {
  const sidebar = document.getElementById("sidebar");
  const main_content = document.getElementById("main-content");

  // Kiểm tra kích thước màn hình
  if (window.innerWidth < 769) {
    if (sidebar.classList.contains("active")) {
      main_content.style.marginTop = "0";
      main_content.style.marginLeft = "0";
    } else {
      main_content.style.marginTop = "200px";
      main_content.style.marginLeft = "0";
    }

  } else {
    if (sidebar.classList.contains("active")) {
      main_content.style.marginTop = "0";
      main_content.style.marginLeft = "0";
    } else {
      main_content.style.marginTop = "0";
      main_content.style.marginLeft = "200px";
    }
     
  }
}

window.addEventListener("resize", handleWindowResize);

handleWindowResize();
