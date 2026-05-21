/////////////////////////////////////////////////////////////////////////////////////////////////////////
// IMPORTS
/////////////////////////////////////////////////////////////////////////////////////////////////////////

import { 
  navlinks, 
  sections, 
  viewMap, 
  main, 
  drop, 
  balanceV, 
  balance, 
  hToggle, 
  tglBtn, 
  note, 
  balanceBtn, 
  cartSidebar, 
  sellerSidebar, 
  collapseCart, 
  collapseSeller,
  // market,
  // marketSidebars,
} from "./buyer.js";

import { 
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
  initSellerDashboard,
  prevSlide,
  nextSlide,
  showSlide,
  forms
} from "./seller.js";

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// GLOBAL VARIABLES
/////////////////////////////////////////////////////////////////////////////////////////////////////////

let mapInitialized = false;
let activeSection = null;

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// SECTION MANAGEMENT
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function activateSection(targetId) {
  console.log(`Activating section: ${targetId}`);
  
  sections?.forEach(s => s.classList.remove("active"));
  navlinks?.forEach(l => l.classList.remove("active"));
  sideBarLink?.forEach(l => l.classList.remove("sActive"));

  const targetSection = document.getElementById(targetId);
  if (targetSection) {
    targetSection.classList.add("active");
    sessionStorage.setItem("activeSection", targetId);
    activeSection = targetId;
    
    if (window.innerWidth <= 768) {
      targetSection.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  }

  const headerNav = Array.from(navlinks || []).find(
    l => l.getAttribute("href").substring(1) === targetId
  );

  if (headerNav) {
    headerNav.classList.add("active");
  }

  const sideBar = Array.from(sideBarLink || []).find(
    l => l.getAttribute("href").substring(1) === targetId
  );
  if (sideBar) {
    sideBar.classList.add("sActive");
  }

  viewMap?.forEach(v => {
    v.style.opacity = targetId === "market" ? "0" : "1";
  });

  if (targetId === "market" && !mapInitialized) {
    initMarketMap();
    mapInitialized = true;
  }
  
  const sellerSections = [
    "order", "store", "analytics", "messages", 
    "wallet", "settings", "review", 
    "notifications", "support"
  ];
  
  if (sellerSections.includes(targetId)) {
    setTimeout(() => {
      if (typeof initSellerDashboard === 'function') {
        initSellerDashboard();
      }
    }, 100);
  }
  
  if (targetId === "product") {
    setTimeout(() => {
      initializeProductForm();
    }, 300);
  }
}

function attachSectionListeners() {
  const secListner = document.querySelectorAll("a[href^='#']");

  if(!secListner) return;

  secListner.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      const href = link.getAttribute("href");
      const targetId = href.substring(1);
      activateSection(targetId);
      link.add("active")
    });
  });
}

