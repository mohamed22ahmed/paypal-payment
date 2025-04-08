<template>
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" v-if="!$route.meta.hideNavbar">
        <a class="navbar-brand" href="#"><img src="test.jpg" width="90px" height="100px" class="img-fluid rounded-circle img-responsive" alt="company_logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-3" style="width:50%;">
                <form action="" style="width:100%">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="/">PayPal Payment</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/show_transactions">Transactions</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </form>
            </ul>
        </div>
    </nav>
    <br>
    <router-view></router-view>
</div>
</template>

<script>
export default {
    data: function () {
        return {}
    },
}
</script>
