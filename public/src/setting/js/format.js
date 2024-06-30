    // Function to show the section associated with the clicked sidebar link
    function showSection(sectionId) {
      // Hide all sections first
      document.querySelectorAll('.content-section').forEach(function(section) {
      section.classList.add('hidden');
      });
  
      // Show the target section
      document.getElementById(sectionId).classList.remove('hidden');
      }
  
      // Add click event listeners to sidebar links
      document.querySelectorAll('.sidebar-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
      e.preventDefault(); // Prevent default anchor link behavior
      var targetSection = e.target.getAttribute('data-target'); // Get the target section ID
      showSection(targetSection); // Show the target section
      });
      });
  
      // Add click event listener to logout link
      document.addEventListener('DOMContentLoaded', function() {
      // Toggle modal display
      const logoutLink = document.querySelector('.logout-link'); // Make sure your logout link has this class
      const logoutModal = document.getElementById('logoutModal');
      const confirmLogout = document.getElementById('confirmLogout');
      const cancelLogout = document.getElementById('cancelLogout');
  
      logoutLink.addEventListener('click', function(e) {
      e.preventDefault();
      logoutModal.classList.remove('hidden'); // Show the modal
      });
  
      cancelLogout.addEventListener('click', function() {
      logoutModal.classList.add('hidden'); // Hide the modal on cancel
      });
      
       // if pressing escape key, or clicking outside the modal, close it
       window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            logoutModal.classList.add('hidden');
        }
    });

    window.addEventListener('click', function(e) {
        if (e.target == logoutModal) {
            logoutModal.classList.add('hidden');
        }
    });

      confirmLogout.addEventListener('click', function() {
      // Redirect to your logout script or perform AJAX logout
      window.location.href = '../chat/connection/logout.php'; // Adjust the path to your logout script
      });
      });
  
      document.querySelectorAll('.toggle-checkbox').forEach(function(toggle) {
      toggle.addEventListener('change', function() {
      const settingName = toggle.id;
      const settingValue = toggle.checked ? 'Enabled' : 'Disabled';
      console.log(`${settingName}: ${settingValue}`);
      // Here, you can add AJAX or Fetch API to update the setting in the backend
      });
      });
  
      document.addEventListener('DOMContentLoaded', function() {
        const editBtns = document.querySelectorAll('.edit-btn');
    
        editBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetModalId = this.getAttribute('data-target');
                const targetModal = document.getElementById(targetModalId);
                
                // Toggle modal visibility
                if (targetModal.classList.contains('hidden')) {
                    closeAllModals(); // Function to close all modals
                    targetModal.classList.remove('hidden');
                } else {
                    targetModal.classList.add('hidden');
                }

                // if pressing escape key, or clicking outside the modal, close it
                window.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeAllModals();
                    }
                });

                window.addEventListener('click', function(e) {
                    if (e.target == targetModal) {
                        targetModal.classList.add('hidden');
                    }
                });
            });
        });
      });

      function closeAllModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.add('hidden');
        });
      }

    