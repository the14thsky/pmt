<template>
<div>

<div class="form-group col-sm-6">
<label for="template_name" >Template Name</label>
<input type="text" name="template_name" class="form-control" v-model="template_name">
</div>

<div class="form-group col-sm-12">
<label for="description" >Description</label>
<textarea name="description"  class="form-control" v-model="description"></textarea>
</div>


<div class="form-group col-sm-11 seperator">
    <h4 style="display: inline-block"><b>Deliverables </b></h4>
    <button class="pull-right btn btn-success" style="display: inline-block" type="button" v-on:click="addmore()">Add More</button>
</div>

<div class="col-sm-3 form-group">
    <b>Task</b>
</div>

<div class="col-sm-3 form-group">
   <b>Party</b>
</div>
<div class="col-sm-3 form-group">
   <b>Predecessor</b>
</div>
<div class="col-sm-3 form-group">
    <b>Duration</b>
</div>

<div v-for="(item, index) in deliverables.task" :key="item.task">

<div class="col-sm-3 form-group">
       <input type="text" name="deliverables[task][]" class="form-control" v-model="deliverables.task[index]">
   </div>

<div class="col-sm-3 form-group">
<select name="deliverables[party][]" class="form-control" v-model="deliverables.party[index]">
    <option>3L</option>
    <option>Client</option>
</select>
</div>

<div class="col-sm-3 form-group">
<select name="deliverables[predecessor][]" class="form-control" v-model="deliverables.predecessor[index]">
    <option value="NA">NA</option>
    <option v-for="predecessor in (index-1<0  ? 0 : index-1)" :key="predecessor.task"> {{deliverables.task[predecessor]}}</option>
</select>
</div>

<div class="col-sm-3 form-group">
       <input type="number" name="deliverables[duration][]"  class="form-control" v-model="deliverables.duration[index]">
       <a role="button" class="btn btn-danger" style="position: absolute; right:1px; top:1px" v-on:click="remove(index)"><i class="fa fa-minus"></i></a>

</div>


    </div>
</div>
</template>

<script>
    export default {
        props:['templatename', 'desc', 'deliverable'],
        data(){
        return {
          deliverables:this.deliverable ? JSON.parse(this.deliverable) : {
              task:[''],
              party:[''],
              predecessor:[''],
              duration:['']
          },
          template_name:this.templatename,
          description:this.desc,
          //items:1
        }
    },

        mounted() {
            console.log(this.deliverables);

        },

        methods: {

            addmore(){
                //this.items = this.items+1;
                this.deliverables.task.push('');
                this.deliverables.party.push('');
                this.deliverables.predecessor.push('');
                this.deliverables.duration.push('');
            },

            remove(ind){
                this.deliverables.task.splice(ind,1);
                this.deliverables.party.splice(ind,1);
                this.deliverables.predecessor.splice(ind,1);
                this.deliverables.duration.splice(ind,1);

            }
        }
    }
</script>
