// Retrieve the sidebar element
const sidebar = document.querySelector(".sidebar");
// Retrieve the sidebar button element
const sidebarBtn = document.querySelector(".bx-menu");

// Retrieve the sidebar state from local storage
const isSidebarOpen = localStorage.getItem('sidebarOpen') === 'true';

// Toggle the sidebar state based on the stored value
if (isSidebarOpen) {
  sidebar.classList.remove("close");
} else {
  sidebar.classList.add("close");
}

// Add event listener to toggle the sidebar when the button is clicked
sidebarBtn.addEventListener("click", () => {
  // Toggle the sidebar class
  sidebar.classList.toggle("close");

  // Update the sidebar state in local storage
  const updatedState = sidebar.classList.contains("close") ? 'false' : 'true';
  localStorage.setItem('sidebarOpen', updatedState);
});



let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}

// let sidebar = document.querySelector(".sidebar");
// let sidebarBtn = document.querySelector(".bx-menu");
// // console.log(sidebarBtn);

// sidebar.classList.add("close");

// sidebarBtn.addEventListener("click", () => {
//   sidebar.classList.toggle("close");
// });

