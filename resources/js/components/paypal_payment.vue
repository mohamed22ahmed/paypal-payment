<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pay For Product</div>

                <div class="card-body">
                    <form>
                        <input hidden name="amount" v-model="form.amount">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>Amount</label><br>
                                    <input type="text" class="form-control" v-model="form.amount" >
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mx-auto w-50">
                        <div style="text-align: center;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data: function () {
        return {
            form: new Form({
                amount: '100.00',
            }),
        }
    },
}

function initPayPalButton() {
    paypal.Buttons({
        createOrder: (data, actions) => {
            var amount = $('input[name="amount"]').val();
            return actions.order.create({
            purchase_units: [
                {
                    description: 'Test Product',
                    amount: {
                        currency_code: "USD",
                        value: amount
                    }
                }
            ]
            });
        },
        onApprove: async (data, actions) => {
            return actions.order.capture().then(function (details) {
                alert("Transaction completed by " + details.payer.name.given_name);
                return fetch("/pay", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        orderID: data.orderID,
                        details: details
                    })
                });
            }).then(() => {
                swal.fire({
                    position: "top-end",
                    icon: 'success',
                    title: 'payment success',
                    text: 'Your payment has been successful',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(function() {
                    window.location = "/show_transactions";
                }).catch(() => {
                    swal.fire({
                        icon: "warning",
                        title: this.$t('1240'),
                        text: this.$t('1241'),
                        confirmButtonText: this.$t('8')
                    });
                });
            });
        },
    }).render('#paypal-button-container');
}
initPayPalButton();
</script>
