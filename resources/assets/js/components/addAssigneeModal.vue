

<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <slot name="header">
              <div class="panel-heading">Add Assignee(s)</div>
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              <div style="display: flex; align-items: center;">
                <div style="width:40%; text-align: right;">
                  <span style="width:100%;font-size:20px;margin-right:10px;">Assign to :</span>
                </div>
                <div style="width:60%;display:flex;">
                  <div class="assignees"  v-for="(assignee, index) in this.assignees" :key="index">
                    <img v-if="assignee.image != null" :src="'/user-uploads/avatar/'+assignee.image" alt="user" class="img-circle" width="30">
                    <img v-else src="/default-profile-2.png" alt="user" class="img-circle" width="30">
                    <span>{{assignee.name}}<i class="fa fa-times-circle" @click="removeAssignee(index)"></i></span>
                  </div>
                </div>
              </div>
              <div style="display:flex;margin-top:20px;">
                <div style="width:40%; text-align: right;">
                  <span style="width:100%;font-size:20px;margin-right:10px;">Employees :</span>
                </div>
                <span style="margin-left : 10px;" v-for="(employee, index) in this.employees" :key="index" @click="addAssignee(index)">
                  <img v-if="employee.image != null" :src="'/user-uploads/avatar/'+employee.image" alt="user" class="img-circle" width="30">
                  <img v-else src="/default-profile-2.png" alt="user" class="img-circle" width="30">
                </span>
              </div>
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
                <button class="btn btn-success" @click="Save()">Save</button>
                <button class="btn btn-danger" @click="$emit('close')">Close</button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 800px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  margin-left: 30px;
  float: right;
}

.assignees{
    margin-right:10px;
    background-color: #e5e5e5;
    border-radius: 5px;
    padding: 3px;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.panel-heading{
    border-color: #4c5667;
    color: #fff;
    background-color: #4c5667;
    border-radius: 0;
    font-weight: 600;
    text-transform: uppercase;
    padding: 20px 25px;
    border-bottom: 1px solid transparent;
}

div .form-control:focus {
    border-color: #66afe9 !important;
    outline: 0 !important;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6) !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6) !important; 
}
div .form-control{
  border-radius : .25rem;
}

</style>

<script>
export default {
  name: "assigneeModal",
  data() {
    return {
      title: "",
      assignees : []
    };
  },
  props: {
    employees: {
      type: [Object, Array],
      default: []
    },
    taskData: {
      type: [Object, Array],
      default: []
    },
  },
  methods: {
    close() {
      this.$emit("close");
    },
    Save() {
      var param = {
        'assignees' : this.assignees,
        'task'      : this.taskData
      };
      this.$emit("save", param);
    },
    addAssignee(index){
      var isExist = false;
      this.assignees.forEach(assignee=>{
        if(assignee.id == this.employees[index].id){
          isExist = true;
        }
      });
      if(!isExist){
        this.assignees.push(this.employees[index]);
      }
    },
    removeAssignee(index){
      this.assignees.splice(index,1);

    }
  }
};
</script>