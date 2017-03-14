import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
    let resultsNode = document.querySelector('#results');
    let fetchNode = document.querySelector('#fetch');

    // No nodes, no go
    if (!resultsNode && !fetchNode) {
        return false;
    }

    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken,
    };

    fetchNode.addEventListener('click', (e) => {
        e.preventDefault();

        axios.get('/api/user')
            .then(function (response) {
                resultsNode.innerHTML = 'API call success. Check your console.'
                console.log(response);
            })
            .catch(function (error) {
                resultsNode.innerHTML = 'API call failure. Check your console.'
                console.log(error);
            });
    });
});