function restoreActiveSection() {
  const savedSection = sessionStorage.getItem("activeSection");
  const defaultSection = document.querySelector(".section.active");
  
  if (savedSection && document.getElementById(savedSection)) {
    activateSection(savedSection);
  } else if (defaultSection) {
    activateSection(defaultSection.id);
  } else {
    const firstSection = document.querySelector(".section");
    if (firstSection) {
      activateSection(firstSection.id);
    }
  }
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////
// MARKET MAP
/////////////////////////////////////////////////////////////////////////////////////////////////////////

// function initMarketMap() {
//   console.log("Initializing market map...");
  
//   const mapElement = document.getElementById("markeAreaMap");
//   if (!mapElement || typeof L === 'undefined') {
//     console.warn("Leaflet not loaded or map element not found");
//     return;
//   }

//   try {
//     // Create map with a default view (will be adjusted later)
//     const map = L.map("markeAreaMap").setView([9.0820, 8.6753], 6); // Nigeria center

//     // Base tile layer
//     L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
//       maxZoom: 19,
//       attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
//     }).addTo(map);

//     // Custom icon for sellers (using Leaflet's default icon but you can use custom images)
//     const sellerIcon = L.icon({
//       iconUrl: '/assets/icons/store-marker.svg', // create a custom SVG or use a library
//       iconSize: [32, 32],
//       iconAnchor: [16, 32],
//       popupAnchor: [0, -32]
//     });

//     // Add seller markers
//     let sellerMarkers = [];
//     if (window.sellersData && sellersData.length > 0) {
//       sellersData.forEach(seller => {
//         if (seller.latitude && seller.longitude) {
//           const marker = L.marker([seller.latitude, seller.longitude], { icon: sellerIcon })
//             .addTo(map)
//             .bindPopup(`
//               <strong>${seller.store_name}</strong><br>
//               <a href="/store/${seller.store_id}" data-href="/store/${seller.store_id}" class="store-link">View Store</a>
//             `);
          
//           // Optional: Add click event to navigate (if you prefer not to use popup link)
//           marker.on('click', () => {
//             window.location.href = `/store/${seller.store_id}`;
//           });

//           sellerMarkers.push(marker);
//         }
//       });
//     }

//     // Handle user geolocation
//     if (navigator.geolocation) {
//       navigator.geolocation.getCurrentPosition(
//         (pos) => {
//           const userLatLng = [pos.coords.latitude, pos.coords.longitude];
          
//           // Add user marker with accuracy circle
//           L.marker(userLatLng, {
//             icon: L.icon({
//               iconUrl: '/assets/icons/user-marker.svg',
//               iconSize: [24, 24]
//             })
//           }).addTo(map)
//             .bindPopup("You are here")
//             .openPopup();
          
//           L.circle(userLatLng, { radius: pos.coords.accuracy, color: 'blue', fillOpacity: 0.1 }).addTo(map);

//           // If there are sellers, fit bounds to include user and all sellers
//           if (sellerMarkers.length > 0) {
//             const group = new L.featureGroup([...sellerMarkers, L.marker(userLatLng)]);
//             map.fitBounds(group.getBounds(), { padding: [50, 50] });
//           } else {
//             // Just zoom to user location
//             map.setView(userLatLng, 14);
//           }
//         },
//         (err) => {
//           console.log("Geolocation error, using default view with sellers");
//           // If no geolocation, fit bounds to all sellers (if any)
//           if (sellerMarkers.length > 0) {
//             const group = new L.featureGroup(sellerMarkers);
//             map.fitBounds(group.getBounds(), { padding: [50, 50] });
//           } else {
//             map.setView([9.0820, 8.6753], 6); // fallback
//           }
//         },
//         { timeout: 10000, enableHighAccuracy: true }
//       );
//     } else {
//       // No geolocation support, fit to sellers if any
//       if (sellerMarkers.length > 0) {
//         const group = new L.featureGroup(sellerMarkers);
//         map.fitBounds(group.getBounds(), { padding: [50, 50] });
//       }
//     }

//     // Fix map rendering issues (especially in hidden containers)
//     setTimeout(() => map.invalidateSize(), 200);

//   } catch (error) {
//     console.error("Map initialization failed:", error);
//     mapElement.innerHTML = '<div class="text-center p-4">Map could not be loaded. Please check your connection.</div>';
//   }
// }


// function initMarketMap() {
//   console.log("initMarketMap called");

//   const mapElement = document.getElementById("marketMap");
//   if (!mapElement) {
//     console.error("❌ No element with id 'marketMap'");
//     return;
//   }

//   // Log container dimensions
//   const rect = mapElement.getBoundingClientRect();
//   console.log("Map container dimensions:", rect.width, "x", rect.height);

//   if (rect.width === 0 || rect.height === 0) {
//     console.warn("⚠️ Map container has zero size – check CSS");
//   }

//   if (typeof L === 'undefined') {
//     console.error("❌ Leaflet not loaded");
//     mapElement.innerHTML = "Leaflet library missing.";
//     return;
//   }

//   // Prevent double init
//   if (mapElement._leaflet_id) {
//     console.log("Map already initialized, destroying old instance first...");
//     mapElement._leaflet_id = null; // hack to allow re-init (not perfect, but for debug)
//     // Better: remove all children and re-create?
//   }

//   try {
//     console.log("Creating map...");
//     const map = L.map(mapElement).setView([9.0820, 8.6753], 6);

//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//       attribution: '© OpenStreetMap'
//     }).addTo(map);

//     // Add a test marker to see if anything appears
//     L.marker([9.0820, 8.6753])
//       .addTo(map)
//       .bindPopup('Test marker – Nigeria')
//       .openPopup();

//     // Now try to add seller markers if data exists
//     if (window.sellersData && sellersData.length > 0) {
//       console.log(`Adding ${sellersData.length} seller markers`);
//       sellersData.forEach((seller, idx) => {
//         if (seller.latitude && seller.longitude) {
//           L.marker([seller.latitude, seller.longitude])
//             .addTo(map)
//             .bindPopup(seller.store_name);
//         } else {
//           console.warn(`Seller ${idx} missing coordinates`, seller);
//         }
//       });
//     } else {
//       console.log("No sellersData available");
//     }

//     // Force a resize after a short delay
//     setTimeout(() => {
//       map.invalidateSize();
//       console.log("Map invalidateSize called");
//     }, 500);

//     console.log("✅ Map initialization complete");
//   } catch (error) {
//     console.error("❌ Map initialization error:", error);
//     mapElement.innerHTML = "Map error: " + error.message;
//   }
// }


// function initMarketMap() {
//   console.log("Initializing market map...");
  
//   const mapElement = document.getElementById("marketMap");
//   if (!mapElement) {
//     console.warn("Map element not found");
//     return;
//   }

//   // Prevent double initialization
//   if (mapElement._leaflet_id) {
//     console.log("Map already initialized, skipping.");
//     return;
//   }

//   if (typeof L === 'undefined') {
//     console.error("Leaflet not loaded");
//     mapElement.innerHTML = "Map library could not be loaded.";
//     return;
//   }

//   try {
//     // Create map with a default view (will be adjusted later)
//     const map = L.map("marketMap").setView([9.0820, 8.6753], 6);

//     // Base tile layer
//     L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
//       maxZoom: 19,
//       attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
//     }).addTo(map);

//     // Add seller markers (if any)
//     const sellerMarkers = [];
//     if (window.sellersData && window.sellersData.length > 0) {
//       // Optional custom icon (you can replace with your own)
//       const sellerIcon = L.icon({
//         iconUrl: '/assets/icons/store-marker.svg',
//         iconSize: [32, 32],
//         iconAnchor: [16, 32],
//         popupAnchor: [0, -32]
//       });

//       window.sellersData.forEach(seller => {
//         const lat = parseFloat(seller.latitude);
//         const lng = parseFloat(seller.longitude);
//         if (!isNaN(lat) && !isNaN(lng)) {
//           const marker = L.marker([lat, lng], { icon: sellerIcon })
//             .addTo(map)
//             .bindPopup(`<b>${seller.store_name}</b><br><a href="/store/${seller.store_id}">View Store</a>`);
          
//           // Optional: click to navigate
//           marker.on('click', () => {
//             window.location.href = `/store/${seller.store_id}`;
//           });
          
//           sellerMarkers.push(marker);
//         }
//       });
//     }

//     // Try to get user's location
//     if (navigator.geolocation) {
//       navigator.geolocation.getCurrentPosition(
//         (position) => {
//           console.log("Geolocation success:", position.coords);
//           const userLatLng = [position.coords.latitude, position.coords.longitude];
          
//           // Add user marker with a simple icon
//           const userMarker = L.marker(userLatLng, {
//             icon: L.icon({
//               iconUrl: '/assets/icons/user-marker.svg',
//               iconSize: [24, 24]
//             })
//           }).addTo(map).bindPopup("You are here").openPopup();

//           // Add accuracy circle
//           L.circle(userLatLng, {
//             radius: position.coords.accuracy,
//             color: 'blue',
//             fillOpacity: 0.1
//           }).addTo(map);

//           // Combine all markers (user + sellers) to fit bounds
//           const allMarkers = [userMarker, ...sellerMarkers];
//           if (allMarkers.length > 0) {
//             const group = L.featureGroup(allMarkers);
//             map.fitBounds(group.getBounds(), { padding: [50, 50] });
//           } else {
//             // No sellers, just zoom to user
//             map.setView(userLatLng, 14);
//           }
//         },
//         (error) => {
//           console.warn("Geolocation error:", error.message);
//           // If geolocation fails, fit to seller markers only
//           if (sellerMarkers.length > 0) {
//             const group = L.featureGroup(sellerMarkers);
//             map.fitBounds(group.getBounds(), { padding: [50, 50] });
//           } else {
//             // No sellers and no location, keep default view
//             map.setView([9.0820, 8.6753], 6);
//           }
//         },
//         { timeout: 10000, enableHighAccuracy: true }
//       );
//     } else {
//       console.log("Geolocation not supported by browser");
//       if (sellerMarkers.length > 0) {
//         const group = L.featureGroup(sellerMarkers);
//         map.fitBounds(group.getBounds(), { padding: [50, 50] });
//       }
//     }

//     // Fix map rendering issues (especially in hidden containers)
//     setTimeout(() => map.invalidateSize(), 200);
//     console.log("Map initialized successfully");

//   } catch (error) {
//     console.error("Map initialization failed:", error);
//     mapElement.innerHTML = '<div class="text-center p-4">Map could not be loaded. Please check your connection.</div>';
//   }
// }


function initMarketMap() {
  console.log("Initializing market map...");
  
  const mapElement = document.getElementById("marketAreaMap");
  if (!mapElement) {
    console.warn("Map element not found");
    return;
  }

  // Prevent double init
  if (mapElement._leaflet_id) {
    console.log("Map already initialized, skipping.");
    return;
  }

  if (typeof L === 'undefined') {
    console.error("Leaflet not loaded");
    mapElement.innerHTML = "Map library could not be loaded.";
    return;
  }

  try {
    // Create map with a default view (Nigeria)
    const map = L.map("marketAreaMap").setView([9.0820, 8.6753], 6);

    // Base tile layer
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Add seller markers with custom icon
    if (window.sellersData && window.sellersData.length > 0) {
        window.sellersData.forEach(seller => {
            const lat = parseFloat(seller.latitude);
            const lng = parseFloat(seller.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                const imgSrc = seller.profile_picture
                    ? `../assets/uploads/profilePicture/${seller.profile_picture}`
                    : '../assets/uploads/profilePicture/default.png';

                // Create a custom marker with store name above the round button
                const sellerIcon = L.divIcon({
                    html: `
                        <div style="
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            width: 80px;
                            height: 50px;
                        ">
                            <span style="
                                background: white;
                                border-radius: 15px;
                                border: 2px solid #004494;
                                padding: 2px 8px;
                                font-size: 10px;
                                font-weight: bold;
                                color: #004494;
                                white-space: nowrap;
                                max-width: 70px;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                            " title="${seller.store_name}">${seller.store_name}</span>
                            <div style="
                                width: 30px;
                                height: 30px;
                                border-radius: 50%;
                                border: 2px solid #004494;
                                overflow: hidden;
                                margin-top: 2px;
                                background: white;
                                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                            ">
                                <img src="${imgSrc}" 
                                    style="width: 100%; height: 100%; object-fit: cover;" 
                                    alt="${seller.store_name}"
                                    onerror="this.src='/assets/icons/default-avatar.svg'"
                                />
                            </div>
                        </div>
                    `,
                    className: 'seller-marker',
                    iconSize: [80, 50],      // width, height of the whole marker
                    iconAnchor: [40, 50],     // point of the marker (bottom center)
                    popupAnchor: [0, -50]     // popup appears above the marker
                });

                L.marker([lat, lng], { icon: sellerIcon })
                    .addTo(map)
                    .bindPopup(`<b>${seller.store_name}</b><br><a href="/store/${seller.store_id}">View Store</a>`);
            }
        });
    }

    // --- Create a "Focus on me" button ---
    const focusButton = L.control({ position: 'topleft' });
    focusButton.onAdd = function(map) {
      const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
      div.innerHTML = `
        <button style="background: white; border: none; padding: 5px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Focus on me">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-crosshair" viewBox="0 0 16 16">
            <path d="M8.5.5a.5.5 0 0 0-1 0v.518A7 7 0 0 0 1.018 7.5H.5a.5.5 0 0 0 0 1h.518A7 7 0 0 0 7.5 14.982v.518a.5.5 0 0 0 1 0v-.518A7 7 0 0 0 14.982 8.5h.518a.5.5 0 0 0 0-1h-.518A7 7 0 0 0 8.5 1.018zm-6.48 7A6 6 0 0 1 7.5 2.02v.48a.5.5 0 0 0 1 0v-.48a6 6 0 0 1 5.48 5.48h-.48a.5.5 0 0 0 0 1h.48a6 6 0 0 1-5.48 5.48v-.48a.5.5 0 0 0-1 0v.48A6 6 0 0 1 2.02 8.5h.48a.5.5 0 0 0 0-1zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
          </svg>
        </button>
      `;
      let userMarker = null;
      div.onclick = function() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const lat = position.coords.latitude;
              const lng = position.coords.longitude;
              map.setView([lat, lng], 14); // zoom level 14 for street level
              
              // Optionally add a temporary marker
              userMarker = L.marker([lat, lng], {
                icon: L.icon({
                  iconUrl: '../assets/icons/buyer.svg',
                  iconSize: [24, 24]
                })
              }).addTo(map).bindPopup("You are here").openPopup();
            },
            (error) => {
              alert("Unable to get your location: " + error.message);
            }
          );
        } else {
          alert("Geolocation not supported by your browser.");
        }
      };
      return div;
    };
    focusButton.addTo(map);

    // Fix map rendering after a short delay
    setTimeout(() => map.invalidateSize(), 200);
    console.log("Map initialized successfully");

  } catch (error) {
    console.error("Map initialization failed:", error);
    mapElement.innerHTML = '<div class="text-center p-4">Map could not be loaded. Please check your connection.</div>';
  }
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////
// PRODUCT FORM HANDLING - INTERACTIONS ONLY
/////////////////////////////////////////////////////////////////////////////////////////////////////////


