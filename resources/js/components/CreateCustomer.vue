<template>
    <div>
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Name</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="First name"
                                       v-model="customer.first_name">
                                <input type="text" class="form-control" placeholder="Last name"
                                       v-model="customer.last_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" v-model="customer.address"></textarea>
                        </div>


                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" v-model="customer.email">
                        </div>


                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" class="form-control" v-model="customer.phone">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-text" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" @click="submit">Save Customer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .modal-open .modal {
        display: flex !important;
        justify-content: center;
        flex-direction: column;
    }

    .modal .modal-dialog {
        width: 100%;
    }
</style>

<script>
    import axios from "axios"

    const customer = function () {
        return {
            first_name: '',
            last_name: '',
            email: '',
            address: '',
            phone: '',
        }
    };

    export default {
        props: ['name', 'handleNewCustomer'],
        mounted() {
            $('#myModal').on('shown.bs.modal', () => {
                this.customer = customer();
                this.customer.first_name = this.name
            })
        },
        methods: {
            async submit() {

                let response = {};

                try {
                    response = await axios.post(`/customer`, this.customer);
                } catch (e) {
                    // warn user
                }

                if (response.status === 201) {
                    this.handleNewCustomer(response.data);
                }

            },
        },
        data() {
            return {
                customer: customer(),
            }
        }
    }
</script>
