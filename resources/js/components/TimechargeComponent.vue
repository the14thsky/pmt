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
    <label>Today's Date: {{currentDate}}</label>
</div>

<div class="form-group col-sm-6">
    <a  role="button" class="btn btn-secondary" @click="getDeliverables()" > <i class="fa fa-refresh"></i> Refresh</a>
</div>

<div class="clearfix"></div>
<div class="form-group col-sm-6">
    <label for="deliverable_list">Deliverables:</label>
    <select name="deliverable_list" class="form-control" v-on:change="getDeliverables()"  v-model="active_deliverable">
        <option v-for="option of deliverable_list" v-bind:key="option.id" :value="option.value">
            {{option.name}}
        </option>
    </select>
</div>

<div class="form-group col-sm-12">
    <table class="table primary">
        <thead>
            <th>Tasks</th>
            <th>Party</th>
            <th>Man Hour</th>
            <th>Mark Complete</th>
        </thead>
        <tbody>
            <tr v-for="(deliverable, index) in deliverables" v-bind:key="deliverable.id">
                <td>{{deliverable.task}}</td>
                <td>{{deliverable.party}}</td>
                <td>{{deliverable.man_hours}}</td>
                <td><input type="checkbox" :name="deliverable.id"  :checked="deliverable.status=='Completed'" :disabled="deliverable.status=='Completed'"  @click="markStatus($event, index)"></td>
            </tr>
        </tbody>
    </table>
    <hr>
</div>

<div class="form-group col-sm-12">
    <h4>Your Entry:</h4>
    <table class="table primary">
        <thead>
            <th>Tasks</th>
            <th>Man Hour</th>

        </thead>
        <tbody>
            <tr v-for="(charge, index) in time_charges" v-bind:key="charge.id">
                <td>{{charge.deliverable.task}}</td>
                <td><input type="text"  v-model="charge.man_hour" :disabled="charge.deliverable.status=='Completed'" v-on:keyup="calculate(charge.deliverable.id, charge.id, index)"></td>

            </tr>
        </tbody>
    </table>

    <button name="Submit" class="btn btn-primary" @click="updateTimeCharge()" v-show="time_charges.length>0">Submit</button>
</div>

</div>


</template>

<script>

import axios from 'axios';
    export default {

    props:['deliverable_list', 'projid'],
        data() {
            return {
               deliverables:[],
               time_charges:[],
               active_deliverable:'',
               deliverableIds:[],
               currentDate:new Date().toDateString()
            };
        },
         mounted() {


        },

        methods: {
            updateDeliverables(){


            },
            getDeliverables(){
                axios.get('/api/sales/projects/deliverablesByTitle/'+this.projid+'/'+this.active_deliverable).then((res)=>{
                    this.deliverables=res.data.data
                    this.deliverableIds = this.deliverables.map(({ id }) => id);
                    this.getTimeCharging();
                })
            },

            getTimeCharging(){

                axios.post('/api/sales/projects/timeChargingByUser',{
                    deliverableIds: this.deliverableIds,
                    date: this.currentDate
                }).then((res)=>{
                    this.time_charges = res.data.data;
                    this.addTimeCharge();
                })
            },

            addTimeCharge(){
                this.deliverables.forEach(element => {

                    if(this.time_charges.filter(x => x.deliverable.id == element.id)[0]==undefined){
                        this.time_charges.push({
                            deliverable:{
                                'task' : element.task,
                                'status': 'Not Started',
                                'id': element.id,
                                'man_hours': element.man_hours
                            },
                            man_hour:0,
                            project_id:this.projid,
                            deliverable_id:element.id
                        })
                    }
                });
            },

            calculate(deliverable_id, timeCharge_id, index){
                if(timeCharge_id){
                    this.deliverables.filter(x => x.id == deliverable_id)[0].man_hours = (+this.time_charges.filter(x => x.id == timeCharge_id)[0].man_hour)+(+this.time_charges.filter(x => x.id == timeCharge_id)[0].deliverable.man_hours);

                }
                else{
                    this.deliverables.filter(x => x.id == deliverable_id)[0].man_hours = (+this.time_charges[index].deliverable.man_hours) + (+this.time_charges[index].man_hour);
                }
                 //console.log(this.deliverables.filter(x => x.id == ind));
            },

            markStatus(e, index){
                if(e.target.checked){
                    this.deliverables[index].status="Completed";
                }
            },

            updateTimeCharge(){
                let sum = 0;
                this.time_charges.forEach(a => sum += +a.man_hour);

                if(sum>=8){
                    axios.post('/api/sales/projects/timeCharge/update',{
                    deliverables : this.deliverables,
                    time_charges :this.time_charges,
                    date: this.currentDate
                }).then((res)=>{
                    if(res.data.success){
                        this.getDeliverables();
                        alert('Saved Successfully');
                    }
                    else{
                         alert('Some Error Occured');
                    }
                })
                }
                else{

                    alert('Time Charge can\'t be less than 8');
                }

            }

    }
    }
</script>