function initializeProductForms() {
  console.log("Initializing product form interactions...");

  document.querySelectorAll('.product-form').forEach(form => {

    // --- 1. Toggle variants section ---
    const variantToggle = form.querySelector('.has-variants-toggle');
    const variantSection = form.querySelector('.variants-section');
    if (variantToggle && variantSection) {
      variantSection.classList.toggle('d-none', !variantToggle.checked);
      variantToggle.addEventListener('change', function() {
        variantSection.classList.toggle('d-none', !this.checked);
      });
    }

    // --- 2. Character counter for main description ---
    const descField = form.querySelector('.product-description');
    const charCount = form.querySelector('.description-char-count');
    if (descField && charCount) {
      const updateCount = () => charCount.textContent = descField.value.length;
      descField.addEventListener('input', updateCount);
      updateCount();
    }

    // --- 3. Character counter for SHORT description (fixed variable) ---
    const shortDescField = form.querySelector('.short-product-description');
    const shortCharCount = form.querySelector('.short-description-char-count');
    if (shortDescField && shortCharCount) {               // ← fixed: use shortCharCount
      const updateCount = () => shortCharCount.textContent = shortDescField.value.length;
      shortDescField.addEventListener('input', updateCount);
      updateCount();
    }

    // --- 4. Add new variant row ---
    const addBtn = form.querySelector('.add-variant-btn');
    const variantsContainer = form.querySelector('.variants-container');
    if (addBtn && variantsContainer) {
      addBtn.addEventListener('click', () => addVariantRow(variantsContainer));
    }

    // --- 5. Remove variant row (delegation) ---
    form.addEventListener('click', (e) => {
      if (e.target.closest('.remove-variant')) {
        const row = e.target.closest('.variant-row');
        if (row) row.remove();
      }
    });

    // --- 6. SKU auto-suggestion ---
    const nameInput = form.querySelector('.product-name');
    const skuInput = form.querySelector('.product-sku');
    if (nameInput && skuInput) {
      nameInput.addEventListener('blur', () => {
        if (!skuInput.value && nameInput.value) {
          const sku = nameInput.value
            .toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-')
            .substring(0, 20);
          skuInput.value = `PROD-${sku}`;
        }
      });
    }


    // --- 7. Initialize Image uploads ---
    function initImageUpload(form) {
      const uploadArea = form.querySelector('.product-images-upload-area');
      const input = form.querySelector('.product-images-input');
      const chooseBtn = form.querySelector('.product-images-choose-btn');
      const previewContainer = form.querySelector('.product-images-preview');
      const fileCountSpan = form.querySelector('.product-images-file-count');
      const existingContainer = form.querySelector('.existing-images');

      if (!uploadArea || !input || !previewContainer || !fileCountSpan) return;

      let dt = new DataTransfer(); // holds only newly selected files

      // Count existing thumbnails currently in the DOM
      function getExistingCount() {
        return existingContainer ? existingContainer.querySelectorAll('.thumbnail').length : 0;
      }

      // Update total file count display
      function updateTotalCount() {
        fileCountSpan.textContent = getExistingCount() + dt.files.length;
      }

      // Render only new previews (from dt)
      function renderNewPreviews() {
        // Clear previously added new previews
        previewContainer.innerHTML = '';
        const existingCount = getExistingCount();
        const hasExisting = existingCount > 0;

        for (let i = 0; i < dt.files.length; i++) {
          const file = dt.files[i];
          const reader = new FileReader();
          reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'col-md-2 mb-3 new-image-preview';
            div.setAttribute('data-index', i);

            // "Main" badge only if no existing images and this is the first new image
            const isMain = !hasExisting && i === 0;

            div.innerHTML = `
              <div class="position-relative border rounded p-1 ${isMain ? 'border-primary shadow-sm' : ''}">
                ${isMain ? '<span class="badge bg-primary position-absolute top-0 start-0 m-1">Main</span>' : ''}
                <img src="${e.target.result}" class="img-thumbnail" style="height:100px; width:100%; object-fit:cover;">
                <div class="position-absolute top-0 end-0 m-1">
                  <button type="button" class="btn btn-sm btn-danger remove-image" data-index="${i}">
                    <i class="bi bi-x"></i>
                  </button>
                </div>
              </div>
            `;
            previewContainer.appendChild(div);
          };
          reader.readAsDataURL(file);
        }
        updateTotalCount();
      }

      // ---- Choose button ----
      if (chooseBtn) {
        chooseBtn.addEventListener('click', () => input.click());
      }

      // ---- File selection ----
      input.addEventListener('change', function() {
        const totalExisting = getExistingCount();
        for (let file of this.files) {
          if (dt.items.length + totalExisting >= 12) {
            alert('Maximum 12 images total allowed');
            break;
          }
          if (file.type.startsWith('image/')) {
            dt.items.add(file);
          }
        }
        this.files = dt.files;
        renderNewPreviews();
      });

      // ---- Drag & drop ----
      ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
        uploadArea.addEventListener(event, (e) => e.preventDefault());
      });
      uploadArea.addEventListener('drop', (e) => {
        input.files = e.dataTransfer.files;
        input.dispatchEvent(new Event('change'));
      });

      // ---- Remove new image (preview) ----
      previewContainer.addEventListener('click', (e) => {
        const removeBtn = e.target.closest('.remove-image');
        if (!removeBtn) return;
        const index = parseInt(removeBtn.dataset.index);
        const newDt = new DataTransfer();
        for (let i = 0; i < dt.files.length; i++) {
          if (i !== index) newDt.items.add(dt.files[i]);
        }
        dt = newDt;
        input.files = dt.files;
        renderNewPreviews();
      });

      // ---- Remove existing image (if container exists) ----
      if (existingContainer) {
        existingContainer.addEventListener('click', (e) => {
          const removeBtn = e.target.closest('.remove-image');
          if (!removeBtn) return;

          const thumbnail = removeBtn.closest('.thumbnail');
          if (!thumbnail) return;

          // Remove the associated hidden input (next sibling)
          const hiddenInput = thumbnail.nextElementSibling;
          if (hiddenInput && hiddenInput.matches('input[name="existing_images[]"]')) {
            hiddenInput.remove();
          }

          // Remove the thumbnail itself
          thumbnail.remove();

          // Re‑render new previews (updates "Main" badge and total count)
          renderNewPreviews();
        });
      }

      // ---- Initial count ----
      updateTotalCount();
    }
    initImageUpload(form)


    // --- 8. Existing VImage Removal ---
    function handleExistingImageRemoval(form) {
      const container = form.querySelector('.existing-images');
      if (!container) return;

      container.addEventListener('click', (e) => {
        const removeBtn = e.target.closest('.remove-image');
        if (!removeBtn) return;

        const thumbnail = removeBtn.closest('.thumbnail');
        if (!thumbnail) return;

        // Find hidden input INSIDE this thumbnail
        const hiddenInput = thumbnail.querySelector('input[name="existing_images[]"]');
        if (hiddenInput) {
          const imageId = hiddenInput.value;
          hiddenInput.remove();

          // Add hidden input to mark for deletion on server
          const deleteInput = document.createElement('input');
          deleteInput.type = 'hidden';
          deleteInput.name = 'delete_images[]';
          deleteInput.value = imageId;
          form.appendChild(deleteInput);
        }

        thumbnail.remove();
      });
    }
    handleExistingImageRemoval(form)


    // --- 9. Existing Variants Removal ---
    function handleVariantRemoval(form) {
      form.addEventListener('click', (e) => {
        const removeBtn = e.target.closest('.remove-variant');
        if (!removeBtn) return;

        const row = removeBtn.closest('.existing-variant');
        if (!row) return;

        // Find the hidden input INSIDE this row (if it's an existing variant)
        const hiddenInput = row.querySelector('input[name="existing_variant_id"]');
        if (hiddenInput) {
          const variantId = hiddenInput.value;
          hiddenInput.remove(); // remove the hidden ID input

          // Add a hidden input to mark this variant for deletion on the server
          const deleteInput = document.createElement('input');
          deleteInput.type = 'hidden';
          deleteInput.name = 'delete_variants[]';
          deleteInput.value = variantId;
          form.appendChild(deleteInput);
        }

        // Remove the row (works for both existing and new variants)
        row.remove();
      });
    }
    handleVariantRemoval(form)


  });
  console.log("All product forms initialized");
}

