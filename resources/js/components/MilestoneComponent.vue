<style scoped>
.input{
    width: 100px;
    border: 1px solid #d2d6de;
    height: 35px;
}
</style>

<template>
<div>
<div class="form-group col-sm-6">
    <label for="company">Company: {{company}}</label>

</div>
<div class="clearfix"></div>
<div class="form-group col-sm-6">
    <label for="company">Company Code: {{comp_code}}</label>

</div>

<div class="form-gorup col-sm-12">
<table class="table primary">
    <thead>
        <tr>
            <th>Milestone </th>
            <th>% of total</th>
            <th>Amount (SGD)</th>
            <th colspan="2">Can Invoice</th>
            <th colspan="2">Invoice Sent</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="milestone of milestones" v-bind:key="milestone.id">
            <td>{{milestone.milestone}}</td>
             <td>{{milestone.percentage}}</td>
             <td>{{milestone.amount}}</td>
             <td><input type="checkbox" name="can_invoice[]" v-model="milestone.can_invoice" :disabled="role=='finance'"></td>
             <td><datepicker  v-model="milestone.can_invoice_date" :bootstrap-styling="true" :disabled="role=='finance'"></datepicker></td>
             <td><input type="checkbox" name="invoice_sent[]" v-model="milestone.invoice_sent" :disabled="role!=='finance'"></td>
             <td><datepicker  v-model="milestone.invoice_sent_date" :bootstrap-styling="true" :disabled="role!=='finance'"></datepicker></td>
        </tr>
    </tbody>
</table>
</div>
<div class="col-lg-12">

    <input type="button" value="Submit" class="btn btn-primary" v-on:click="updateMilestone()">
</div>

</div>


</template>

<script>
import Datepicker from 'vuejs-datepicker';
import axios from 'axios';
    export default {
        components: {
        Datepicker
    },
    props:['milestone', 'comp_code', 'company', 'role'],
        data() {
            return {
               milestones: this.milestone
            };
        },
         mounted() {
            //console.log(this.deliverables);

        },

        methods: {
            updateMilestone(){
                try {
                    axios.post('/sales/projects/milestone/update', {
                    milestones: this.milestones,

                }).then((res)=>{
                    alert ('done');
                })


                } catch (e) {
                    // handle the authentication error here
                }

            }

    }
    }
</script>
