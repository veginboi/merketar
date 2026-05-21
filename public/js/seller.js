const dashBoardBtn = document.querySelector(".dashboardBtn");
const dashboardMoreInfo = document.querySelectorAll(".dashboardMoreInfo");
const exitMoreInfo = document.querySelector(".exitMoreInfo")
const sideBarLink = document.querySelectorAll(".sidebar-link");
const slides = document.querySelectorAll(".orderSlide");
const prevBtn = document.querySelector(".prevBtn");
const nextBtn = document.querySelector(".nextBtn");
const productContent = document.querySelector(".productContent");
const addCate = document.querySelector(".addCategory");
const cardPrevBtn = document.querySelector(".cardPrevBtn");
const cardNextBtn = document.querySelector(".cardNextBtn");
const cards = document.querySelectorAll(".salesCard");
const calendarEl = document.getElementById("calendar");
const sellerWallet = document.getElementById("wallet");
const sellerBalanceBtn = document.querySelector("#seller-balanceBtn");
const sellerBalanceV = document.querySelector("#seller-balance-visibility");
const sellerBalance = document.querySelector("#seller-balance");
const notificationToggles = document.querySelectorAll("#notification");
const changeButtons = document.querySelectorAll(".change-btn");
const verifyButtons = document.querySelectorAll(".verify-btn");
const formInputs = document.querySelectorAll(".set-property input");
const profileUpload = document.getElementById("profileUpload");
const forms = document.getElementById("form");

let currentIndex = 0;
let salesCardIndex = 0;

// Core slide functions
export function showSlide(index, slides, isSalesCard = false) {
    const targetIndex = isSalesCard ? salesCardIndex : currentIndex;
    const slideArray = slides;
    
    if (index < 0 || index >= slideArray.length) {
        return;
    }
    
    slideArray[targetIndex].classList.remove("orderActive");
    slideArray[index].classList.add("orderActive");
    
    if (isSalesCard) {
        salesCardIndex = index;
    } else {
        currentIndex = index;
    }
    
    // Update button visibility
    updateButtonVisibility(slideArray, index, isSalesCard);
}

export function prevSlide(slides, isSalesCard = false) {
    const current = isSalesCard ? salesCardIndex : currentIndex;
    if (current > 0) showSlide(current - 1, slides, isSalesCard);
}

export function nextSlide(slides, isSalesCard = false) {
    const current = isSalesCard ? salesCardIndex : currentIndex;
    if (current < slides.length - 1) showSlide(current + 1, slides, isSalesCard);
}

function updateButtonVisibility(slides, index, isSalesCard = false) {
    const prev = isSalesCard ? cardPrevBtn : prevBtn;
    const next = isSalesCard ? cardNextBtn : nextBtn;
    
    if (!prev || !next) return;
    
    prev.style.display = index === 0 ? "none" : "block";
    next.style.display = index === slides.length - 1 ? "none" : "block";
}

// Mobile responsiveness
export function initMobileResponsive() {
    const updateSidebarForMobile = () => {
        const isMobile = window.innerWidth <= 992;
        
        sideBarLink.forEach(link => {
            const span = link.querySelector("span");
            if (span) {
                span.style.display = isMobile ? "none" : "inline";
            }
        });
        
        dashboardMoreInfo.forEach(span => {
            if (!span.classList.contains("exitMoreInfo")) {
                span.style.display = isMobile ? "none" : "inline";
            }
        });
        
        // Adjust analytics layout for mobile
        const cardPhases = document.querySelectorAll(".card-phase");
        if (isMobile) {
            cardPhases.forEach(phase => {
                phase.style.flexDirection = "column";
                phase.style.height = "auto";
            });
        }
    };
    
    window.addEventListener("resize", updateSidebarForMobile);
    updateSidebarForMobile();
}

// Form handling for settings
// export function initFormHandlers() {
//     // Enable buttons when input changes
//     formInputs.forEach(input => {
//         input.addEventListener("input", function() {
//             const parentForm = this.closest("form");
//             if (parentForm) {
//                 const changeBtn = parentForm.querySelector(".change-btn");
//                 const verifyBtn = parentForm.querySelector(".verify-btn");
                
//                 if (changeBtn) changeBtn.style.opacity = "1";
//                 if (verifyBtn) verifyBtn.style.opacity = "1";
//             }
//         });
//     });
    
//     // Handle form submissions
//     changeButtons.forEach(btn => {
//         btn.addEventListener("click", function(e) {
//             e.preventDefault();
//             const form = this.closest("form");
//             if (form && validateForm(form)) {
//                 // Show success icon
//                 const successIcon = form.nextElementSibling?.querySelector(".proUpdate");
//                 if (successIcon) {
//                     successIcon.style.display = "block";
//                     setTimeout(() => {
//                         successIcon.style.display = "none";
//                     }, 3000);
//                 }
//             }
//         });
//     });
    