///////////// Helper: add a new variant row inside a given container
function addVariantRow(container) {
  
  const rowCount = container.querySelectorAll('.variant-row').length;
  const newIndex = rowCount; // for SKU suggestion

  const row = document.createElement('div');
  row.className = 'variant-row mb-3 p-3 border rounded';
  row.innerHTML = `
          <div class="row g-3">
                <div class="col-md-3">
                    <label class="store-form-label">Variant Name</label>
                    <input type="text" 
                        class="form-control" 
                        name="variant_name[]"
                        placeholder="e.g., Small, Red"
                        required>
                </div>
                <div class="col-md-2">
                    <label class="store-form-label">Variant SKU</label>
                    <input type="text" 
                        class="form-control" 
                        name="variant_sku[]"
                        placeholder="SKU-${"00" + newIndex + 1}"
                        required>
                </div>
                <div class="col-md-2">
                    <label class="store-form-label">Price Adjustment</label>
                    <input type="number" 
                        class="form-control" 
                        name="price_adjustment[]"
                        placeholder="+10.00"
                        step="0.01"
                        value="0.00">
                    <small class="text-white">Adds to base price</small>
                </div>
                <div class="col-md-2">
                    <label class="store-form-label">Stock</label>
                    <input type="number" 
                        class="form-control" 
                        name="variant_stock[]"
                        placeholder="0"
                        min="0"
                        value="0">
                </div>
                <div class="col-md-3">
                    <label class="store-form-label">Variant Image</label>
                    <input type="file" 
                        class="form-control" 
                        name="variant_image[]"
                        accept=".jpg,.jpeg,.png,.webp">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                  <button type="button" class="btn btn-danger remove-variant">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
          </div>
  `;
  container.appendChild(row);
}

