<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
  </head>
  <body>
    @inertia

      <script>
        /*
        * Show error message per invalid form field
        */
        function showInvalidFeedback(fieldSelector, errorMessage)
        {
          if (errorMessage.length > 0) {
            var fieldElement = document.getElementById('input-div-' + fieldSelector);
            var errorMessageDiv = document.createElement('div');
            errorMessageDiv.className = 'text-red-500 text-xs mt-1 inputError';
            errorMessageDiv.textContent = errorMessage;
            
            fieldElement.parentNode.insertBefore(errorMessageDiv, fieldElement.nextSibling);
          }
        }
    
        /*
        * Manage the error messages before displaying to the page
        */
        function manageInvalidFeedbacks(errors = null)
        {
          document.querySelectorAll('.inputError').forEach(function(element) {
            element.remove();
          });

          if (errors) {
              Object.entries(errors).forEach(([key, value]) => {
                showInvalidFeedback(key,  value[0]);
              });
          }
        }

        function fetchData(url, method, data) {
          // Get the token from wherever you stored it (e.g., state, localStorage)
          const token = localStorage.token || '';

          const headers = {
              'Authorization': `Bearer ${token}`,
              'Content-Type': 'application/json',
          };

          const requestOptions = {
              method,
              headers,
          };

          if (data) {
              requestOptions.body = JSON.stringify(data);
          }

          return fetch(url, requestOptions)
              .then(response => {
                  if (!response.ok) {
                      throw new Error(`HTTP error! Status: ${response.status}`);
                  }
                  return response.json();
              });
      }

    </script>
  </body>
</html>