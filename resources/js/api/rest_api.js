import axios from 'axios';
import {
    authHeader
} from './auth-header'

export default {
    DEFAULT_TIME_OUT: 60000,
    async post(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = '';
        let tm = timeout;
        console.log("POST " + url);
        console.log("req = " + JSON.stringify(params));
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let uri = baseUri + url;
        let result = ''
        await axios.post(uri, params, config).then((response) => {
            result = response
        }).catch((e) => {
        })
        return result

    },
    async put(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        console.log("PUT " + url);
        console.log("req = " + JSON.stringify(params));
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let uri = baseUri + url;
        var result = {
            rc: null,
            msg: '',
            data: {}
        }
        await axios.put(uri, params, config).then((response) => {
            var data = util.decryptData(response.data, uri)
            result.data = data;
            result.rc = 0;
            result.msg = 'Thành công'
        }).catch((e) => {
            result.data = e.response;
            result.rc = 1;
            result.msg = 'Thất bại'
        })
        return result
    },
    async patch(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        console.log("patch url: " + url);
        console.log("patch params: " + JSON.stringify(params));
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let uri = baseUri + url;
        let result = null
        await axios.patch(uri, params, config).then((response) => {
            result = response
        }).catch((error) => {
            result = error.response
        })
        return result
    },
    get(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;
        return axios.get(uri, config)

    },
    async getData(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;
        var result = {
            rc: null,
            msg: '',
            data: {}
        }
        await axios.get(uri, config).then((response) => {
            var data = util.decryptData(response.data, uri)
            result.data = data;
            result.rc = 0;
            result.msg = 'Thành công'
        }).catch((e) => {
            result.data = e.response;
            result.rc = 1;
            result.msg = 'Thất bại'
        })
        return result

    },
    async delete(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;
        var result = {
            rc: null,
            msg: '',
            data: {}
        }
        await axios.delete(uri, config).then((response) => {
            console.log('12')
            var data = util.decryptData(response.data, uri)
            result.data = data;
            result.rc = 0;
            result.msg = 'Thành công'
        }).catch((error) => {
            result.data = error.response;
            result.rc = 1;
            result.msg = 'Thất bại'
        })
        return result

    },
    objectToQueryString(obj) {
        let str = [];
        for (let p in obj)
            if (obj.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            }
        return str.join("&");
    },
}
