(() => {
    'use strict'
  
    const getStoredTheme = () => localStorage.getItem('theme')
    const setStoredTheme = theme => localStorage.setItem('theme', theme)
  
    const getPreferredTheme = () => {
      const storedTheme = getStoredTheme()
      if (storedTheme) {
        return storedTheme
      }
  
      return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }
  
    const setTheme = theme => {
      if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-bs-theme', 'dark')
      } else {
        document.documentElement.setAttribute('data-bs-theme', theme)
      }
    }
  
    setTheme(getPreferredTheme())
  
    const showActiveTheme = (theme, focus = false) => {
      const themeSwitcher = document.querySelector('#bd-theme')
  
      if (!themeSwitcher) {
        return
      }
  
      const themeSwitcherText = document.querySelector('#bd-theme-text')
      const activeThemeIcon = document.querySelector('.theme-icon-active use')
      const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
      const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')
  
      document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
        element.classList.remove('active')
        element.setAttribute('aria-pressed', 'false')
      })
  
      btnToActive.classList.add('active')
      btnToActive.setAttribute('aria-pressed', 'true')
      activeThemeIcon.setAttribute('href', svgOfActiveBtn)
      const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
      themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)
  
      if (focus) {
        themeSwitcher.focus()
      }
    }
  
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
      const storedTheme = getStoredTheme()
      if (storedTheme !== 'light' && storedTheme !== 'dark') {
        setTheme(getPreferredTheme())
      }
    })
  
    window.addEventListener('DOMContentLoaded', () => {
      showActiveTheme(getPreferredTheme())
  
      document.querySelectorAll('[data-bs-theme-value]')
        .forEach(toggle => {
          toggle.addEventListener('click', () => {
            const theme = toggle.getAttribute('data-bs-theme-value')
            setStoredTheme(theme)
            setTheme(theme)
            showActiveTheme(theme, true)
          })
        })
    })
  })();

// document.addEventListener("DOMContentLoaded", function () {
//   updateDropdownLabel("Today");
// });

// function updateDropdownLabel(label) {
//   document.getElementById("dropdownButton_dashboard-cards").innerHTML = `<i class="bi bi-calendar3"></i>`+label;
// }
//user_jobs_table_status
function updateJobsStatusDropdownLabel(label) {
  document.getElementById("dropdownButton-users").innerHTML = label;
}
document.addEventListener("DOMContentLoaded", function () {
  updateJobsStatusDropdownLabel("Pending");
});

//user dashboard Datatables
$(document).ready(function() {
  $('#user_dashboard_table').DataTable();
});

//user jobs Datatables
$(document).ready(function() {
  $('#user_jobs_table').DataTable();
});

// Update job status
function updateJobStatus(jobId) {
  $.ajax({
      url: 'user_jobs_script.php',
      type: 'POST',
      data: { jobId: jobId },
      dataType: 'json',
      success: function(response) {
          if (response.success) {
              // Handle success, maybe show a notification to the user
              console.log('Job status updated successfully');
          } else {
              // Handle failure, show an error message
              console.error('Failed to update job status');
          }
      },
      error: function() {
          console.error('An error occurred during the AJAX request');
      }
  });
}

// Add an event listener to the dropdown
$('#dropdownButton-users .dropdown-item').click(function() {
  const newStatus = $(this).text();
  if (newStatus === 'Completed') {
      // const jobId = /* Get the jobId of the current row */;
      updateJobStatus(jobId);
  }
});