/////// Add Digital Product Section
function addVariantSection() {
  console.log('Adding Variant Section Running...');
  
  document.querySelectorAll('.isDigitalToggle').forEach(checkbox => {
    // Find the closest wrapper that contains both the toggle and its section
    const wrapper = checkbox.closest('.digital-product-wrapper');
    if (!wrapper) return;

    const section = wrapper.querySelector('.digitalProductSection');
    if (!section) return;

    // Set initial visibility
    section.classList.toggle('d-none', !checkbox.checked);

    // Listen for changes
    checkbox.addEventListener('change', function() {
      section.classList.toggle('d-none', !this.checked);
    });
  });
}

function addDigitalProductSection() {
  console.log('Adding Digital Product Section Running...');
  
  document.querySelectorAll('.isDigitalToggle').forEach(checkbox => {
    // Find the closest wrapper that contains both the toggle and its section
    const wrapper = checkbox.closest('.digital-product-wrapper');
    if (!wrapper) return;

    const section = wrapper.querySelector('.digitalProductSection');
    if (!section) return;

    // Set initial visibility
    section.classList.toggle('d-none', !checkbox.checked);

    // Listen for changes
    checkbox.addEventListener('change', function() {
      section.classList.toggle('d-none', !this.checked);
    });
  });
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////
// BUYER INTERACTIONS
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function initBuyerInteractions() {
  console.log("Initializing buyer interactions...");
  
  drop?.forEach(d => {
    d.addEventListener("click", () => {
      d.classList.toggle("toggle-drop");
    });
  });

  if (balanceBtn && balance && balanceV) {
    balanceBtn.addEventListener("click", () => {
      if (balanceV.getAttribute("src")?.includes("eye-slash-fill")) {
        balance.textContent = "********";
        balanceV.setAttribute("src", "../assets/icons/outlined.svg");
      } else {
        balance.textContent = window.TRADIA?.balance ?? "0.00";
        balanceV.setAttribute("src", "../assets/icons/eye-slash-fill.svg");
      }
    });
  }

  hToggle?.forEach(btn => {
    btn.addEventListener("click", () => {
      btn.classList.toggle("toggle-drop");
      const container = btn.closest(".history-container");
      if (!container) return;

      const initial = container.querySelector(".initial");
      const moreDetail = container.querySelector(".more-detail");

      if (initial && moreDetail) {
        if (initial.style.display !== "none") {
          initial.style.display = "none";
          moreDetail.style.display = "flex";
        } else {
          moreDetail.style.display = "none";
          initial.style.display = "flex";
        }
      }
    });
  });

  note?.forEach(n => {
    n.addEventListener("click", () => {
      if (n.getAttribute("src")?.includes("off")) {
        n.setAttribute("src", "../assets/icons/tgl-icon-on.svg");
      } else {
        n.setAttribute("src", "../assets/icons/tgl-icon-off.svg");
      }
    });
  });

  if (cartSidebar && sellerSidebar && collapseCart && collapseSeller) {
    collapseCart.addEventListener("click", () => {
      if (window.innerWidth <= 768 && cartSidebar.classList.contains("collapsed")) {
        cartSidebar.classList.remove("collapsed");
        sellerSidebar.classList.add("collapsed");
      } else {
        cartSidebar.classList.toggle("collapsed");
      }
    });

    collapseSeller.addEventListener("click", () => {
      if (window.innerWidth <= 768 && sellerSidebar.classList.contains("collapsed")) {
        sellerSidebar.classList.remove("collapsed");
        cartSidebar.classList.add("collapsed");
      } else {
        sellerSidebar.classList.toggle("collapsed");
      }
    });

    // if (market && marketSidebars) {
    //   market.addEventListener("click", () => {
    //     marketSidebars.forEach(s => {
    //       s.classList.add("collapsed");
    //     });
    //   });
    // }
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// SELLER INTERACTIONS
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function initSellerInteractions() {
  console.log("Initializing seller interactions...");
  
  if (dashBoardBtn && dashboardMoreInfo && exitMoreInfo) {
    dashBoardBtn.addEventListener("click", () => {
      dashboardMoreInfo.forEach(s => {
        if (window.innerWidth > 768) {
          s.style.display = "block";
        }
      });
    });

    exitMoreInfo.addEventListener("click", () => {
      dashboardMoreInfo.forEach(s => {
        s.style.display = "none";
      });
    });
  }

  if (prevBtn && nextBtn && slides) {
    prevBtn.addEventListener("click", () => prevSlide(slides));
    nextBtn.addEventListener("click", () => nextSlide(slides));
  }

  if (cardNextBtn && cardPrevBtn && cards) {
    cardPrevBtn.addEventListener("click", () => prevSlide(cards, true));
    cardNextBtn.addEventListener("click", () => nextSlide(cards, true));
  }

  if (sellerBalanceBtn && sellerBalanceV && sellerBalance) {
    sellerBalanceBtn.addEventListener("click", () => {
      if (sellerBalanceV.getAttribute("src")?.includes("eye-slash-fill")) {
        sellerBalance.textContent = "********";
        sellerBalanceV.setAttribute("src", "../assets/icons/outlined.svg");
      } else {
        sellerBalance.textContent = window.TRADIA?.balance ?? "0.00";
        sellerBalanceV.setAttribute("src", "../assets/icons/eye-slash-fill.svg");
      }
    });
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// FORM HANDLING
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function initializeSellerSignupForms() {
  console.log("Initializing seller signup forms...");
  
  if (window.innerWidth <= 768) {
    const firstInput = document.querySelector('.signup-form input[type="text"]');
    if (firstInput) {
      setTimeout(() => firstInput.focus(), 300);
    }
  }
  
  const formInputs = document.querySelectorAll('.signup-form input, .signup-form select');
  formInputs.forEach(input => {
    if (window.innerWidth <= 768) {
      input.style.fontSize = '16px';
    }
    
    input.addEventListener('focus', function() {
      if (window.innerWidth <= 768) {
        this.style.fontSize = '16px';
      }
    });
  });
  
  const phoneInput = document.querySelector('input[name="phone"]');
  if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      
      if (value.length > 0) {
        if (value.length <= 3) {
          value = value;
        } else if (value.length <= 6) {
          value = value.replace(/(\d{3})(\d+)/, '$1 $2');
        } else if (value.length <= 10) {
          value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1 $2 $3');
        } else {
          value = value.substring(0, 10).replace(/(\d{3})(\d{3})(\d+)/, '$1 $2 $3');
        }
      }
      
      e.target.value = value;
    });
  }
  
  const dobInput = document.querySelector('input[name="dob"]');
  if (dobInput) {
    const today = new Date();
    const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());
    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    
    dobInput.min = minDate.toISOString().split('T')[0];
    dobInput.max = maxDate.toISOString().split('T')[0];
    
    if (!dobInput.value) {
      dobInput.value = maxDate.toISOString().split('T')[0];
    }
  }
  
  const signupForms = document.querySelectorAll('.signup-form');
  signupForms.forEach(form => {
    form.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
          submitBtn.innerHTML = originalText;
          submitBtn.disabled = false;
        }, 5000);
      }
    });
  });
}

