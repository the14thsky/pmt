<style scoped>
.input{
    width: 100px;
    border: 1px solid #d2d6de;
    height: 35px;
}
</style>

<template>

<div>
 <!-- <input type="hidden" name="_token" v-bind:value="csrf"> -->
<div class="form-group col-sm-6">
<label for="title" >Title</label>
<input type="text" name="title" class="form-control" v-model="titles">
</div>

<div class="form-group col-sm-11 seperator">
    <h4 style="display: inline-block"><b>Deliverables </b></h4>
    <button class="pull-right btn btn-success" style="display: inline-block" type="button" v-on:click="addmore()">Add More</button>
</div>
<div class="form-group col-sm-6">
<label for="template">Select template</label>
<select name="template" class="form-control" v-model="template_id" v-on:change="getDeliverables()">

    <option v-for="(item, ind) in templates" :key="ind" :value="ind"> {{item}}</option>

    </select>
</div>
<div class="clearfix"></div>
<div class="col-sm-2 form-group">
    <b>Task</b>
</div>

<div class="col-sm-2 form-group">
   <b>Party</b>
</div>
<div class="col-sm-2 form-group">
   <b>Predecessor</b>
</div>

<div class="col-sm-1 form-group">
   <b>Budget</b>
</div>

<div class="col-sm-1 form-group">
    <b>Duration</b>
</div>

<div class="col-sm-2 form-group">
    <b>Start Date</b>
</div>

<div class="col-sm-2 form-group">
    <b>End Date</b>
</div>

<div v-for="(item, index) in deliverables.task" :key="item.task">

<div class="col-sm-2 form-group">
       <input type="text" name="deliverables[task][]" class="form-control" v-model="deliverables.task[index]">
   </div>

<div class="col-sm-2 form-group">
<select name="deliverables[party][]" class="form-control" v-model="deliverables.party[index]">
    <option>3L</option>
    <option>Client</option>
</select>
</div>

<div class="col-sm-2 form-group">
<select name="deliverables[predecessor][]" class="form-control" v-model="deliverables.predecessor[index]">
    <option value="NA">NA</option>
    <option v-for="predecessor in (index-1<0  ? 0 : index-1)" :key="predecessor.task"> {{deliverables.task[predecessor]}}</option>
</select>
</div>

<div class="col-sm-1 form-group">
<select name="deliverables[budget_group][]" class="form-control" v-model="deliverables.budget_group[index]">

    <option v-for="(item, ind) in budgetgroups" :key="ind" > {{item}}</option>

    </select>
</div>

<div class="col-sm-1 form-group">
       <input type="text" name="deliverables[duration][]" @keyup="calculateEndDate(index)"  class="form-control" v-model="deliverables.duration[index]">

</div>

<div class="col-sm-2 form-group">
       <datepicker  name="deliverables[start_date][]" @closed="calculateEndDate(index)"  v-model="deliverables.start_date[index]" :bootstrap-styling="true"></datepicker>

</div>

<div class="col-sm-2 form-group">
       <datepicker name="deliverables[end_date][]" v-model="deliverables.end_date[index]" :bootstrap-styling="true"></datepicker>
       <a role="button" class="btn btn-danger" style="position: absolute; right:1px; top:0px; z-index:2" v-on:click="remove(index)"><i class="fa fa-minus"></i></a>

</div>
<div>
       <input type="hidden" name="deliverables[status][]" class="form-control" v-model="deliverables.status[index]">
        <input type="hidden" name="deliverables[man_hours][]" class="form-control" v-model="deliverables.man_hours[index]">
</div>

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
        props:['csrf','title','deliverable','budgetgroup', 'holiday', 'template'],
        data(){
        return {
          deliverables:this.deliverable ? JSON.parse(this.deliverable) : {
              task:[''],
              party:[''],
              predecessor:[''],
              budget_group:[''],
              duration:[''],
              start_date:[''],
              end_date:[''],
              status:[''],
              man_hours:['']
          },
          titles:this.title,
          budgetgroups:this.budgetgroup ? JSON.parse(this.budgetgroup) : '',
          templates:this.template ? JSON.parse(this.template) : '',
          holidays:this.holiday ? this.holiday : 0,
          template_id:''

        }
    },

        mounted() {
            //console.log(this.deliverables);

        },

        methods: {

            addmore(){
                //this.items = this.items+1;
                this.deliverables.task.push('');
                this.deliverables.party.push('');
                this.deliverables.predecessor.push('');
                this.deliverables.budget_group.push('');
                this.deliverables.duration.push('');
                this.deliverables.start_date.push('');
                this.deliverables.end_date.push('');
                this.deliverables.status.push('Not Started');
                this.deliverables.man_hours.push(0);
            },

            remove(ind){
                this.deliverables.task.splice(ind,1);
                this.deliverables.party.splice(ind,1);
                this.deliverables.predecessor.splice(ind,1);
                this.deliverables.budget_group.splice(ind,1);
                this.deliverables.duration.splice(ind,1);
                this.deliverables.start_date.splice(ind,1);
                this.deliverables.end_date.splice(ind,1);
                this.deliverables.status.splice(ind,1);
                this.deliverables.man_hours.splice(ind,1);
            },

            calculateEndDate(index){

                this.getHolidays(new Date(moment(this.deliverables.start_date[index], "DD.MM.YYYY").add(1, 'days').format('YYYY, MM, DD')), this.deliverables.duration[index]).then(res=>{
                    this.deliverables.end_date[index] = new Date(moment(this.deliverables.start_date[index], "DD.MM.YYYY").add((res), 'days').format('YYYY, MM, DD'));
                });


            },

            async getHolidays(start_date, duration){
                try {
                    const response = await axios.post('/api/administration/holidayscount', {
                    start_date: start_date,
                    duration: duration
                })
                    //this.holidays = response.data.data.count + response.data.data.weekend ;
                    return response.data.data.days;

                } catch (e) {
                    // handle the authentication error here
                }

            },

            getDeliverables(){
                try {
                    const response = axios.get('/api/administration/deliverableTemplates/'+this.template_id).then((res)=>{
                        let deliverables = res.data.data.deliverables;
                        // deliverables = JSON.parse(deliverables);
                        this.deliverables ={
                            task:[''],
                            party:[''],
                            predecessor:[''],
                            budget_group:[''],
                            duration:[''],
                            start_date:[''],
                            end_date:[''],
                            status:[''],
                            man_hours:[''],
                        };
                            deliverables.task.forEach((element,index) => {
                                this.deliverables.task[index]=deliverables.task[index];
                                this.deliverables.party[index]=deliverables.party[index];
                                this.deliverables.predecessor[index]=deliverables.predecessor[index];
                                this.deliverables.budget_group[index]= '';
                                this.deliverables.duration[index]= deliverables.duration[index];
                                this.deliverables.start_date[index] = ' ';
                                this.deliverables.end_date[index] = ' ';
                                this.deliverables.status[index]='Not Started';
                                this.deliverables.man_hours=0;
                            });



                    })


                } catch (e) {
                    // handle the authentication error here
                }

            }




        }
    }
</script>
