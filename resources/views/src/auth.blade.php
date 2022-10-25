<script>
    const auth_token = localStorage.getItem('token');

    $(document).ready(function() {
        $.ajax({
            url: '/api/check-login',
            method: 'get',
            headers: {
                'Authorization': 'Bearer ' + auth_token,
                'Content-Type': 'application/json'
            },
            success: function(res) {
            //     if (res.message == 'Unauthenticated') {
            //         window.location = '/login'
            //     }
            //     window.location = '/home'
            }
        })
    })
</script>