function initializeLoginPage() {
  console.log("Initializing login page...");
  
  const togglePassword = document.getElementById('togglePassword');
  const passwordField = document.getElementById('passwordField');
  
  if (togglePassword && passwordField) {
    togglePassword.addEventListener('click', function() {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      
      const icon = this.querySelector('i');
      if (type === 'password') {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });
  }
  
  const loginInput = document.getElementById('loginInput');
  if (loginInput) {
    setTimeout(() => loginInput.focus(), 300);
  }
  
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', function() {
      const submitBtn = document.getElementById('loginSubmit');
      if (submitBtn && !submitBtn.disabled) {
        const originalHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Logging in...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
          submitBtn.innerHTML = originalHTML;
          submitBtn.disabled = false;
        }, 5000);
      }
    });
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// SUCCESS PAGE
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function initializeSuccessPage() {
  console.log('Initializing success page...');
  
  const userType = document.body.dataset.userType || 'user';
  
  setTimeout(() => {
    createConfetti(userType);
  }, 500);
  
  const successButtons = document.querySelectorAll('.btn-success-page, .btn-outline-primary');
  successButtons.forEach(button => {
    button.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-3px)';
    });
    
    button.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
    
    if (button.classList.contains('btn-success-page') || button.href.includes('login')) {
      button.addEventListener('click', function(e) {
        createRippleEffect(e, this);
        
        const originalHTML = this.innerHTML;
        const icon = this.querySelector('i') ? this.querySelector('i').className : 'fas fa-spinner fa-spin';
        this.innerHTML = `<i class="${icon} me-2"></i>Redirecting...`;
        this.disabled = true;
        
        const originalClasses = this.className;
        
        setTimeout(() => {
          this.innerHTML = originalHTML;
          this.disabled = false;
          this.className = originalClasses;
        }, 1500);
      });
    }
  });
  
  const listItems = document.querySelectorAll('.next-steps li');
  listItems.forEach((item, index) => {
    item.style.opacity = '0';
    item.style.transform = 'translateX(-20px)';
    
    setTimeout(() => {
      item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      item.style.opacity = '1';
      item.style.transform = 'translateX(0)';
    }, 300 + (index * 200));
  });
  
  updatePageTitle(userType);
  
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.target.matches('input, textarea, select')) {
      const primaryButton = document.querySelector('.btn-success-page');
      if (primaryButton && document.activeElement === document.body) {
        primaryButton.click();
        e.preventDefault();
      }
    }
    
    if ((e.key === ' ' || e.key === 'Spacebar') && !e.target.matches('input, textarea, select, button, a')) {
      createConfetti(userType);
      e.preventDefault();
    }
    
    if (e.key === 'Escape') {
      const homepageButton = document.querySelector('a[href*="index"]');
      if (homepageButton) {
        homepageButton.click();
      }
    }
  });
}

