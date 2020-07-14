<script>
export default {
  name: "SubtaskModal",
  data() {
    return {
      title: ""
    };
  },
  props: {
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
      var param = this.taskData;
      param.title = this.title;
      console.log(param);
      this.$emit("save", param);
    }
  }
};
</script>

<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <slot name="header">
              <div class="panel-heading">Add Sub Task</div>
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              <div style="display: flex; align-items: center;">
                <div style="width:40%; text-align: right;">
                  <span style="width:100%;font-size:20px;margin-right:10px;">Subtask Title : </span>
                </div>
                <div style="width:60%;">
                  <input class="form-control" style="width:100%;" v-model="title" />
                </div>
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