//     // Verify buttons
//     verifyButtons.forEach(btn => {
//         btn.addEventListener("click", function(e) {
//             e.preventDefault();
//             // Add verification logic here (send OTP, etc.)
//             alert("Verification code sent to your email/phone");
//         });
//     });
    
//     // Notification toggles
//     notificationToggles.forEach(toggle => {
//         toggle.addEventListener("click", function() {
//             const src = this.getAttribute("src");
//             const newSrc = src.includes("off") ? 
//                 "assets/icons/tgl-icon-on.svg" : 
//                 "assets/icons/tgl-icon-off.svg";
//             this.setAttribute("src", newSrc);
//         });
//     });
// }


//////////////////////////////////////////////////////////////////
//////Product Section Add Category
//////////////////////////////////////////////////////////////////

// if(productContent && addCate){
//   addCate.addEventListener("click", ()=>{
//     productContent.innerHTML += `
    
//                                         <!-- Category -->
//                                         <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4 category">

//                                             <!-- Category Name -->
//                                             <div class="d-flex gap-2 align-items-center">
//                                                 <span class="cat-name" style="min-width:fit-content; font-size: 14px;font-weight: 600; color: #004494;">Category Name</span>
//                                             </div>

//                                             <!-- View Category Btn -->
//                                             <button class="sec-btn" style="margin-left:auto; border: 1px solid #004494; border-radius: 20px;">View Category</button>

//                                             <!-- Add Product Btn -->
//                                             <div class="d-flex align-items-center gap-2">
//                                                 <button class="pri-btn" style="border: 1px solid #004494; border-radius: 20px;">Add Product</button>
//                                             </div>
//                                         </div>
//     `
//   })
// }

// Initialize calendar
// export function initCalendar() {
//     if (!calendarEl) return;
    
//     try {
//         const calendar = new FullCalendar.Calendar(calendarEl, {
//             initialView: window.innerWidth <= 768 ? 'listWeek' : 'dayGridMonth',
//             headerToolbar: {
//                 left: 'prev,next today',
//                 center: 'title',
//                 right: window.innerWidth <= 768 ? 'listWeek,dayGridMonth' : 'dayGridMonth,listWeek'
//             },
//             height: 'auto',
//             events: [
//                 {
//                     title: 'Order Deadline',
//                     start: new Date(),
//                     color: '#0056B3'
//                 },
//                 {
//                     title: 'Monthly Report Due',
//                     start: new Date(new Date().setDate(new Date().getDate() + 5)),
//                     color: '#004494'
//                 },
//                 {
//                     title: 'Inventory Check',
//                     start: new Date(new Date().setDate(new Date().getDate() + 10)),
//                     color: '#109E03'
//                 }
//             ],
//             eventClick: function(info) {
//                 alert('Event: ' + info.event.title);
//             }
//         });
        
//         calendar.render();
        
//         // Update calendar on resize
//         window.addEventListener("resize", () => {
//             calendar.setOption('initialView', window.innerWidth <= 768 ? 'listWeek' : 'dayGridMonth');
//         });
//     } catch (error) {
//         console.error("FullCalendar not loaded:", error);
//     }
// }

// Form validation helper
// function validateForm(form) {
//     const inputs = form.querySelectorAll("input[required]");
//     let isValid = true;
    
//     inputs.forEach(input => {
//         if (!input.value.trim()) {
//             isValid = false;
//             input.style.borderColor = "red";
//             setTimeout(() => {
//                 input.style.borderColor = "#0056B3";
//             }, 2000);
//         }
        
//         // Special validations
//         if (input.type === "email" && input.value) {
//             const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//             if (!emailRegex.test(input.value)) {
//                 isValid = false;
//                 alert("Please enter a valid email address");
//             }
//         }
        
//         if (input.id === "newPassword" || input.id === "reEnteredPassword") {
//             if (input.value.length < 6) {
//                 isValid = false;
//                 alert("Password must be at least 6 characters");
//             }
//         }
        
//         if (input.id === "reEnteredPassword" && form.querySelector("#newPassword")) {
//             const newPass = form.querySelector("#newPassword").value;
//             if (input.value !== newPass) {
//                 isValid = false;
//                 alert("Passwords do not match");
//             }
//         }
//     });
    
//     return isValid;
// }

// Initialize everything
export function initSellerDashboard() {
    initMobileResponsive();
    // initFormHandlers();
    // initCategoryHandlers();
    // initCalendar();
    
    // Set initial button states
    updateButtonVisibility(slides, currentIndex);
    updateButtonVisibility(cards, salesCardIndex, true);
}

export { 
    dashBoardBtn,
    dashboardMoreInfo, 
    exitMoreInfo, 
    sideBarLink,
    slides,
    prevBtn,
    nextBtn,
    productContent,
    addCate,
    cardNextBtn,
    cardPrevBtn,
    cards,
    calendarEl,
    sellerWallet,
    sellerBalance,
    sellerBalanceBtn,
    sellerBalanceV,
    forms
}