function createConfetti(userType = 'user') {
  const colorPalettes = {
    buyer: ['#198754', '#20c997', '#0dcaf0', '#ffc107', '#fd7e14'],
    seller: ['#0056B3', '#0d6efd', '#28a745', '#ffc107', '#fd7e14'],
    default: ['#0056B3', '#28a745', '#20c997', '#ffc107', '#fd7e14']
  };
  
  const colors = colorPalettes[userType] || colorPalettes.default;
  const container = document.querySelector('.success-page') || document.body;
  
  for (let i = 0; i < 50; i++) {
    setTimeout(() => {
      const confetti = document.createElement('div');
      confetti.className = 'confetti';
      
      const size = Math.random() * 10 + 5;
      const color = colors[Math.floor(Math.random() * colors.length)];
      const left = Math.random() * 100;
      const duration = Math.random() * 3 + 2;
      const delay = Math.random() * 1;
      const rotation = Math.random() * 360;
      const shape = Math.random() > 0.5 ? '50%' : '0';
      
      confetti.style.cssText = `
        position: fixed;
        width: ${size}px;
        height: ${size}px;
        background: ${color};
        top: -20px;
        left: ${left}vw;
        opacity: ${Math.random() * 0.5 + 0.5};
        border-radius: ${shape};
        z-index: 9999;
        animation: fall ${duration}s linear ${delay}s forwards;
        pointer-events: none;
      `;
      
      if (!document.querySelector('#confetti-animation')) {
        const style = document.createElement('style');
        style.id = 'confetti-animation';
        style.textContent = `
          @keyframes fall {
            to {
              transform: translateY(100vh) rotate(${rotation}deg);
              opacity: 0;
            }
          }
        `;
        document.head.appendChild(style);
      }
      
      document.body.appendChild(confetti);
      
      setTimeout(() => {
        if (confetti.parentNode) {
          confetti.remove();
        }
      }, (duration + delay) * 1000);
      
    }, i * 50);
  }
}

function createRippleEffect(event, button) {
  const ripple = document.createElement('span');
  const rect = button.getBoundingClientRect();
  
  const size = Math.max(rect.width, rect.height);
  const x = event.clientX - rect.left - size / 2;
  const y = event.clientY - rect.top - size / 2;
  
  ripple.style.cssText = `
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.7);
    transform: scale(0);
    animation: ripple 0.6s linear;
    width: ${size}px;
    height: ${size}px;
    top: ${y}px;
    left: ${x}px;
    pointer-events: none;
  `;
  
  if (!document.querySelector('#ripple-animation')) {
    const style = document.createElement('style');
    style.id = 'ripple-animation';
    style.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  }
  
  button.style.position = 'relative';
  button.style.overflow = 'hidden';
  button.appendChild(ripple);
  
  setTimeout(() => {
    ripple.remove();
  }, 600);
}

