function checkTokenAndCallApi(apiUrl, apiMethod = 'GET', apiData = null) {
    var token = localStorage.getItem('jwt_token');
    
    if (!token) {
        window.location.href = "<?php echo admin_url('admin.php?page=aap-login'); ?>";
        return;
    }

    return fetch('<?php echo admin_url('admin-ajax.php?action=verify_token'); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ token: token })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            return fetch(apiUrl, {
                method: apiMethod,
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                },
                body: apiData ? JSON.stringify(apiData) : null
            })
            .then(apiResponse => apiResponse.json())
            .then(apiData => {
                return apiData;
            });
        } else {
            localStorage.removeItem('jwt_token');
            window.location.href = "<?php echo admin_url('admin.php?page=aap-login'); ?>";
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
