async function callClientRequest(method, url, headers = {}, params = {}, multipart = false, contentType = 'form-data') {
    console.log('script.js has been loaded');
    method = method.toUpperCase();
    let options = {
        method: method,
        headers: headers,
        timeout: 10000,
    };

    if (method === 'GET') {
        url += '?' + new URLSearchParams(params).toString();
    } else {
        if (multipart) {
            let formData = new FormData();
            for (let key in params) {
                formData.append(key, params[key]);
            }
            options.body = formData;
        } else if (contentType === 'json') {
            options.headers['Content-Type'] = 'application/json';
            options.body = JSON.stringify(params);
        } else {
            options.headers['Content-Type'] = 'application/x-www-form-urlencoded';
            options.body = new URLSearchParams(params).toString();
        }
    }

    try {
        const response = await fetch(url, options);
        const responseData = await response.json();

        if (!response.ok) {
            return {
                success: false,
                message: 'Request API error',
                data: responseData || {}
            };
        }

        return {
            success: true,
            message: 'Request API success',
            data: responseData,
            extraData: response,
            responseBody: response.body,
            responseHeaders: response.headers,
            detailRequest: {
                url: url,
                params: params
            }
        };
    } catch (error) {
        return {
            success: false,
            message: error.message || 'Request API error'
        };
    }
}