function updatePageTitle(userType) {
  const titles = {
    buyer: 'Buyer Registration Successful | Merketar',
    seller: 'Seller Registration Successful | Merketar'
  };
  
  if (titles[userType]) {
    document.title = titles[userType];
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// RESPONSIVE HANDLING
/////////////////////////////////////////////////////////////////////////////////////////////////////////

// function initResponsiveHandlers() {
//   let resizeTimer;
  
//   window.addEventListener("resize", () => {
//     clearTimeout(resizeTimer);
//     resizeTimer = setTimeout(() => {
//       if (mapInitialized && activeSection === "market") {
//         const mapElement = document.getElementById("marketMap");
//         if (mapElement && window.L?.map) {
//           const map = window.L.map("marketMap");
//           if (map) map.invalidateSize();
//         }
//       }
      
//       if (typeof initSellerDashboard === 'function') {
//         initSellerDashboard();
//       }
//     }, 250);
//   });
  
//   document.addEventListener('touchstart', function(e) {
//     if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
//       document.body.style.zoom = "100%";
//     }
//   }, { passive: true });
// }

function optimizeForLowEndDevices() {
  if ('hardwareConcurrency' in navigator && navigator.hardwareConcurrency <= 2) {
    console.log('Low-end device detected, optimizing animations...');
    
    window.createConfetti = function(userType = 'user') {
      const colorPalettes = {
        buyer: ['#198754', '#20c997'],
        seller: ['#0056B3', '#0d6efd'],
        default: ['#0056B3', '#28a745']
      };
      
      const colors = colorPalettes[userType] || colorPalettes.default;
      const container = document.querySelector('.success-page') || document.body;
      
      for (let i = 0; i < 15; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        
        const color = colors[i % colors.length];
        confetti.style.cssText = `
          position: fixed;
          width: 8px;
          height: 8px;
          background: ${color};
          top: -10px;
          left: ${Math.random() * 100}vw;
          opacity: 0.6;
          border-radius: 50%;
          z-index: 9999;
          animation: simple-fall ${Math.random() * 2 + 1}s linear forwards;
          pointer-events: none;
        `;
        
        if (!document.querySelector('#simple-fall-animation')) {
          const style = document.createElement('style');
          style.id = 'simple-fall-animation';
          style.textContent = `
            @keyframes simple-fall {
              to {
                transform: translateY(100vh);
                opacity: 0;
              }
            }
          `;
          document.head.appendChild(style);
        }
        
        document.body.appendChild(confetti);
        
        setTimeout(() => {
          if (confetti.parentNode) {
            confetti.remove();
          }
        }, 3000);
      }
    };
    
    const circles = document.querySelectorAll('.decorative-circle');
    circles.forEach(circle => {
      circle.style.opacity = '0.1';
      circle.style.animationDuration = '6s';
    });
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// INITIALIZATION
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function initForms() {
  console.log("Initializing forms...");
  
  if (forms) {
    initializeSellerSignupForms();
  }
}

function handleLoadEvent() {
  console.log('Page fully loaded');
  
  if (window.history.replaceState && window.location.search.includes('error=')) {
    const url = new URL(window.location);
    url.searchParams.delete('error');
    url.searchParams.delete('message');
    window.history.replaceState({}, document.title, url.toString());
  }
  
  console.log('i am here! - Load event fired successfully');
}

function initMain() {
  console.log("Starting main initialization...");
  
  try {
    attachSectionListeners();
    restoreActiveSection();
    initBuyerInteractions();
    initSellerInteractions();
    // initResponsiveHandlers();
    initForms();
    addDigitalProductSection();
    addVariantSection();
    // dontRefresh();
    activateTriggers();
   
    
    if (document.querySelector(".seller-section") && typeof initSellerDashboard === 'function') {
      setTimeout(() => initSellerDashboard(), 500);
    }
    
    if (document.body.classList.contains('success-page')) {
      initializeSuccessPage();
    }
    
    if (document.body.classList.contains('seller-login')) {
      initializeLoginPage();
    }
    
    if (document.getElementById('productCreateForm')) {
      initializeProductForms();
    }
    
    setTimeout(() => {
      document.body.classList.add("loaded");
      console.log("Initialization complete");
    }, 300);
    
  } catch (error) {
    console.error("Initialization error:", error);
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// EVENT LISTENERS
/////////////////////////////////////////////////////////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function() {
  console.log("DOMContentLoaded fired");
  
  optimizeForLowEndDevices();
  initMain();
  
  if (document.body.classList.contains('success-page')) {
    const userType = document.body.dataset.userType || 'unknown';
    console.log(`Registration successful for: ${userType}`);
  }
});

window.addEventListener("load", function() {
  console.log("Window load event fired");
  
  setTimeout(handleLoadEvent, 100);
});

window.addEventListener("error", (e) => {
  console.error("Script error:", e.message, e.filename, e.lineno);
});

// Development mode check removed - not needed for client-side
console.log("Bundle.js script loaded and parsed successfully");




/////////////////////////////////////////////////////////////////////////////////////////////////////////
// Activate Triggers
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function activateSectionMin(sectionId) {
  // Remove active from all sections
  document.querySelectorAll('.section.active').forEach(section => {
    section.classList.remove('active');
  });
  // Add active to target section
  const target = document.getElementById(sectionId);
  if (target) {
    target.classList.add('active');
    // Save to sessionStorage
    sessionStorage.setItem('activeSection', sectionId);
  }
}


function activateTriggers(){

  // Select all elements with data-href
const triggers = document.querySelectorAll('[data-href]');

    if (!triggers) {
        return;
    }

triggers.forEach(trigger => {
    trigger.addEventListener('click', function(event) {
        // Check if the click originated from an interactive element inside this trigger
        const interactive = event.target.closest('a, button, input, select, textarea, [contenteditable]');
        
        // If there's an interactive element AND it's not the trigger itself, skip activation
        if (interactive && interactive !== this) {
            return; 
        }

        // Prevent default only if we're about to activate (e.g., if trigger is an <a> with href)
        event.preventDefault();

        // Get the target ID from data-href, removing any leading '#'
        const targetId = this.dataset.href.replace(/^#/, '');
        if (document.getElementById(targetId)) activateSectionMin(targetId);
        const targetSection = document.getElementById(targetId);

        if (!targetSection) {
            console.warn(`No element found with id "${targetId}"`);
            return;
        }

        // Remove 'active' class from all sections (replace '.section' with your actual section class)
        document.querySelectorAll('.section.active').forEach(section => {
            section.classList.remove('active');
        });

        // Add 'active' class to the target section
        targetSection.classList.add('active');

    });
});
}









