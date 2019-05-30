<template>
    <div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Customer(s)</label>

            <div class="col-md-7">

                <div class="form-control position-relative mb-3" v-for="customer in selected">
                    {{ customer.first_name }} {{ customer.last_name }} ({{ customer.phone }})
                    <div class="float-right">
                        <a href="#" @click="removeCustomer(customer)" class="delete-link">&times;</a>
                    </div>
                    <input type="hidden" :value="customer.id" name="customers[]">
                </div>

                <!-- autocomplete="new-password" is a hacky way to stop autofill in 2019 :( -->
                <input type="text" :class="['form-control',error?'is-invalid':'']"
                       :placeholder="search_placeholder" @keyup="search" v-model="name" autocomplete="new-password">

                <span class="invalid-feedback" role="alert" v-if="error">
                    <strong>{{ error }}</strong>
                </span>


                <div v-if="searching">
                    Searching...
                </div>

                <div v-if="searched" class="mt-1">
                    <a href="#" @click="showModal">Add a new customer "{{ name }}"</a>
                </div>

                <div v-if="results.length > 0">
                    <ul>
                        <li v-for="customer in results">
                            <a href="#" @click="addCustomer(customer)">
                                {{ customer.first_name }} {{ customer.last_name }} ({{ customer.phone }})
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <create-customer
                :name="name"
                :handleNewCustomer="addCustomer"
        ></create-customer>

    </div>
</template>
<style scoped>
    .delete-link {
        font-size: 24px;
        position: absolute;
        top: 0;
        right: 4px;
    }
</style>
<script>
    import axios from "axios"
    import CreateCustomer from "./CreateCustomer"

    export default {
        components: {CreateCustomer},
        props: ['old', 'errorMsg'],
        async mounted() {
            if (this.errorMsg) {
                this.error = this.errorMsg;
            }
            if (this.old.length > 0) {
                let ids = this.old.join(',');
                (await axios.get(`/customer?ids=${ids}`)).data.map(customer => this.addCustomer(customer))
            }
        },
        watch: {
            selected(value) {
                document.querySelector('button[type=submit]').disabled = this.selected.length < 0;
            }
        },
        computed: {
            search_placeholder() {
                if (this.selected.length > 0) {
                    return "Search for an additional customer by name, email, phone"
                }
                return "Search or create a customer by name, email, phone";
            }
        },
        methods: {
            search() {
                clearTimeout(this.timeout);
                this.searching = true;
                this.searched = false;
                this.error = false;
                this.timeout = setTimeout(this.fetch, 800);
            },
            showModal() {
                $('#myModal').modal('show');
            },
            removeCustomer(customer) {
                if (confirm('Are you sure you want to remove this customer?')) {
                    this.selected.splice(
                        this.selected.indexOf(customer), 1
                    )
                }
            },
            addCustomer(customer) {
                $('#myModal').modal('hide');
                this.searched = false;
                this.name = '';
                this.results = [];
                this.selected.push(customer)
            },
            async fetch() {
                this.searching = false;
                if (this.name.length < 1) {
                    return;
                }
                this.searched = true;
                try {
                    this.results = (await axios.get(`/customer?search=${this.name}`)).data;
                } catch (e) {
                    this.error = e;
                }
            }
        },
        data() {
            return {
                searching: false,
                searched: false,
                results: [],
                selected: [],
                name: '',
                error: '',
            }
        }
    }
</script>
